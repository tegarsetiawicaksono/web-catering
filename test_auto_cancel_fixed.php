<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Auto-Cancel with Fixed Query ===\n\n";

// Create test order with timestamps
$fourDaysAgo = \Carbon\Carbon::now()->copy()->subDays(4);

echo "Creating test order...\n";
echo "Current time: " . \Carbon\Carbon::now() . "\n";
echo "Order will be created at: {$fourDaysAgo}\n\n";

$testOrder = new App\Models\Order([
    'user_id' => 5,
    'customer_name' => 'Test Auto Cancel Fixed',
    'phone' => '08123456789',
    'email' => 'testfixed@autocancel.com',
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
]);

// Manually set timestamps
$testOrder->created_at = $fourDaysAgo;
$testOrder->updated_at = $fourDaysAgo;
$testOrder->save();

echo "✅ Test order created: #{$testOrder->id}\n";
echo "   Created at: {$testOrder->created_at}\n";
echo "   Status: {$testOrder->status}\n\n";

// Test the query
$now = \Carbon\Carbon::now();
$threeDaysAgo = $now->copy()->subDays(3);

echo "Query check:\n";
echo "  Current time: {$now}\n";
echo "  Three days ago threshold: {$threeDaysAgo}\n";
echo "  Order created at: {$testOrder->created_at}\n";
echo "  Order is older? " . ($testOrder->created_at < $threeDaysAgo ? '✅ YES' : '❌ NO') . "\n\n";

// Run the command
echo "Running auto-cancel command...\n";
\Artisan::call('orders:cancel-unpaid');
echo \Artisan::output();

// Check result
$testOrder->refresh();
echo "\nFinal status: {$testOrder->status}\n";

if ($testOrder->status === 'cancelled') {
    echo "✅ SUCCESS! Order was auto-cancelled correctly\n";
} else {
    echo "❌ FAILED! Order status is still: {$testOrder->status}\n";
}

// Cleanup
$testOrder->delete();
echo "\n🗑️  Test order cleaned up\n";

echo "\n=== Test Complete ===\n";
