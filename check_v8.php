<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$v = App\Models\PaymentVerification::find(8);
echo "Status: " . $v->status . PHP_EOL;
echo "Verified by: " . ($v->verified_by ?? 'null'). PHP_EOL;
echo "Verified at: " . ($v->verified_at ?? 'null') . PHP_EOL;
