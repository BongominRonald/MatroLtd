<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SessionController;
use App\Mail\AdminInquiryAlertMail;
use App\Mail\InquiryConfirmationMail;
use App\Models\Category;
use App\Models\HeroSlide;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\OrderNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Public Storefront Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $categories = Category::withCount('products')->orderBy('name')->get();
    $products = Product::with('category')->latest('id')->get();
    $totalStock = Product::sum('stock') ?: 29000;
    $productsCount = Product::count() ?: 28;

    $userInquiries = auth()->check()
        ? Inquiry::where('email', auth()->user()->email)->latest('id')->take(8)->get()
        : collect();

    $userOrders = auth()->check()
        ? Order::where('user_id', auth()->id())->with('items')->latest('id')->take(6)->get()
        : collect();

    $heroSlides = Schema::hasTable('hero_slides')
        ? HeroSlide::where('is_active', true)->orderBy('sort_order')->orderBy('id')->get()
        : collect();

    $currentSessionId = request()->session()->getId();
    $userSessions = auth()->check() && Schema::hasTable('sessions')
        ? DB::table('sessions')
            ->where('user_id', auth()->id())
            ->orderByDesc('last_activity')
            ->get()
            ->map(function ($s) use ($currentSessionId) {
                $deviceInfo = SessionController::parseUserAgent($s->user_agent);

                return (object) [
                    'id' => substr($s->id, 0, 8).'...',
                    'ip_address' => $s->ip_address ?: 'Unknown IP',
                    'is_current' => ($s->id === $currentSessionId),
                    'device_type' => $deviceInfo['device_type'],
                    'browser' => $deviceInfo['browser'],
                    'platform' => $deviceInfo['platform'],
                    'last_active' => Carbon::createFromTimestamp($s->last_activity)->diffForHumans(),
                ];
            })
        : collect();

    return view('index', compact('categories', 'products', 'totalStock', 'productsCount', 'userInquiries', 'userOrders', 'heroSlides', 'userSessions'));
})->name('home');

// Dynamic robots.txt (automatically reflects current domain / custom domain)
Route::get('/robots.txt', function () {
    $lines = [
        'User-agent: *',
        'Allow: /',
        'Disallow: /admin',
        'Disallow: /admin/',
        'Disallow: /account',
        'Disallow: /checkout',
        '',
        'Sitemap: '.url('/sitemap.xml'),
    ];

    return response(implode("\n", $lines)."\n", 200, [
        'Content-Type' => 'text/plain; charset=utf-8',
    ]);
})->name('robots');

// Dynamic XML Sitemap (with Google Image Sitemap extension for Commodity Products)
Route::get('/sitemap.xml', function () {
    $baseUrl = rtrim(url('/'), '/');
    $latestProduct = Schema::hasTable('products') ? Product::latest('updated_at')->first() : null;
    $lastMod = $latestProduct && $latestProduct->updated_at
        ? $latestProduct->updated_at->toAtomString()
        : now()->toAtomString();

    $products = Schema::hasTable('products') ? Product::orderBy('id')->take(50)->get() : collect();

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'."\n";

    // Primary Storefront & Commodity Catalog
    $xml .= '  <url>'."\n";
    $xml .= '    <loc>'.e($baseUrl.'/').'</loc>'."\n";
    $xml .= '    <lastmod>'.e($lastMod).'</lastmod>'."\n";
    $xml .= '    <changefreq>daily</changefreq>'."\n";
    $xml .= '    <priority>1.0</priority>'."\n";
    foreach ($products as $prod) {
        if (! empty($prod->image)) {
            $xml .= '    <image:image>'."\n";
            $xml .= '      <image:loc>'.e(asset($prod->image)).'</image:loc>'."\n";
            $xml .= '      <image:title>'.e($prod->name.' — BRX AGRO GLOBAL').'</image:title>'."\n";
            $xml .= '    </image:image>'."\n";
        }
    }
    $xml .= '  </url>'."\n";

    // Public Buyer Authentication & Registration Pages
    $xml .= '  <url>'."\n";
    $xml .= '    <loc>'.e(route('login')).'</loc>'."\n";
    $xml .= '    <lastmod>'.e($lastMod).'</lastmod>'."\n";
    $xml .= '    <changefreq>monthly</changefreq>'."\n";
    $xml .= '    <priority>0.6</priority>'."\n";
    $xml .= '  </url>'."\n";

    $xml .= '  <url>'."\n";
    $xml .= '    <loc>'.e(route('register')).'</loc>'."\n";
    $xml .= '    <lastmod>'.e($lastMod).'</lastmod>'."\n";
    $xml .= '    <changefreq>monthly</changefreq>'."\n";
    $xml .= '    <priority>0.6</priority>'."\n";
    $xml .= '  </url>'."\n";

    $xml .= '</urlset>';

    return response($xml, 200, [
        'Content-Type' => 'application/xml; charset=utf-8',
    ]);
})->name('sitemap');

