<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Authentication is handled in routes

    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItems = $cart ? $cart->items : [];

        // Enrich cart items dengan min_order dan gambar dari database jika belum ada
        $needsUpdate = false;
        foreach ($cartItems as &$item) {
            $menu = null;
            
            if (!isset($item['min_order']) || !isset($item['image'])) {
                $menu = Menu::find($item['id']);
            }
            
            if (!isset($item['min_order'])) {
                if ($menu) {
                    $item['min_order'] = $menu->min_order;
                    $needsUpdate = true;
                } else {
                    $item['min_order'] = 1; // default fallback
                }
            }
            
            if (!isset($item['image'])) {
                if ($menu) {
                    $item['image'] = $menu->gambar;
                    $needsUpdate = true;
                } else {
                    $item['image'] = null; // default fallback
                }
            }
        }

        // Update cart jika ada perubahan
        if ($needsUpdate && $cart) {
            $cart->update(['items' => $cartItems]);
        }

        return view('cart.index', [
            'cartItems' => $cartItems
        ]);
    }

    public function store(Request $request)
    {
        // Ambil menu untuk validasi min_order
        $menu = Menu::find($request->menu_id);
        
        if (!$menu) {
            return redirect()->back()->with('error', 'Menu tidak ditemukan');
        }

        $request->validate([
            'menu_id' => 'required|string',
            'quantity' => 'required|integer|min:' . $menu->min_order,
            'package_name' => 'required|string',
            'price' => 'required|numeric'
        ], [
            'quantity.min' => 'Minimal pemesanan adalah ' . $menu->min_order . ' porsi'
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()], ['items' => []]);
        $items = $cart->items ?? [];

        // Check if item already exists
        $found = false;
        foreach ($items as &$item) {
            if ($item['id'] === $request->menu_id) {
                $item['quantity'] += $request->quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $items[] = [
                'id' => $request->menu_id,
                'name' => $request->package_name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'min_order' => $menu->min_order,
                'image' => $menu->gambar
            ];
        }

        $cart->update(['items' => $items]);

        return redirect()->route('cart.index')->with('success', 'Menu berhasil ditambahkan ke keranjang');
    }

    public function destroy($id)
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $items = $cart->items ?? [];
            $items = array_filter($items, function ($item) use ($id) {
                return $item['id'] !== $id;
            });

            $cart->update(['items' => array_values($items)]);
        }

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Keranjang tidak ditemukan');
        }

        // Cari item di cart untuk mendapatkan min_order
        $items = $cart->items ?? [];
        $minOrder = 1;
        
        foreach ($items as $item) {
            if ($item['id'] === $id) {
                $minOrder = $item['min_order'] ?? 1;
                
                // Jika min_order tidak ada di cart, ambil dari menu
                if (!isset($item['min_order'])) {
                    $menu = Menu::find($id);
                    $minOrder = $menu ? $menu->min_order : 1;
                }
                break;
            }
        }

        $request->validate([
            'quantity' => 'required|integer|min:' . $minOrder
        ], [
            'quantity.min' => 'Minimal pemesanan adalah ' . $minOrder . ' porsi'
        ]);

        // Update quantity
        foreach ($items as &$item) {
            if ($item['id'] === $id) {
                $item['quantity'] = $request->quantity;
                
                // Pastikan min_order ada di item
                if (!isset($item['min_order'])) {
                    $item['min_order'] = $minOrder;
                }
                break;
            }
        }

        $cart->update(['items' => $items]);

        return redirect()->route('cart.index')->with('success', 'Jumlah item berhasil diperbarui');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan');
    }
}
