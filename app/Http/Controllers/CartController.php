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
        $cartItems = Cart::where('user_id', Auth::id())->with('menu')->get();
        
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

        // Check if item already exists in cart
        $existingItem = Cart::where('user_id', Auth::id())
            ->where('menu_id', $request->menu_id)
            ->first();

        if ($existingItem) {
            $existingItem->update([
                'quantity' => $existingItem->quantity + $request->quantity
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'menu_id' => $request->menu_id,
                'quantity' => $request->quantity,
                'package_name' => $request->package_name,
                'price' => $request->price
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Menu berhasil ditambahkan ke keranjang');
    }

    public function destroy($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cart.index')->with('success', 'Jumlah item berhasil diperbarui');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan');
    }
}