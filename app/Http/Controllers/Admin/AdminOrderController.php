<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminOrderController extends Controller
{
    public function dashboard()
    {
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $monthlyRevenue = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');
        $pendingOrders = Order::where('status', 'pending')->count();
        $recentOrders = Order::latest()->take(10)->get();

        return view('admin.index', compact(
            'todayOrders',
            'monthlyRevenue',
            'pendingOrders',
            'recentOrders'
        ));
    }

    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Order $order, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $order->update($validated);

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }

    public function reports(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfDay());

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $totalRevenue = $orders->sum('total_price');
        $ordersByStatus = $orders->groupBy('status')
            ->map(function ($group) {
                return $group->count();
            });

        $popularPackages = Order::whereBetween('created_at', [$startDate, $endDate])
            ->select('package_name', DB::raw('count(*) as total'))
            ->groupBy('package_name')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('admin.reports', compact(
            'orders',
            'totalRevenue',
            'ordersByStatus',
            'popularPackages',
            'startDate',
            'endDate'
        ));
    }
}
