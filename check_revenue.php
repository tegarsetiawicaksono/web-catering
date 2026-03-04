<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Order;

echo "=== REVENUE DEBUG ===\n";
echo "Total Orders: " . Order::count() . "\n";
echo "Orders Maret 2026: " . Order::whereMonth('created_at', 3)->whereYear('created_at', 2026)->count() . "\n";
$marchRevenue = Order::whereMonth('created_at', 3)->whereYear('created_at', 2026)->sum('total_price');
echo "Revenue Maret 2026: Rp " . number_format($marchRevenue, 0, ',', '.') . "\n\n";

echo "Latest 5 orders:\n";
$orders = Order::latest()->take(5)->get(['id', 'created_at', 'total_price', 'status', 'payment_status']);
foreach ($orders as $order) {
    echo sprintf(
        "ID: %s | Date: %s | Price: Rp %s | Status: %s | Payment: %s\n",
        $order->id,
        $order->created_at->format('Y-m-d H:i'),
        number_format($order->total_price, 0, ',', '.'),
        $order->status,
        $order->payment_status ?? 'N/A'
    );
}
