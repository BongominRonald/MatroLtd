<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

/*
|--------------------------------------------------------------------------
| Public Storefront Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Password::defaults()],
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'customer',
    ]);

    Auth::login($user);

    return redirect('/');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->intended('/');
    }

    return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

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
    if (!empty($validated['company'])) $extraInfo[] = "Company: " . $validated['company'];
    if (!empty($validated['country'])) $extraInfo[] = "Country: " . $validated['country'];
    if (!empty($detail)) $extraInfo[] = "Requirement: " . $detail;

    $fullMessage = (!empty($extraInfo) ? implode(" | ", $extraInfo) . "\n\n" : "") . ($validated['message'] ?? '');

    $inquiry = Inquiry::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'role' => in_array($validated['role'] ?? '', ['buyer', 'partner', 'grower']) ? $validated['role'] : 'buyer',
        'subject' => $detail ? Str::limit($detail, 60) : 'Inquiry from ' . $validated['name'],
        'message' => $fullMessage ?: 'No additional message provided.',
        'status' => 'new',
        'is_read' => false,
    ]);

    if ($request->wantsJson() || $request->ajax()) {
        return response()->json([
            'success' => true,
            'reference' => 'AGRO-INQ-' . strtoupper(Str::random(6)),
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