// Dynamic Google Merchant Center XML Product Feed (RSS 2.0 + g: namespace)
Route::get('/merchant-feed.xml', function () {
    $baseUrl = rtrim(url('/'), '/');
    $products = Schema::hasTable('products')
        ? Product::with('category')->orderBy('id')->get()
        : collect();

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $xml .= '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">'."\n";
    $xml .= '  <channel>'."\n";
    $xml .= '    <title>'.e(config('company.legal_name', 'BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA')).' — Product Catalog</title>'."\n";
    $xml .= '    <link>'.e($baseUrl.'/').'</link>'."\n";
    $xml .= '    <description>Direct Brazilian Agricultural Commodity Export Catalog — Soybeans, ICUMSA 45 Sugar, Yellow Corn, Arabica Coffee, Edible Oils &amp; Frozen Proteins.</description>'."\n";

    $targetCurrency = strtoupper(request()->query('currency', 'USD'));
    $brlRate = 5.85; // Fixed institutional spot peg for BRL conversion if requested

    foreach ($products as $prod) {
        $productUrl = $baseUrl.'/?product='.urlencode($prod->slug ?: ('item-'.$prod->id)).'#products';
        $rawImage = $prod->image;
        if (! empty($rawImage) && Str::endsWith($rawImage, '.webp')) {
            $jpgCandidate = Str::replaceLast('.webp', '.jpg', $rawImage);
            if (file_exists(public_path($jpgCandidate))) {
                $rawImage = $jpgCandidate;
            }
        }
        $imageUrl = ! empty($rawImage)
            ? (Str::startsWith($rawImage, ['http://', 'https://']) ? $rawImage : asset($rawImage))
            : asset('img/carousel-1.jpg');
        $description = trim((string) ($prod->description ?: ($prod->name.' — Institutional export grade Brazilian agro-commodity supplied by BRX AGRO GLOBAL ('.($prod->unit ?: 'MT').').')));

        $rawPrice = (float) ($prod->price ?: 450.00);
        if ($targetCurrency === 'BRL') {
            $priceFormatted = number_format($rawPrice * $brlRate, 2, '.', '').' BRL';
            $shippingPrice = '0.00 BRL';
        } else {
            $priceFormatted = number_format($rawPrice, 2, '.', '').' USD';
            $shippingPrice = '0.00 USD';
        }

        $availability = ((int) ($prod->stock ?? 100)) > 0 ? 'in_stock' : 'out_of_stock';
        $stockQuantity = (int) ($prod->stock ?? 100);
        $categoryName = $prod->category?->name ?: 'Agricultural Commodities';

        $xml .= '    <item>'."\n";
        $xml .= '      <g:id>'.e('BRX-'.$prod->id).'</g:id>'."\n";
        $xml .= '      <g:title>'.e($prod->name.($prod->unit ? ' ('.$prod->unit.')' : '')).'</g:title>'."\n";
        $xml .= '      <g:description>'.e($description).'</g:description>'."\n";
        $xml .= '      <g:link>'.e($productUrl).'</g:link>'."\n";
        $xml .= '      <g:image_link>'.e($imageUrl).'</g:image_link>'."\n";
        $xml .= '      <g:condition>new</g:condition>'."\n";
        $xml .= '      <g:availability>'.$availability.'</g:availability>'."\n";
        $xml .= '      <g:quantity>'.$stockQuantity.'</g:quantity>'."\n";
        $xml .= '      <g:price>'.e($priceFormatted).'</g:price>'."\n";
        $xml .= '      <g:brand>'.e($prod->brand ?: 'BRX AGRO GLOBAL').'</g:brand>'."\n";
        $xml .= '      <g:identifier_exists>no</g:identifier_exists>'."\n";
        $xml .= '      <g:shipping>'."\n";
        $xml .= '        <g:country>US</g:country>'."\n";
        $xml .= '        <g:service>Maritime Export Freight</g:service>'."\n";
        $xml .= '        <g:price>'.$shippingPrice.'</g:price>'."\n";
        $xml .= '      </g:shipping>'."\n";
        $xml .= '      <g:shipping>'."\n";
        $xml .= '        <g:country>BR</g:country>'."\n";
        $xml .= '        <g:service>Port Dispatch Logistics</g:service>'."\n";
        $xml .= '        <g:price>'.$shippingPrice.'</g:price>'."\n";
        $xml .= '      </g:shipping>'."\n";
        $googleCategory = 'Food, Beverages & Tobacco > Food Items';
        $slug = Str::lower($prod->slug ?: '');
        if (Str::contains($slug, 'coffee')) {
            $googleCategory = 'Food, Beverages & Tobacco > Beverages > Coffee > Coffee Beans';
        } elseif (Str::contains($slug, ['chicken', 'beef', 'lamb', 'meat', 'seafood', 'fish'])) {
            $googleCategory = 'Food, Beverages & Tobacco > Food Items > Meat, Poultry & Seafood';
        } elseif (Str::contains($slug, ['oil'])) {
            $googleCategory = 'Food, Beverages & Tobacco > Food Items > Cooking & Baking Ingredients > Cooking Oils';
        } elseif (Str::contains($slug, ['sugar'])) {
            $googleCategory = 'Food, Beverages & Tobacco > Food Items > Cooking & Baking Ingredients > Sugar & Sweeteners';
        } elseif (Str::contains($slug, ['rice', 'corn', 'soybean', 'bean', 'lentil', 'mung'])) {
            $googleCategory = 'Food, Beverages & Tobacco > Food Items > Grains, Rice & Cereal';
        } elseif (Str::contains($slug, ['almond', 'cashew', 'walnut', 'peanut', 'pistachio', 'nut'])) {
            $googleCategory = 'Food, Beverages & Tobacco > Food Items > Snack Foods > Nuts & Seeds';
        } elseif (Str::contains($slug, ['pepper', 'chilli', 'turmeric', 'cumin', 'cardamom', 'spice'])) {
            $googleCategory = 'Food, Beverages & Tobacco > Food Items > Condiments & Sauces > Spices & Seasonings';
        } elseif (Str::contains($slug, ['milk'])) {
            $googleCategory = 'Food, Beverages & Tobacco > Food Items > Dairy Products';
        }

        $xml .= '      <g:google_product_category>'.e($googleCategory).'</g:google_product_category>'."\n";
        $xml .= '      <g:product_type>'.e('Food, Beverages & Tobacco > Food Items > '.$categoryName).'</g:product_type>'."\n";
        $xml .= '    </item>'."\n";
    }

    $xml .= '  </channel>'."\n";
    $xml .= '</rss>';

    return response($xml, 200, [
        'Content-Type' => 'application/xml; charset=utf-8',
    ]);
})->name('merchant.feed');

