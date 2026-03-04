<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Auto-Cancel Logic ===\n\n";

// Test 1: Check current pending orders
$pendingOrders = App\Models\Order::where('status', 'pending')->get();
echo "Total pending orders: " . $pendingOrders->count() . "\n\n";

// Test 2: Check orders without payment verification
$ordersWithoutPayment = App\Models\Order::where('status', 'pending')
    ->whereDoesntHave('paymentVerifications')
    ->get();

echo "Orders without payment verification:\n";
foreach ($ordersWithoutPayment as $order) {
    $daysOld = \Carbon\Carbon::now()->diffInDays($order->created_at);
    echo "  - Order #{$order->id}: Created {$daysOld} days ago ({$order->created_at->format('d M Y H:i')})\n";
}

// Test 3: Check which orders would be auto-cancelled (> 3 days old without payment)
$threeDaysAgo = \Carbon\Carbon::now()->subDays(3);
$toBeCancelled = App\Models\Order::where('status', 'pending')
    ->where('created_at', '<', $threeDaysAgo)
    ->whereDoesntHave('paymentVerifications')
    ->get();

echo "\n\nOrders that would be auto-cancelled (>3 days old, no payment):\n";
if ($toBeCancelled->isEmpty()) {
    echo "  ✅ None - All orders either paid or within 3 days\n";
} else {
    foreach ($toBeCancelled as $order) {
        $daysOld = \Carbon\Carbon::now()->diffInDays($order->created_at);
        echo "  ❌ Order #{$order->id}: {$daysOld} days old, customer: {$order->customer_name}\n";
    }
}

// Test 4: Check orders with payment (should NOT be cancelled)
$ordersWithPayment = App\Models\Order::where('status', 'pending')
    ->whereHas('paymentVerifications')
    ->get();

echo "\n\nOrders with payment (safe from auto-cancel):\n";
foreach ($ordersWithPayment as $order) {
    $daysOld = \Carbon\Carbon::now()->diffInDays($order->created_at);
    $paymentStatus = $order->latestPaymentVerification ? $order->latestPaymentVerification->status : 'none';
    echo "  ✅ Order #{$order->id}: {$daysOld} days old, payment status: {$paymentStatus}\n";
}

echo "\n=== Test Complete ===\n";
