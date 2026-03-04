<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        $currentYear = now()->year;

        // Get monthly income for current year
        $monthlyIncome = Order::where('status', 'completed')
            ->whereYear('created_at', $currentYear)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as total'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Calculate totals
        $totalIncome = Order::where('status', 'completed')
            ->whereYear('created_at', $currentYear)
            ->sum('total_price');

        // For now, we'll estimate expenses as a percentage (you can track actual expenses later)
        $estimatedExpenses = $totalIncome * 0.3; // 30% for operational costs
        $netProfit = $totalIncome - $estimatedExpenses;

        // Get recent completed orders
        $recentOrders = Order::where('status', 'completed')
            ->with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.analysis.finance', compact(
            'monthlyIncome',
            'totalIncome',
            'estimatedExpenses',
            'netProfit',
            'recentOrders',
            'currentYear'
        ));
    }

    public function transactions(Request $request)
    {
        $query = Order::with('user')
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc');

        // Filter by date range if provided
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Search by customer name or order ID
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $income = $query->paginate(15);

        // Calculate totals for current page
        $totalAmount = $income->sum('total_price');

        return view('admin.analysis.transactions', compact('income', 'totalAmount'));
    }
}
