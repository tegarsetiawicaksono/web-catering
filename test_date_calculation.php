<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Date Calculation Fix ===\n\n";

// Test dates
$now = \Carbon\Carbon::parse('2026-03-04');
$eventDate = \Carbon\Carbon::parse('2026-03-14');

echo "Current Date: " . $now->format('d M Y') . "\n";
echo "Event Date: " . $eventDate->format('d M Y') . "\n\n";

// Old method (with bug)
$daysOldMethod = $now->diffInDays($eventDate, false);
echo "Old Method (with decimal): " . $daysOldMethod . " days\n";

// New method (fixed)
$nowStart = $now->copy()->startOfDay();
$eventStart = $eventDate->copy()->startOfDay();
$daysNewMethod = $nowStart->diffInDays($eventStart, false);
echo "New Method (start of day): " . $daysNewMethod . " days\n\n";

// Test with Order 14
$order = App\Models\Order::find(14);
if ($order) {
    echo "=== Testing with Order #14 ===\n";
    echo "Event Date: " . $order->event_date->format('d M Y') . "\n";
    
    $eventDate = \Carbon\Carbon::parse($order->event_date)->startOfDay();
    $now = \Carbon\Carbon::now()->startOfDay();
    $daysUntilEvent = $now->diffInDays($eventDate, false);
    
    echo "Days Until Event: " . $daysUntilEvent . " days\n";
    echo "Expected: 10 days\n";
    echo "Result: " . ($daysUntilEvent == 10 ? "✅ CORRECT" : "❌ WRONG") . "\n";
}

echo "\n=== Test Complete ===\n";
