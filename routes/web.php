<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Mail\AdminInquiryAlertMail;
use App\Mail\AdminOrderAlertMail;
use App\Mail\InquiryConfirmationMail;
use App\Mail\OrderConfirmationMail;
use App\Models\Category;
use App\Models\HeroSlide;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\OrderNotificationService;
use Illuminate\Http\Request;
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

    return view('index', compact('categories', 'products', 'totalStock', 'productsCount', 'userInquiries', 'userOrders', 'heroSlides'));
})->name('home');

// Dynamic XML Sitemap (with Google Image Sitemap extension for Commodity Products)
Route::get('/sitemap.xml', function () {
    $baseUrl = rtrim(url('/'), '/');
    $latestProduct = Schema::hasTable('products') ? Product::latest('updated_at')->first() : null;
    $lastMod = $latestProduct && $latestProduct->updated_at
        ? $latestProduct->updated_at->toAtomString()
        : now()->toAtomString();

    $products = Schema::hasTable('products') ? Product::orderBy('id')->take(50)->get() : collect();

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

    // Primary Storefront & Commodity Catalog
    $xml .= '  <url>' . "\n";
    $xml .= '    <loc>' . e($baseUrl . '/') . '</loc>' . "\n";
    $xml .= '    <lastmod>' . e($lastMod) . '</lastmod>' . "\n";
    $xml .= '    <changefreq>daily</changefreq>' . "\n";
    $xml .= '    <priority>1.0</priority>' . "\n";
    foreach ($products as $prod) {
        if (! empty($prod->image)) {
            $xml .= '    <image:image>' . "\n";
            $xml .= '      <image:loc>' . e(asset($prod->image)) . '</image:loc>' . "\n";
            $xml .= '      <image:title>' . e($prod->name . ' — BRX AGRO GLOBAL') . '</image:title>' . "\n";
            $xml .= '    </image:image>' . "\n";
        }
    }
    $xml .= '  </url>' . "\n";

    // Public Buyer Authentication & Registration Pages
    $xml .= '  <url>' . "\n";
    $xml .= '    <loc>' . e(route('login')) . '</loc>' . "\n";
    $xml .= '    <lastmod>' . e($lastMod) . '</lastmod>' . "\n";
    $xml .= '    <changefreq>monthly</changefreq>' . "\n";
    $xml .= '    <priority>0.6</priority>' . "\n";
    $xml .= '  </url>' . "\n";

    $xml .= '  <url>' . "\n";
    $xml .= '    <loc>' . e(route('register')) . '</loc>' . "\n";
    $xml .= '    <lastmod>' . e($lastMod) . '</lastmod>' . "\n";
    $xml .= '    <changefreq>monthly</changefreq>' . "\n";
    $xml .= '    <priority>0.6</priority>' . "\n";
    $xml .= '  </url>' . "\n";

    $xml .= '</urlset>';

    return response($xml, 200, [
        'Content-Type' => 'application/xml; charset=utf-8',
    ]);
})->name('sitemap');

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
                'message' => 'Your inquiry has been submitted. Our trade desk will contact you promptly.',
            ]);
        }

        return back()->with('status', 'Inquiry submitted successfully.');
    }

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'role' => 'nullable|string|max:50',
        'company' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:100',
        'buyer_detail' => 'nullable|string|max:500',
        'service_type' => 'nullable|string|max:100',
        'grower_detail' => 'nullable|string|max:500',
        'message' => 'nullable|string',
    ]);

    $detail = $validated['buyer_detail'] ?? $validated['service_type'] ?? $validated['grower_detail'] ?? null;
    $extraInfo = [];
    if (! empty($validated['company'])) {
        $extraInfo[] = 'Company: '.$validated['company'];
    }
    if (! empty($validated['country'])) {
        $extraInfo[] = 'Country: '.$validated['country'];
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
    } catch (\Throwable $e) {
        Log::warning('Inquiry notification email failed: ' . $e->getMessage());
    }

    if ($request->wantsJson() || $request->ajax()) {
        return response()->json([
            'success' => true,
            'reference' => $reference,
            'message' => 'Your inquiry has been submitted. Our trade desk will contact you promptly.',
        ]);
    }

    return back()->with('status', 'Inquiry submitted successfully.');
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
        'message' => 'Cookie consent preferences recorded successfully.',
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

// Public Commodity Cart Checkout & Order Placement (Authenticated Buyers Only)
Route::post('/checkout', function (Request $request) {
    if (! auth()->check()) {
        return response()->json([
            'success' => false,
            'message' => 'Authentication required. Please log in to place a commodity order.',
            'redirect' => route('login'),
        ], 401);
    }

    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'customer_email' => 'required|email|max:255',
        'customer_phone' => 'nullable|string|max:50',
        'shipping_address' => 'nullable|string|max:500',
        'payment_method' => 'nullable|string|max:100',
        'channel' => 'nullable|string|in:whatsapp,email,both',
        'notes' => 'nullable|string',
        'items' => 'required|array|min:1',
        'items.*.name' => 'required|string|max:255',
        'items.*.qty' => 'required|integer|min:1',
        'items.*.unit' => 'nullable|string|max:50',
        'items.*.price' => 'nullable|numeric|min:0',
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
        'user_id' => auth()->id(),
        'customer_name' => $validated['customer_name'],
        'customer_email' => $validated['customer_email'],
        'customer_phone' => $validated['customer_phone'] ?? null,
        'shipping_address' => $validated['shipping_address'] ?? 'Santos / Paranaguá Port Export Dispatch',
        'total_amount' => $total,
        'status' => 'pending',
        'payment_method' => $validated['payment_method'] ?? 'CIF / FOB Destination Logistics',
        'notes' => ! empty($validated['notes']) ? $validated['notes'] . ' ' . $channelNote : 'Wholesale commodity order. ' . $channelNote,
    ]);

    foreach ($validated['items'] as $item) {
        $price = (float) ($item['price'] ?? 0);
        $unit = ! empty($item['unit']) ? ' (' . $item['unit'] . ')' : '';
        OrderItem::create([
            'order_id' => $order->id,
            'product_name' => $item['name'] . $unit,
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
        'message' => 'Your commodity order '.$order->order_number.' has been recorded and automatically dispatched by our backend to the BRX Agro Global '.$targetDevice.'. Company officers have received your notification and will reach out promptly.',
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