// Google Merchant Center Feed Aliases
Route::get('/google-merchant.xml', fn () => redirect()->route('merchant.feed', request()->query(), 301));
Route::get('/google-merchant-feed.xml', fn () => redirect()->route('merchant.feed', request()->query(), 301));
Route::get('/feeds/google-merchant.xml', fn () => redirect()->route('merchant.feed', request()->query(), 301));
Route::get('/feeds/merchant-feed.xml', fn () => redirect()->route('merchant.feed', request()->query(), 301));

// Return & Refund Policy (Google Merchant Center Compliance)
Route::get('/return-policy', function () {
    $path = public_path('return-policy.html');
    if (! file_exists($path)) {
        abort(404);
    }

    return response(file_get_contents($path), 200, [
        'Content-Type' => 'text/html; charset=utf-8',
    ]);
})->name('return.policy');

// Offline PWA Fallback Page
Route::get('/offline', function () {
    $path = public_path('offline.html');
    if (! file_exists($path)) {
        abort(404);
    }

    return response(file_get_contents($path), 200, [
        'Content-Type' => 'text/html; charset=utf-8',
    ]);
})->name('offline');

// Session Management & Device Security Routes
Route::get('/session/status', [SessionController::class, 'status'])->name('session.status');
Route::post('/session/keep-alive', [SessionController::class, 'keepAlive'])->name('session.keep-alive');
Route::middleware('auth')->group(function () {
    Route::get('/session/devices', [SessionController::class, 'devices'])->name('session.devices');
    Route::post('/session/logout-other-devices', [SessionController::class, 'logoutOtherDevices'])->name('session.logout-other-devices');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Account Portal Redirect / Modal Deep Link
Route::get('/account', function () {
    if (! auth()->check()) {
        return redirect()->route('login');
    }
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->to(route('home').'#account');
})->name('account');

// Public Trade & RFQ Inquiry Form Submission
Route::post('/inquiries', function (Request $request) {
    // Honeypot bot protection: if the hidden trap field is filled, silently discard spam
    if ($request->filled('company_website_url')) {
        Log::info('Honeypot blocked automated spam inquiry submission.', [
            'ip' => $request->ip(),
            'email' => $request->input('email'),
        ]);

        $fakeRef = 'AGRO-INQ-'.strtoupper(Str::random(6));

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'reference' => $fakeRef,
                'message' => 'Thank you! Your inquiry (Reference: '.$fakeRef.') has been received. Our trade desk officers in São Paulo will review your specifications and contact you shortly.',
            ]);
        }

        return back()->with('status', 'Thank you! Your inquiry (Reference: '.$fakeRef.') has been received. Our trade desk officers in São Paulo will review your specifications and contact you shortly.');
    }

    $validated = $request->validate([
        'name' => 'required|string|min:2|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'role' => 'nullable|string|max:50',
        'company' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:100',
        'volume' => 'nullable|string|max:100',
        'buyer_detail' => 'nullable|string|max:500',
        'service_type' => 'nullable|string|max:100',
        'grower_detail' => 'nullable|string|max:500',
        'message' => 'nullable|string',
    ], [
        'name.required' => 'Please provide your full name or company representative name.',
        'name.min' => 'Representative name must be at least 2 characters.',
        'email.required' => 'Please enter your corporate email address so our trade desk can send your quotation.',
        'email.email' => 'Please provide a valid corporate email address (e.g., procurement@company.com).',
    ]);

    $detail = $validated['buyer_detail'] ?? $validated['service_type'] ?? $validated['grower_detail'] ?? null;
    $extraInfo = [];
    if (! empty($validated['company'])) {
        $extraInfo[] = 'Company: '.$validated['company'];
    }
    if (! empty($validated['country'])) {
        $extraInfo[] = 'Country: '.$validated['country'];
    }
    if (! empty($validated['volume'])) {
        $extraInfo[] = 'Requested Volume: '.$validated['volume'];
    }
    if (! empty($detail)) {
        $extraInfo[] = 'Requirement: '.$detail;
    }

    $fullMessage = (! empty($extraInfo) ? implode(' | ', $extraInfo)."\n\n" : '').($validated['message'] ?? '');
    $reference = 'AGRO-INQ-'.strtoupper(Str::random(6));

    $inquiry = Inquiry::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'role' => in_array($validated['role'] ?? '', ['buyer', 'partner', 'grower']) ? $validated['role'] : 'buyer',
        'subject' => $detail ? Str::limit($detail, 60) : 'Inquiry from '.$validated['name'],
        'message' => $fullMessage ?: 'No additional message provided.',
        'status' => 'new',
        'is_read' => false,
    ]);

    try {
        Mail::to($validated['email'])->send(new InquiryConfirmationMail($inquiry, $reference));
        $adminEmail = config('services.company.trade_desk_email') ?: 'brxagroglobal@gmail.com';
        Mail::to($adminEmail)->send(new AdminInquiryAlertMail($inquiry, $reference));
    } catch (Throwable $e) {
        Log::warning('Inquiry notification email failed: '.$e->getMessage());
    }

    // Resend API alert dispatch for real-time mobile notifications
    $resendKey = config('services.resend.key') ?: env('RESEND_API_KEY');
    if (! empty($resendKey)) {
        try {
            $fromAddress = config('services.resend.from') ?: env('RESEND_FROM_EMAIL', 'onboarding@resend.dev');
            $fromName = config('mail.from.name', 'BRX AGRO GLOBAL');
            $recipients = array_filter([
                env('RESEND_TEST_RECIPIENT', 'abonga029@gmail.com'),
                config('services.company.trade_desk_email', 'brxagroglobal@gmail.com'),
            ]);
            foreach (array_unique($recipients) as $recipient) {
                Http::timeout(6)
                    ->withToken($resendKey)
                    ->post('https://api.resend.com/emails', [
                        'from' => "{$fromName} <{$fromAddress}>",
                        'to' => [$recipient],
                        'subject' => "[TRADE DESK INQUIRY] Ref: {$reference} — {$inquiry->name}",
                        'html' => "<div style='font-family:sans-serif;padding:20px;'><h3 style='color:#78a22f;'>New Trade Desk Inquiry: {$reference}</h3><p><strong>Name:</strong> {$inquiry->name}<br><strong>Email:</strong> {$inquiry->email}<br><strong>Phone:</strong> {$inquiry->phone}<br><strong>Subject:</strong> {$inquiry->subject}</p><p><strong>Message:</strong><br>".nl2br(e($inquiry->message)).'</p></div>',
                    ]);
            }
        } catch (Throwable $e) {
            Log::warning('Resend inquiry dispatch failed: '.$e->getMessage());
        }
    }

    if ($request->wantsJson() || $request->ajax()) {
        return response()->json([
            'success' => true,
            'reference' => $reference,
            'message' => 'Thank you! Your inquiry (Reference: '.$reference.') has been received. Our trade desk officers in São Paulo will review your specifications and contact you shortly.',
        ]);
    }

    return back()->with('status', 'Thank you! Your inquiry (Reference: '.$reference.') has been received. Our trade desk officers in São Paulo will review your specifications and contact you shortly.');
})->middleware('throttle:10,1')->name('inquiries.store');

