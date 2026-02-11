<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Gallery;

echo "=== GALLERY PAGE CONTROLLER TEST ===\n\n";

// Simulate what the controller does
$category = null; // atau 'buffet', 'tumpeng', dll
$query = Gallery::query();

if ($category) {
    $query->where('category', $category);
}

$galleries = $query->orderByDesc('created_at')->get();

echo "Total galleries retrieved: " . $galleries->count() . "\n\n";

if ($galleries->count() > 0) {
    echo "Galleries that will be shown on /galeri:\n";
    echo str_repeat('-', 80) . "\n";
    foreach ($galleries as $gallery) {
        echo "ID: {$gallery->id}\n";
        echo "Category: {$gallery->category}\n";
        echo "Path: {$gallery->path}\n";
        echo "Full URL: " . asset('storage/' . $gallery->path) . "\n";
        echo "Caption: " . ($gallery->caption ?? 'No caption') . "\n";
        echo "File exists: " . (file_exists(storage_path('app/public/' . $gallery->path)) ? 'YES' : 'NO') . "\n";
        echo str_repeat('-', 80) . "\n";
    }
}

echo "\n=== Test with category filter ===\n";
foreach (['buffet', 'tumpeng', 'nasibox', 'snack'] as $cat) {
    $count = Gallery::where('category', $cat)->count();
    echo "$cat: $count galleries\n";
}
