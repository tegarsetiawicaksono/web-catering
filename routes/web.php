<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentVerificationController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\GalleryPageController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/analysis.php';

Route::get('/', function () {
    $galleries = \App\Models\Gallery::orderByDesc('created_at')->get();
    $categories = \App\Models\Category::where('is_active', true)->orderBy('order')->orderBy('id')->get();
    return view('home', compact('galleries', 'categories'));
})->name('home');

// Gallery page for users
Route::get('/galeri', [GalleryPageController::class, 'index'])->name('gallery.index');

// Cart routes (User only)
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
});

// Order routes
Route::post('/api/orders', [OrderController::class, 'store']);
Route::middleware('auth')->group(function () {
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
});
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{order}/download-invoice', [OrderController::class, 'downloadInvoice'])->name('orders.download-invoice');
Route::get('/orders/{order}/send-invoice', [OrderController::class, 'sendInvoiceToWhatsApp'])->name('orders.send-invoice');
Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

// Payment Verification routes
Route::post('/payment/{order}/verify', [PaymentVerificationController::class, 'store'])->name('payment.verify');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/payments', [PaymentVerificationController::class, 'adminIndex'])->name('admin.payments.index');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Backward-compatible redirects for old ordering pages.
    Route::redirect('/ordering/categories', '/admin/categories');
    Route::redirect('/ordering/menus', '/admin/menus');
    Route::redirect('/ordering/package-menus', '/admin/menus');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('/reports', [AdminOrderController::class, 'reports'])->name('reports');

    // Menu management
    Route::resource('menus', AdminMenuController::class);

    // Category management
    Route::resource('categories', CategoryController::class);
    Route::post('/categories/{category}/move', [CategoryController::class, 'move'])->name('categories.move');

    // Menu ordering inside existing menu management
    Route::post('/menus/{menu}/move', [AdminMenuController::class, 'move'])->name('menus.move');

    // Bank Account management
    Route::resource('bank-accounts', \App\Http\Controllers\Admin\BankAccountController::class);

    // Payment verification
    Route::get('/payment-verifications', [\App\Http\Controllers\Admin\PaymentVerificationController::class, 'index'])->name('payment-verifications.index');

    // Gallery management
    Route::resource('gallery', GalleryController::class);
    
    // User management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Notifications
    Route::post('/notifications/mark-read', function() {
        auth()->user()->update([
            'last_notification_read_at' => now()
        ]);
        return response()->json(['success' => true]);
    })->name('notifications.mark-read');
});

// Menu pages
Route::get('/menu/buffet', [MenuController::class, 'buffet'])->name('menu.buffet');
Route::get('/menu/tumpeng', [MenuController::class, 'tumpeng'])->name('menu.tumpeng');
Route::get('/menu/nasibox', [MenuController::class, 'nasibox'])->name('menu.nasibox');
Route::get('/menu/nasi-box', [MenuController::class, 'nasibox'])->name('menu.nasi-box');
Route::get('/menu/hampers', [MenuController::class, 'hampers'])->name('menu.hampers');
Route::get('/menu/snack', [MenuController::class, 'snack'])->name('menu.snack');

// Checkout routes - Multi-step
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/from-cart', [App\Http\Controllers\CheckoutController::class, 'fromCart'])->name('checkout.from-cart');
    Route::get('/checkout/direct', [App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');
    Route::get('/checkout/step-1', [App\Http\Controllers\CheckoutController::class, 'step1'])->name('checkout.step1');
    Route::post('/checkout/step-1', [App\Http\Controllers\CheckoutController::class, 'storeStep1'])->name('checkout.step1.store');
    Route::get('/checkout/step-2', [App\Http\Controllers\CheckoutController::class, 'step2'])->name('checkout.step2');
    Route::post('/checkout/step-2', [App\Http\Controllers\CheckoutController::class, 'storeStep2'])->name('checkout.step2.store');
    Route::get('/checkout/step-3', [App\Http\Controllers\CheckoutController::class, 'step3'])->name('checkout.step3');
    Route::post('/checkout/store', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/invoice/{order}', [App\Http\Controllers\CheckoutController::class, 'invoice'])->name('checkout.invoice');
});

// Legacy checkout page
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/menu/es', function () {
    return view('menu.es.index');
})->name('menu.es');

Route::get('/menu/{slug}', [MenuController::class, 'category'])->name('menu.category');

// Dashboard & Profile routes (User only)
// Dashboard route removed - users don't need dashboard, they have order history
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Test route tanpa middleware untuk debug
Route::get('/test-orders', function () {
    return 'Route orders berfungsi! User: ' . (auth()->check() ? auth()->user()->name : 'Guest');
});

// Debug route untuk orders.history tanpa middleware
Route::get('/test-history', function () {
    if (!auth()->check()) {
        return 'Belum login!';
    }
    $orders = \App\Models\Order::where('user_id', auth()->id())->get();
    return view('orders.history', compact('orders'));
});

// CSRF Token Refresh Route for mobile compatibility
Route::get('/refresh-csrf', function () {
    return response()->json([
        'csrf_token' => csrf_token()
    ]);
})->middleware('web');

Route::get('/admin', [App\Http\Controllers\Admin\AdminOrderController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

require __DIR__ . '/auth.php';
