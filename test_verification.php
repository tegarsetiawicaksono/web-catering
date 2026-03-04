<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$order = \App\Models\Order::find(14);

if (!$order) {
    echo "Order not found\n";
    exit;
}

$verification = $order->latestPaymentVerification;

if(!$verification) {
    echo "No verification found\n";
    exit;
}

echo "Order ID: " . $order->id . "\n";
echo "Verification ID: " . $verification->id . "\n";
echo "Before status: " . $verification->status . "\n";
echo "Before verified_by: " . ($verification->verified_by ?? 'null') . "\n";
echo "Before verified_at: " . ($verification->verified_at ?? 'null') . "\n";

// Update verification
$verification->status = 'verified';
$verification->verified_at = now();
$verification->verified_by = '1';

$saved = $verification->save();

echo "\nSave result: " . ($saved ? 'SUCCESS' : 'FAILED') . "\n";

// Check if actually saved
$verification->refresh();

echo "\nAfter refresh:\n";
echo "Status: " . $verification->status . "\n";
echo "Verified by: " . ($verification->verified_by ?? 'null') . "\n";
echo "Verified at: " . ($verification->verified_at ?? 'null') . "\n";

// Check directly from DB
$dbVerification = \App\Models\PaymentVerification::find($verification->id);
echo "\nDirect from DB:\n";
echo "Status: " . $dbVerification->status . "\n";
echo "Verified by: " . ($dbVerification->verified_by ?? 'null') . "\n";
echo "Verified at: " . ($dbVerification->verified_at ?? 'null') . "\n";
