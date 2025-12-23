<?php

use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\PopularMenuController;
use Illuminate\Support\Facades\Route;

// Admin Analysis Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin/analysis')->group(function () {
        // Financial Analysis
        Route::get('/finance', [FinanceController::class, 'index'])->name('admin.analysis.finance');
        Route::get('/transactions', [FinanceController::class, 'transactions'])->name('admin.analysis.transactions');
    });
});

// Customer Analysis Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/popular-menu', [PopularMenuController::class, 'index'])->name('analysis.popular-menu');
});