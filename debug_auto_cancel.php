<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Debugging Auto-Cancel Query ===\n\n";

// Create test order
$fourDaysAgo = \Carbon\Carbon::now()->subDays(4);

$testOrder = App\Models\Order::create([
    'user_id' => 5,
    'customer_name' => 'Test Debug Cancel',
    'phone' => '08123456789',
    'email' => 'debug@autocancel.com',
    'street_address' => 'Test Address',
    'province' => 'Jawa Tengah',
    'city' => 'Kab. Kendal',
    'district' => 'Weleri',
    'event_date' => \Carbon\Carbon::now()->addDays(15),
    'event_time' => '10:00:00',
    'quantity' => 100,
    'payment_method' => 'BCA',
    'package_name' => 'Test Package',
    'package_price' => 30000,
    'total_price' => 3000000,
    'status' => 'pending',
    'payment_status' => 'unpaid',
    'created_at' => $fourDaysAgo,
    'updated_at' => $fourDaysAgo,
]);

echo "Test order created: #{$testOrder->id}\n";
echo "Created at: {$testOrder->created_at}\n";
echo "Status: {$testOrder->status}\n\n";

// Test step by step
$now = \Carbon\Carbon::now();
$threeDaysAgo = $now->subDays(3);

echo "Current time: {$now}\n";
echo "Three days ago: {$threeDaysAgo}\n";
echo "Order created: {$testOrder->created_at}\n";
echo "Is order older than 3 days? " . ($testOrder->created_at < $threeDaysAgo ? 'YES' : 'NO') . "\n\n";

// Check status = pending
$step1 = App\Models\Order::where('status', 'pending')->where('id', $testOrder->id)->count();
echo "Step 1 - Status = pending: {$step1}\n";

// Check created_at < 3 days ago
$step2 = App\Models\Order::where('status', 'pending')
    ->where('id', $testOrder->id)
    ->where('created_at', '<', $threeDaysAgo)
    ->count();
echo "Step 2 - Created < 3 days ago: {$step2}\n";

// Check doesn't have payment verifications
$step3 = App\Models\Order::where('status', 'pending')
    ->where('id', $testOrder->id)
    ->where('created_at', '<', $threeDaysAgo)
    ->whereDoesntHave('paymentVerifications')
    ->count();
echo "Step 3 - No payment verifications: {$step3}\n\n";

// Check payment verification count
$paymentCount = $testOrder->paymentVerifications()->count();
echo "Payment verifications count: {$paymentCount}\n\n";

// Get all matching orders
$orders = App\Models\Order::where('status', 'pending')
    ->where('created_at', '<', $threeDaysAgo)
    ->whereDoesntHave('paymentVerifications')
    ->get();

echo "Total matching orders: {$orders->count()}\n";
foreach ($orders as $order) {
    echo "  - Order #{$order->id}: {$order->customer_name}\n";
}

// Cleanup
$testOrder->delete();
echo "\n🗑️  Test order deleted\n";
