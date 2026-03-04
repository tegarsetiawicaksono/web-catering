<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Order;

echo "=== FINANCE PAGE DEBUG ===\n";
$currentYear = now()->year;
echo "Current Year: " . $currentYear . "\n";
echo "Current Date: " . now()->format('Y-m-d') . "\n\n";

// Replicate FinanceController calculation
$totalIncome = Order::where('status', 'completed')
    ->whereYear('created_at', $currentYear)
    ->sum('total_price');

echo "Total Income (completed, year 2026): Rp " . number_format($totalIncome, 0, ',', '.') . "\n\n";

// Check all completed orders
$completed = Order::where('status', 'completed')->get(['id', 'created_at', 'total_price', 'status']);
echo "All completed orders:\n";
foreach ($completed as $order) {
    echo sprintf(
        "ID: %s | Date: %s | Price: Rp %s | Status: %s\n",
        $order->id,
        $order->created_at->format('Y-m-d'),
        number_format($order->total_price, 0, ',', '.'),
        $order->status
    );
}
