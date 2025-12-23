<?php

namespace App\Http\Controllers\Analysis;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class PopularMenuController extends Controller
{
    // Customer: Menu paling banyak dipesan
    public function index()
    {
        $popularMenus = DB::table('orders')
            ->select(DB::raw('JSON_UNQUOTE(JSON_EXTRACT(items, "$[*].menu_id")) as menu_id'), DB::raw('COUNT(*) as total'))
            ->groupBy('menu_id')
            ->orderByDesc('total')
            ->limit(10)
            ->get();
        return view('analysis.popular', compact('popularMenus'));
    }
}
