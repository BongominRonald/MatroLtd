<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
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
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
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

    return view('index', compact('categories', 'products', 'totalStock', 'productsCount', 'userInquiries', 'userOrders'));
})->name('home');

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
        $adminEmail = config('mail.from.address') ?: 'info@matogrossoexportltda.com.br';
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
})->name('inquiries.store');

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
        'notes' => 'nullable|string',
        'items' => 'required|array|min:1',
        'items.*.name' => 'required|string|max:255',
        'items.*.qty' => 'required|integer|min:1',
        'items.*.price' => 'nullable|numeric|min:0',
    ]);

    $total = 0;
    foreach ($validated['items'] as $item) {
        $price = (float) ($item['price'] ?? 0);
        $total += $price * $item['qty'];
    }

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
        'notes' => $validated['notes'] ?? 'Order placed via online commodity cart.',
    ]);

    foreach ($validated['items'] as $item) {
        $price = (float) ($item['price'] ?? 0);
        OrderItem::create([
            'order_id' => $order->id,
            'product_name' => $item['name'],
            'price' => $price,
            'quantity' => $item['qty'],
            'subtotal' => $price * $item['qty'],
        ]);
    }

    $order->load('items');

    try {
        Mail::to($validated['customer_email'])->send(new OrderConfirmationMail($order));
        $adminEmail = config('mail.from.address') ?: 'info@matogrossoexportltda.com.br';
        Mail::to($adminEmail)->send(new AdminOrderAlertMail($order));
    } catch (\Throwable $e) {
        Log::warning('Order notification email failed: ' . $e->getMessage());
    }

    return response()->json([
        'success' => true,
        'order_number' => $order->order_number,
        'total' => number_format($total, 2),
        'message' => 'Your commodity sample order '.$order->order_number.' has been recorded. Our trade desk will contact you with shipping documentation.',
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
});
