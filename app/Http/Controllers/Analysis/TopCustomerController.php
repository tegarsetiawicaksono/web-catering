<?php

namespace App\Http\Controllers\Analysis;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class TopCustomerController extends Controller
{
    // Laporan pelanggan paling aktif
    public function index()
    {
        $topCustomers = Order::select('user_id', DB::raw('COUNT(*) as total'))
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(10)
            ->get();
        return view('analysis.top_customers', compact('topCustomers'));
    }
}
