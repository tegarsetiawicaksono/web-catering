<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('home');
})->name('home');

// Order routes
Route::post('/api/orders', [OrderController::class, 'store']);
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

// Menu pages
Route::get('/menu/buffet', function () {
    return view('menu.buffet.index');
})->name('menu.buffet');

// Checkout page
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

// Dashboard & Profile routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google', [SocialController::class, 'redirect'])->name('google.redirect');
Route::get('auth/google/callback', [SocialController::class, 'callback'])->name('google.callback');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

require __DIR__.'/auth.php';
