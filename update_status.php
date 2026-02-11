<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$order = App\Models\Order::latest()->first();
$verification = $order->latestPaymentVerification;

if ($verification) {
    echo "Before update:" . PHP_EOL;
    echo "Status: " . $verification->status . PHP_EOL;

    $verification->update([
        'status' => 'verified',
        'verified_at' => now(),
        'verified_by' => 1
    ]);

    $order->update([
        'payment_status' => 'verified',
        'paid_at' => now()
    ]);

    echo PHP_EOL . "After update:" . PHP_EOL;
    echo "Status: " . $verification->fresh()->status . PHP_EOL;
    echo "Verified At: " . $verification->fresh()->verified_at . PHP_EOL;
    echo "Order Payment Status: " . $order->fresh()->payment_status . PHP_EOL;
} else {
    echo "No verification found" . PHP_EOL;
}
