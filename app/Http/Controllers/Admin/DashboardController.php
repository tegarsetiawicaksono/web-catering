<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Monthly sales data for current year
        $currentYear = Carbon::now()->year;
        $monthlySales = [];
        $monthlyRevenue = [];

        for ($month = 1; $month <= 12; $month++) {
            $orders = Order::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->get();

            $monthlySales[] = $orders->count();
            $monthlyRevenue[] = $orders->sum('total_price');
        }

        // Yearly comparison data
        $yearlyData = [];
        for ($year = $currentYear - 2; $year <= $currentYear; $year++) {
            $yearlyData[] = [
                'year' => $year,
                'orders' => Order::whereYear('created_at', $year)->count(),
                'revenue' => Order::whereYear('created_at', $year)->sum('total_price')
            ];
        }

        return view('admin.dashboard', [
            'todayOrders' => Order::whereDate('created_at', Carbon::today())->count(),
            'currentYearRevenue' => Order::whereYear('created_at', Carbon::now()->year)
                ->sum('total_price'),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'recentOrders' => Order::latest()->take(10)->get(),
            'monthlySales' => $monthlySales,
            'monthlyRevenueData' => $monthlyRevenue,
            'yearlyData' => $yearlyData,
            'currentYear' => $currentYear,
            // DP Statistics
            'dpPaidOrders' => Order::where('payment_status', 'dp_paid')->count(),
            'fullyPaidOrders' => Order::where('payment_status', 'fully_paid')->count(),
            'dpReceivedAmount' => Order::where('payment_status', 'dp_paid')->sum('paid_amount'),
            'awaitingPayment' => Order::where('payment_status', 'dp_paid')->sum('remaining_amount'),
        ]);
    }
}
