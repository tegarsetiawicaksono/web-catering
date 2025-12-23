<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Analysis\FinanceController;
use App\Http\Controllers\Analysis\PopularMenuController;
use App\Http\Controllers\Analysis\SalesReportController;
use App\Http\Controllers\Analysis\TopCustomerController;

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/analysis/income', [FinanceController::class, 'income'])->name('analysis.income');
    Route::get('/analysis/expense', [FinanceController::class, 'expense'])->name('analysis.expense');
    // Grafik penjualan bulanan/tahunan (admin)
    Route::get('/analysis/sales/monthly', [SalesReportController::class, 'monthly'])->name('analysis.sales.monthly');
    Route::get('/analysis/sales/yearly', [SalesReportController::class, 'yearly'])->name('analysis.sales.yearly');
    Route::get('/analysis/top-customers', [TopCustomerController::class, 'index'])->name('analysis.top.customers');
});

// Customer routes
Route::middleware(['auth'])->group(function () {
    Route::get('/analysis/popular', [PopularMenuController::class, 'index'])->name('analysis.popular');
});
