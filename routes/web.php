<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentVerificationController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/analysis.php';

Route::get('/', function () {
    return view('home');
})->name('home');

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
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{order}/download-invoice', [OrderController::class, 'downloadInvoice'])->name('orders.download-invoice');
Route::get('/orders/{order}/send-invoice', [OrderController::class, 'sendInvoiceToWhatsApp'])->name('orders.send-invoice');
Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

// Payment Verification routes
Route::post('/payment/{order}/verify', [PaymentVerificationController::class, 'store'])->name('payment.verify');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/payments', [PaymentVerificationController::class, 'adminIndex'])->name('admin.payments.index');
    Route::post('/admin/payments/{verification}/verify', [PaymentVerificationController::class, 'verify'])->name('admin.payments.verify');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('/reports', [AdminOrderController::class, 'reports'])->name('reports');

    // Payment verification
    Route::get('/payment-verifications', [\App\Http\Controllers\Admin\PaymentVerificationController::class, 'index'])->name('payment-verifications.index');
    Route::post('/payment-verifications/{order}/verify', [\App\Http\Controllers\Admin\PaymentVerificationController::class, 'verify'])->name('payment-verifications.verify');
});

// Menu pages
Route::get('/menu/buffet', function () {
    return view('menu.buffet.index');
})->name('menu.buffet');

// Checkout routes - Multi-step
Route::get('/checkout/direct', [App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');
Route::get('/checkout/step-1', [App\Http\Controllers\CheckoutController::class, 'step1'])->name('checkout.step1');
Route::post('/checkout/step-1', [App\Http\Controllers\CheckoutController::class, 'storeStep1'])->name('checkout.step1.store');
Route::get('/checkout/step-2', [App\Http\Controllers\CheckoutController::class, 'step2'])->name('checkout.step2');
Route::post('/checkout/step-2', [App\Http\Controllers\CheckoutController::class, 'storeStep2'])->name('checkout.step2.store');
Route::get('/checkout/step-3', [App\Http\Controllers\CheckoutController::class, 'step3'])->name('checkout.step3');
Route::post('/checkout/store', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/invoice/{order}', [App\Http\Controllers\CheckoutController::class, 'invoice'])->name('checkout.invoice');

// Legacy checkout page
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/menu/tumpeng', function () {
    return view('menu.tumpeng.index');
})->name('menu.tumpeng');

Route::get('/menu/es', function () {
    return view('menu.es.index');
})->name('menu.es');

Route::get('/menu/nasibox', function () {
    return view('menu.nasibox.index');
})->name('menu.nasibox');

Route::get('/menu/snack', function () {
    return view('menu.snack.index');
})->name('menu.snack');

// Dashboard & Profile routes (User only)
// Dashboard route removed - users don't need dashboard, they have order history
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'user'])->name('dashboard');

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Order history
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
});

// Test route tanpa middleware untuk debug
Route::get('/test-orders', function () {
    return 'Route orders berfungsi! User: ' . (auth()->check() ? auth()->user()->name : 'Guest');
});

// Google OAuth Routes
Route::prefix('auth/google')->group(function () {
    Route::get('/', [SocialController::class, 'redirect'])->name('google.redirect');
    Route::get('callback', [SocialController::class, 'callback'])->name('google.callback');
});

Route::get('/admin', [App\Http\Controllers\Admin\AdminOrderController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

require __DIR__ . '/auth.php';
