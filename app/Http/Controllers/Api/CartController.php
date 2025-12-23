<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Get user's cart
     */
    public function index()
    {
        if (!Auth::check()) {
            return response()->json(['items' => []], 200);
        }

        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            return response()->json(['items' => []], 200);
        }

        return response()->json([
            'items' => $cart->items ?? []
        ], 200);
    }

    /**
     * Update user's cart
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'items' => 'required|array'
        ]);

        $cart = Cart::updateOrCreate(
            ['user_id' => Auth::id()],
            ['items' => $request->items]
        );

        return response()->json([
            'success' => true,
            'items' => $cart->items
        ], 200);
    }

    /**
     * Clear user's cart
     */
    public function destroy()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared'
        ], 200);
    }
}
