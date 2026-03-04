<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Payment Verification Fix ===\n\n";

// Get order and verification
$order = App\Models\Order::find(14);
$verification = $order->latestPaymentVerification;

echo "Initial State:\n";
echo "Order ID: " . $order->id . "\n";
echo "Order Status: " . $order->status . "\n";
echo "Payment Status: " . $order->payment_status . "\n";
echo "Verification ID: " . $verification->id . "\n";
echo "Verification Status: " . $verification->status . "\n\n";

// Simulate what the controller does
echo "Simulating verification process...\n";

$verification->status = 'verified';
$verification->verified_at = now();
$verification->verified_by = '1'; // Admin user ID
$saved = $verification->save();

echo "Verification save result: " . ($saved ? 'SUCCESS' : 'FAILED') . "\n\n";

// Update order
$order->payment_status = 'verified';
$order->paid_at = now();

if ($order->status === 'pending') {
    $order->status = 'confirmed';
}

$orderSaved = $order->save();
echo "Order save result: " . ($orderSaved ? 'SUCCESS' : 'FAILED') . "\n\n";

// Refresh and check
$verification->refresh();
$order->refresh();
$order->load('latestPaymentVerification');

echo "Final State:\n";
echo "Order Status: " . $order->status . "\n";
echo "Order Payment Status: " . $order->payment_status . "\n";
echo "Verification Status: " . $verification->status . "\n";
echo "Verification verified_by: " . ($verification->verified_by ?? 'null') . "\n";
echo "Verification verified_at: " . ($verification->verified_at ?? 'null') . "\n";
echo "Latest Payment Verification Status: " . $order->latestPaymentVerification->status . "\n\n";

echo "=== Test Complete ===\n";

// Check if order would still appear in pending list 
$pendingOrders = App\Models\Order::whereHas('latestPaymentVerification', function ($query) {
    $query->where('status', 'pending');
})->get();

echo "\nOrders with pending payment verification: " . $pendingOrders->count() . "\n";
echo "Order 14 in pending list: " . ($pendingOrders->contains('id', 14) ? 'YES (BAD!)' : 'NO (GOOD!)') . "\n";
