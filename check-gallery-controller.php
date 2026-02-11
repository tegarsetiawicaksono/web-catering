<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Gallery;
use App\Models\Menu;

echo "=== MENU CONTROLLER TEST ===\n\n";

// Test Buffet
echo "BUFFET:\n";
$menus = Menu::where('kategori', 'buffet')->count();
$galleries = Gallery::where('category', 'buffet')->orderBy('created_at', 'desc')->get();

echo "- Menus: $menus\n";
echo "- Galleries: " . $galleries->count() . "\n";
if ($galleries->count() > 0) {
    echo "  Gallery paths:\n";
    foreach ($galleries as $g) {
        echo "  * " . $g->path . " (Caption: " . ($g->caption ?? 'none') . ")\n";
    }
}

echo "\nTUMPENG:\n";
$menus = Menu::where('kategori', 'tumpeng')->count();
$galleries = Gallery::where('category', 'tumpeng')->orderBy('created_at', 'desc')->get();

echo "- Menus: $menus\n";
echo "- Galleries: " . $galleries->count() . "\n";
if ($galleries->count() > 0) {
    echo "  Gallery paths:\n";
    foreach ($galleries as $g) {
        echo "  * " . $g->path . " (Caption: " . ($g->caption ?? 'none') . ")\n";
    }
}

// Check if files exist
echo "\n=== FILE EXISTENCE CHECK ===\n";
foreach (Gallery::all() as $gallery) {
    $fullPath = storage_path('app/public/' . $gallery->path);
    $exists = file_exists($fullPath) ? 'EXISTS' : 'NOT FOUND';
    echo "$exists: $fullPath\n";
}
