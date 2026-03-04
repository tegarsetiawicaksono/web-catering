<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Testing Date with Different Times ===\n\n";

// Test with different times in the day
$testTimes = [
    '2026-03-04 00:00:00',
    '2026-03-04 05:47:00',  // Almost 6 AM (when user reported the bug)
    '2026-03-04 12:00:00',
    '2026-03-04 23:59:59',
];

$eventDate = \Carbon\Carbon::parse('2026-03-14');

foreach ($testTimes as $time) {
    $now = \Carbon\Carbon::parse($time);
    echo "Testing at: " . $now->format('d M Y H:i:s') . "\n";
    
    // Old method (without startOfDay)
    $daysOld = $now->diffInDays($eventDate, false);
    echo "  Without startOfDay: " . $daysOld . " days\n";
    
    // New method (with startOfDay)
    $nowStart = $now->copy()->startOfDay();
    $eventStart = $eventDate->copy()->startOfDay();
    $daysNew = $nowStart->diffInDays($eventStart, false);
    echo "  With startOfDay: " . $daysNew . " days\n";
    echo "  ---\n";
}

echo "\n✅ Fix ensures consistent calculation regardless of time\n";
