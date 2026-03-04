<?php
/**
 * Script untuk memperbaiki cart yang existing
 * Menambahkan min_order ke semua cart items yang belum punya
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Cart;
use App\Models\Menu;

echo "🔧 Memperbaiki cart items...\n\n";

$carts = Cart::all();
$totalUpdated = 0;

foreach ($carts as $cart) {
    $items = $cart->items;
    $hasChanges = false;
    
    foreach ($items as &$item) {
        if (!isset($item['min_order'])) {
            $menu = Menu::find($item['id']);
            if ($menu) {
                $item['min_order'] = $menu->min_order;
                $hasChanges = true;
                echo "✓ Updated item '{$item['name']}' with min_order: {$menu->min_order}\n";
            } else {
                echo "⚠ Menu tidak ditemukan untuk item ID: {$item['id']}\n";
            }
        }
    }
    
    if ($hasChanges) {
        $cart->update(['items' => $items]);
        $totalUpdated++;
    }
}

echo "\n✅ Selesai! Total cart yang diupdate: {$totalUpdated}\n";
