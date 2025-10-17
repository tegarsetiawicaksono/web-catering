<?php

use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Menu pages
Route::get('/menu/prasmanan', function () {
    return view('menu.prasmanan');
})->name('menu.prasmanan');

Route::get('/menu/tumpeng', function () {
    return view('menu.tumpeng');
})->name('menu.tumpeng');

Route::get('/menu/nasibox', function () {
    return view('menu.nasibox');
})->name('menu.nasibox');

Route::get('/menu/snack', function () {
    return view('menu.snack');
})->name('menu.snack');

// new page routes
Route::get('/browse-menu', function () {
    return view('browse-menu');
})->name('browse');

Route::get('/special-offers', function () {
    return view('special-offers');
})->name('offers');

Route::get('/restaurants', function () {
    return view('restaurants');
})->name('restaurants');

Route::get('/track-order', function () {
    return view('track-order');
})->name('track-order');

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
