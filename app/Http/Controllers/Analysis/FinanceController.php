<?php

namespace App\Http\Controllers\Analysis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    // Admin: Uang Masuk
    public function income()
    {
        $income = Order::where('status', 'paid')->sum('total');
        return view('analysis.income', compact('income'));
    }

    // Admin: Uang Keluar (dummy, bisa dihubungkan ke model pengeluaran)
    public function expense()
    {
        $expense = DB::table('expenses')->sum('amount'); // butuh tabel expenses
        return view('analysis.expense', compact('expense'));
    }
}
