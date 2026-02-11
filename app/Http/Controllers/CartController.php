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

        return view('cart.index', [
            'cartItems' => $cartItems
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'package_name' => 'required|string',
            'price' => 'required|numeric'
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
                'quantity' => $request->quantity
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
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $items = $cart->items ?? [];
            foreach ($items as &$item) {
                if ($item['id'] === $id) {
                    $item['quantity'] = $request->quantity;
                    break;
                }
            }

            $cart->update(['items' => $items]);
        }

        return redirect()->route('cart.index')->with('success', 'Jumlah item berhasil diperbarui');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan');
    }
}
