<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Gallery;

echo "=== GALLERY CHECK ===\n\n";
echo "Total galleries: " . Gallery::count() . "\n\n";

if (Gallery::count() > 0) {
    echo "Gallery List:\n";
    echo str_repeat('-', 80) . "\n";
    foreach (Gallery::all() as $gallery) {
        echo "ID: {$gallery->id}\n";
        echo "Category: {$gallery->category}\n";
        echo "Path: {$gallery->path}\n";
        echo "Caption: {$gallery->caption}\n";
        echo "Created: {$gallery->created_at}\n";
        echo str_repeat('-', 80) . "\n";
    }
} else {
    echo "No galleries found in database.\n";
}

echo "\n=== Galleries by category ===\n";
foreach (['buffet', 'tumpeng', 'nasibox', 'snack'] as $cat) {
    $count = Gallery::where('category', $cat)->count();
    echo "$cat: $count galleries\n";
}
