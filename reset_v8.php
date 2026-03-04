<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Reset verification to pending for testing
$v = App\Models\PaymentVerification::find(8);
$v->status = 'pending';
$v->verified_by = null;
$v->verified_at = null;
$v->save();

echo "Verification ID 8 reset to pending\n";
echo "Status: " . $v->status . "\n";
echo "Verified by: " . ($v->verified_by ?? 'null') . "\n";
echo "Verified at: " . ($v->verified_at ?? 'null') . "\n";
