<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$order = App\Models\Order::latest()->first();
echo "Order ID: " . $order->id . PHP_EOL;
echo "Payment Status (orders table): " . $order->payment_status . PHP_EOL;

$verification = $order->latestPaymentVerification;
if ($verification) {
    echo "Verification Status (payment_verifications table): " . $verification->status . PHP_EOL;
    echo "Verified At: " . ($verification->verified_at ?? 'NULL') . PHP_EOL;
    echo "Verified By: " . ($verification->verified_by ?? 'NULL') . PHP_EOL;
} else {
    echo "No payment verification found" . PHP_EOL;
}