// Cookie Governance & LGPD/GDPR Preferences
Route::post('/cookies/consent', function (Request $request) {
    $validated = $request->validate([
        'essential' => 'nullable|boolean',
        'functional' => 'nullable|boolean',
        'analytics' => 'nullable|boolean',
        'marketing' => 'nullable|boolean',
    ]);

    $consent = [
        'essential' => true,
        'functional' => (bool) ($validated['functional'] ?? true),
        'analytics' => (bool) ($validated['analytics'] ?? false),
        'marketing' => (bool) ($validated['marketing'] ?? false),
        'timestamp' => now()->toIso8601String(),
        'version' => '1.0',
    ];

    $cookie = cookie(
        'brx_cookie_consent',
        json_encode($consent),
        525600,
        '/',
        null,
        request()->isSecure(),
        false,
        false,
        'Lax'
    );

    return response()->json([
        'success' => true,
        'message' => 'Your privacy and cookie preferences have been saved.',
        'consent' => $consent,
    ])->withCookie($cookie);
})->name('cookies.consent');

Route::get('/cookies/consent', function (Request $request) {
    $cookieValue = $request->cookie('brx_cookie_consent') ?? $request->cookies->get('brx_cookie_consent');
    if (is_string($cookieValue)) {
        $consent = json_decode($cookieValue, true);
    } else {
        $consent = is_array($cookieValue) ? $cookieValue : null;
    }

    return response()->json([
        'has_consented' => ! empty($consent),
        'consent' => $consent,
    ]);
})->name('cookies.status');

