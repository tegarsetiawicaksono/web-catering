<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Auto-Cancel Command with Test Data ===\n\n";

// Create a test order that's 4 days old without payment
$fourDaysAgo = \Carbon\Carbon::now()->subDays(4);

$testOrder = App\Models\Order::create([
    'user_id' => 5, // Adjust based on your user
    'customer_name' => 'Test Auto Cancel',
    'phone' => '08123456789',
    'email' => 'test@autocancel.com',
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

echo "✅ Created test order #{$testOrder->id}\n";
echo "   Created: {$fourDaysAgo->format('d M Y H:i')} (4 days ago)\n";
echo "   Customer: {$testOrder->customer_name}\n";
echo "   Status: {$testOrder->status}\n";
echo "   Has payment: " . ($testOrder->latestPaymentVerification ? 'Yes' : 'No') . "\n\n";

// Run the command
echo "Running auto-cancel command...\n";
\Artisan::call('orders:cancel-unpaid');
echo \Artisan::output();

// Check the order status
$testOrder->refresh();
echo "\nOrder #{$testOrder->id} status after command: {$testOrder->status}\n";

if ($testOrder->status === 'cancelled') {
    echo "✅ SUCCESS! Order was auto-cancelled\n";
} else {
    echo "❌ FAILED! Order was NOT cancelled\n";
}

// Cleanup - delete test order
$testOrder->delete();
echo "\n🗑️  Test order deleted\n";

echo "\n=== Test Complete ===\n";
