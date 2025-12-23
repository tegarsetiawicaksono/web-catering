<?php

namespace App\Http\Controllers\Analysis;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    // Grafik penjualan bulanan
    public function monthly()
    {
        $sales = Order::select(DB::raw('MONTH(order_date) as month'), DB::raw('SUM(total) as total'))
            ->whereYear('order_date', date('Y'))
            ->groupBy('month')
            ->get();
        return view('analysis.sales_monthly', compact('sales'));
    }

    // Grafik penjualan tahunan
    public function yearly()
    {
        $sales = Order::select(DB::raw('YEAR(order_date) as year'), DB::raw('SUM(total) as total'))
            ->groupBy('year')
            ->get();
        return view('analysis.sales_yearly', compact('sales'));
    }
}
