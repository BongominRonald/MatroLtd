<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Public Storefront Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $categories = Category::withCount('products')->get();
    $products = Product::with('category')->latest('id')->take(8)->get();
    $totalStock = Product::sum('stock') ?: 2500;
    $productsCount = Product::count() ?: 8;

    return view('index', compact('categories', 'products', 'totalStock', 'productsCount'));
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

    Inquiry::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'role' => in_array($validated['role'] ?? '', ['buyer', 'partner', 'grower']) ? $validated['role'] : 'buyer',
        'subject' => $detail ? Str::limit($detail, 60) : 'Inquiry from '.$validated['name'],
        'message' => $fullMessage ?: 'No additional message provided.',
        'status' => 'new',
        'is_read' => false,
    ]);

    if ($request->wantsJson() || $request->ajax()) {
        return response()->json([
            'success' => true,
            'reference' => 'AGRO-INQ-'.strtoupper(Str::random(6)),
            'message' => 'Your inquiry has been submitted. Our trade desk will contact you promptly.',
        ]);
    }

    return back()->with('status', 'Inquiry submitted successfully.');
})->name('inquiries.store');

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