// Public Commodity Cart Checkout & Order Placement (Open to all buyers & institutional clients)
Route::post('/checkout', function (Request $request) {
    $userId = auth()->check() ? auth()->id() : null;

    $validated = $request->validate([
        'customer_name' => 'required|string|min:2|max:255',
        'customer_email' => 'required|email|max:255',
        'customer_phone' => 'nullable|string|max:50',
        'shipping_address' => 'nullable|string|max:500',
        'payment_method' => 'nullable|string|max:100',
        'channel' => 'nullable|string|in:whatsapp,email,both',
        'notes' => 'nullable|string|max:1000',
        'items' => 'required|array|min:1',
        'items.*.name' => 'required|string|max:255',
        'items.*.qty' => 'required|integer|min:1|max:500000',
        'items.*.unit' => 'nullable|string|max:50',
        'items.*.price' => 'nullable|numeric|min:0',
    ], [
        'customer_name.required' => 'Please provide your full name or company representative name.',
        'customer_name.min' => 'Representative name must be at least 2 characters.',
        'customer_email.required' => 'Please provide your corporate email address to receive order receipts and export documentation.',
        'customer_email.email' => 'Please provide a valid corporate email address (e.g., procurement@company.com).',
        'items.required' => 'Your sample cart is empty. Please select at least one commodity lot before checking out.',
        'items.min' => 'Your sample cart is empty. Please select at least one commodity lot before checking out.',
        'items.*.name.required' => 'Each lot item in your cart must have a valid commodity name.',
        'items.*.qty.required' => 'Please specify the quantity for each selected lot.',
        'items.*.qty.min' => 'Quantity must be at least 1 lot/unit.',
        'items.*.qty.max' => 'Maximum sample lot allocation is 500,000 units per order.',
    ]);

    $channel = $validated['channel'] ?? 'both';

    // Commodity wholesale orders have no retail gateway pricing
    $total = 0;
    foreach ($validated['items'] as $item) {
        $price = (float) ($item['price'] ?? 0);
        $total += $price * $item['qty'];
    }

    $channelNote = match ($channel) {
        'whatsapp' => '[Direct Dispatch: Business WhatsApp Device (+55 11 95835-3433)]',
        'email' => '[Direct Dispatch: Business Corporate Email (brxagroglobal@gmail.com)]',
        default => '[Direct Dispatch: Both WhatsApp (+55 11 95835-3433) & Email]',
    };

    $order = Order::create([
        'order_number' => 'BRX-ORD-'.strtoupper(Str::random(6)),
        'user_id' => $userId,
        'customer_name' => $validated['customer_name'],
        'customer_email' => $validated['customer_email'],
        'customer_phone' => $validated['customer_phone'] ?? null,
        'shipping_address' => $validated['shipping_address'] ?? 'Santos / Paranaguá Port Export Dispatch',
        'total_amount' => $total,
        'status' => 'pending',
        'payment_method' => $validated['payment_method'] ?? 'CIF / FOB Destination Logistics',
        'notes' => ! empty($validated['notes']) ? $validated['notes'].' '.$channelNote : 'Wholesale commodity order. '.$channelNote,
    ]);

    foreach ($validated['items'] as $item) {
        $price = (float) ($item['price'] ?? 0);
        $unit = ! empty($item['unit']) ? ' ('.$item['unit'].')' : '';
        OrderItem::create([
            'order_id' => $order->id,
            'product_name' => $item['name'].$unit,
            'price' => $price,
            'quantity' => $item['qty'],
            'subtotal' => $price * $item['qty'],
        ]);
    }

    $order->load('items');

    // Notify company trade desk via selected channel (Email, WhatsApp, or Both)
    $notifications = app(OrderNotificationService::class)->notifyAll($order, $channel);

    $targetDevice = match ($channel) {
        'whatsapp' => 'WhatsApp device (+55 11 95835-3433)',
        'email' => 'Corporate Email (brxagroglobal@gmail.com)',
        default => 'WhatsApp device (+55 11 95835-3433) and Corporate Email (brxagroglobal@gmail.com)',
    };

    return response()->json([
        'success' => true,
        'order_number' => $order->order_number,
        'channel' => $channel,
        'whatsapp_url' => $notifications['whatsapp']['whatsapp_url'] ?? 'https://api.whatsapp.com/send?phone=5511958353433',
        'total' => number_format($total, 2),
        'message' => 'Your commodity order #'.$order->order_number.' has been placed successfully! We have notified our trade desk via '.$targetDevice.', and a trade officer will follow up with you promptly regarding shipping logistics and export documentation.',
        'notifications' => [
            'company_alerted' => ! empty($notifications['company_emails']) || ! empty($notifications['whatsapp']) || $notifications['inquiry_synced'],
            'email_sent' => ! empty($notifications['company_emails']),
            'whatsapp_sent' => ! empty($notifications['whatsapp']),
            'desk_inbox_synced' => $notifications['inquiry_synced'],
        ],
    ]);
})->name('checkout.store');

/*
|--------------------------------------------------------------------------
| Admin Dashboard & Management Routes
|--------------------------------------------------------------------------
| Protected by 'auth' and 'admin' middleware
*/

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('notifications/test', [DashboardController::class, 'sendTestNotification'])->name('notifications.test');

    // Products Management
    Route::resource('products', ProductController::class);

    // Categories Management
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);

    // Hero Carousel Slides Management
    Route::resource('hero-slides', HeroSlideController::class)->except(['show']);
    Route::post('hero-slides/{hero_slide}/toggle-active', [HeroSlideController::class, 'toggleActive'])->name('hero-slides.toggle-active');

    // Order Fulfillment & Tracking
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

    // Inquiries & RFQ Leads
    Route::get('inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
    Route::post('inquiries/{inquiry}/toggle-read', [InquiryController::class, 'toggleRead'])->name('inquiries.toggle-read');
    Route::post('inquiries/{inquiry}/status', [InquiryController::class, 'updateStatus'])->name('inquiries.update-status');

    // Users & Customers Directory
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::post('users/{user}/role', [UserController::class, 'updateRole'])->name('users.update-role');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');

    // Admin Profile & Password Settings
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::put('profile', [UserController::class, 'updateProfile'])->name('profile.update');
});
