<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopularMenuController extends Controller
{
    public function index()
    {
        // Get most ordered menu items
        $popularMenus = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->select('menus.name', 'menus.image', DB::raw('COUNT(*) as order_count'))
            ->groupBy('menus.id', 'menus.name', 'menus.image')
            ->orderByDesc('order_count')
            ->limit(5)
            ->get();

        // Get category statistics
        $categoryStats = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->select('menus.category', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('menus.category')
            ->orderByDesc('total_orders')
            ->get();

        return view('analysis.popular-menu', compact('popularMenus', 'categoryStats'));
    }
}
