<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $package = $request->query('package');
        $name = $request->query('name');
        $price = $request->query('price');
        $minOrder = $request->query('min');
        $menuId = $request->query('menu_id');

        if (!$package || !$name || !$price || !$minOrder) {
            return redirect()->back()->with('error', 'Invalid package details');
        }

        // Ambil gambar dari database jika ada menu_id
        $image = null;
        if ($menuId) {
            $menu = \App\Models\Menu::find($menuId);
            $image = $menu ? $menu->gambar : null;
        }

        // Clear any cart checkout session - ini checkout LANGSUNG dari menu
        session()->forget(['checkout_from_cart', 'checkout_step1', 'checkout_step2']);

        // Store package info in session untuk direct checkout
        session([
            'checkout_package' => $package,
            'checkout_name' => $name,
            'checkout_price' => $price,
            'checkout_min' => $minOrder,
            'checkout_image' => $image,
            'checkout_direct' => true  // Flag untuk direct checkout
        ]);

        return redirect()->route('checkout.step1');
    }

    public function fromCart()
    {
        // Checkout dari keranjang
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if (!$cart || empty($cart->items)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }

        // Clear any direct checkout session - ini checkout dari KERANJANG
        session()->forget(['checkout_package', 'checkout_name', 'checkout_price', 'checkout_min', 'checkout_direct', 'checkout_step1', 'checkout_step2']);

        // Set flag bahwa ini checkout dari cart
        session(['checkout_from_cart' => true]);
        
        return redirect()->route('checkout.step1');
    }

    public function step1()
    {
        // Cek apakah checkout dari cart atau langsung
        $fromCart = session('checkout_from_cart', false);
        
        if (!$fromCart && !session('checkout_package')) {
            return redirect()->route('home')->with('error', 'Please select a package first');
        }

        // Jika dari cart, ambil data cart
        if ($fromCart) {
            $cart = Cart::where('user_id', Auth::id())->first();
            
            if (!$cart || empty($cart->items)) {
                return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
            }
            
            return view('checkout.step1', [
                'fromCart' => true,
                'cartItems' => $cart->items,
                'name' => null,
                'price' => null,
                'minOrder' => null
            ]);
        }
        
        // Jika checkout langsung (single item)
        return view('checkout.step1', [
            'fromCart' => false,
            'cartItems' => null,
            'name' => session('checkout_name'),
            'price' => session('checkout_price'),
            'minOrder' => session('checkout_min'),
            'image' => session('checkout_image')
        ]);
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'email' => 'required|email',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'street_address' => 'required|string',
        ]);

        session(['checkout_step1' => $validated]);

        return redirect()->route('checkout.step2');
    }

    public function step2()
    {
        if (!session('checkout_step1')) {
            return redirect()->route('checkout.step1')->with('error', 'Please complete step 1 first');
        }

        $fromCart = session('checkout_from_cart', false);

        if ($fromCart) {
            $cart = Cart::where('user_id', Auth::id())->first();
            
            return view('checkout.step2', [
                'fromCart' => true,
                'cartItems' => $cart->items ?? [],
                'name' => null,
                'price' => null,
                'minOrder' => null
            ]);
        }

        return view('checkout.step2', [
            'fromCart' => false,
            'cartItems' => null,
            'name' => session('checkout_name'),
            'price' => session('checkout_price'),
            'minOrder' => session('checkout_min'),
            'image' => session('checkout_image')
        ]);
    }

    public function storeStep2(Request $request)
    {
        $fromCart = session('checkout_from_cart', false);
        
        if ($fromCart) {
            // Untuk cart checkout, tidak perlu quantity
            $validated = $request->validate([
                'event_date' => 'required|date|after:today',
                'event_time' => 'required|date_format:H:i',
                'notes' => 'nullable|string'
            ]);
        } else {
            // Untuk direct checkout, perlu quantity
            $validated = $request->validate([
                'event_date' => 'required|date|after:today',
                'event_time' => 'required|date_format:H:i',
                'quantity' => 'required|integer|min:' . session('checkout_min'),
                'notes' => 'nullable|string'
            ]);
        }

        session(['checkout_step2' => $validated]);

        return redirect()->route('checkout.step3');
    }

    public function step3()
    {
        if (!session('checkout_step2')) {
            return redirect()->route('checkout.step2')->with('error', 'Please complete step 2 first');
        }

        $step1 = session('checkout_step1');
        $step2 = session('checkout_step2');
        $fromCart = session('checkout_from_cart', false);

        if ($fromCart) {
            $cart = Cart::where('user_id', Auth::id())->first();
            
            return view('checkout.step3', [
                'fromCart' => true,
                'cartItems' => $cart->items ?? [],
                'name' => null,
                'price' => null,
                'minOrder' => null,
                'customer' => $step1,
                'event' => $step2,
                'bankAccounts' => \App\Models\BankAccount::where('is_active', true)->get()
            ]);
        }

        return view('checkout.step3', [
            'fromCart' => false,
            'cartItems' => null,
            'name' => session('checkout_name'),
            'price' => session('checkout_price'),
            'minOrder' => session('checkout_min'),
            'image' => session('checkout_image'),
            'customer' => $step1,
            'event' => $step2,
            'bankAccounts' => \App\Models\BankAccount::where('is_active', true)->get()
        ]);
    }

    public function store(Request $request)
    {
        // Get valid payment methods from database
        $activeBankNames = \App\Models\BankAccount::where('is_active', true)
            ->pluck('bank_name')
            ->toArray();
        
        // Add 'cash' to valid payment methods
        $validPaymentMethods = array_merge($activeBankNames, ['cash']);
        
        $validated = $request->validate([
            'payment_method' => 'required|in:' . implode(',', $validPaymentMethods),
        ]);

        // Get all session data
        $step1 = session('checkout_step1');
        $step2 = session('checkout_step2');
        $fromCart = session('checkout_from_cart', false);

        if (!$step1 || !$step2) {
            return redirect()->route('checkout.step1')->with('error', 'Session expired. Please start again.');
        }

        // Validasi untuk pembayaran cash: event harus minimal 7 hari dari sekarang
        if ($validated['payment_method'] === 'cash') {
            $eventDate = Carbon::parse($step2['event_date']);
            $minDate = Carbon::now()->addDays(7);
            
            if ($eventDate->lt($minDate)) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['payment_method' => 'Pembayaran tunai memerlukan konfirmasi pembayaran DP/Lunas minimal 7 hari sebelum tanggal acara. Silakan pilih tanggal acara minimal ' . $minDate->format('d M Y') . ' atau pilih metode transfer bank.']);
            }
        }

        if ($fromCart) {
            // Checkout dari cart - multiple items
            $cart = Cart::where('user_id', Auth::id())->first();
            
            if (!$cart || empty($cart->items)) {
                return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
            }

            // Hitung total dari semua items
            $totalPrice = collect($cart->items)->sum(function($item) {
                return $item['price'] * $item['quantity'];
            });

            // Gabungkan semua items menjadi string untuk package_name
            $packageNames = collect($cart->items)->pluck('name')->join(', ');
            $totalQuantity = collect($cart->items)->sum('quantity');

            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $step1['customer_name'],
                'phone' => $step1['phone'],
                'email' => $step1['email'],
                'province' => $step1['province'],
                'city' => $step1['city'],
                'district' => $step1['district'],
                'street_address' => $step1['street_address'],
                'event_date' => Carbon::parse($step2['event_date'])->toDateString(),
                'event_time' => Carbon::parse($step2['event_time'])->format('H:i:s'),
                'package_name' => $packageNames,
                'package_price' => 0, // Tidak applicable untuk multiple items
                'quantity' => $totalQuantity,
                'total_price' => $totalPrice,
                'notes' => $step2['notes'] ?? null,
                'payment_method' => $validated['payment_method'],
                'status' => 'pending',
                'items' => $cart->items // Simpan detail items
            ]);

            // Clear cart dan session
            $cart->delete();
            session()->forget(['checkout_from_cart', 'checkout_step1', 'checkout_step2']);

        } else {
            // Checkout langsung - single item
            $totalPrice = $step2['quantity'] * session('checkout_price');

            $order = Order::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'customer_name' => $step1['customer_name'],
                'phone' => $step1['phone'],
                'email' => $step1['email'],
                'province' => $step1['province'],
                'city' => $step1['city'],
                'district' => $step1['district'],
                'street_address' => $step1['street_address'],
                'event_date' => Carbon::parse($step2['event_date'])->toDateString(),
                'event_time' => Carbon::parse($step2['event_time'])->format('H:i:s'),
                'package_name' => session('checkout_name'),
                'package_price' => session('checkout_price'),
                'quantity' => $step2['quantity'],
                'total_price' => $totalPrice,
                'notes' => $step2['notes'] ?? null,
                'payment_method' => $validated['payment_method'],
                'status' => 'pending'
            ]);

            // Clear session data
            session()->forget(['checkout_package', 'checkout_name', 'checkout_price', 'checkout_min', 'checkout_step1', 'checkout_step2']);
        }

        return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat! Silakan upload bukti pembayaran untuk melanjutkan.');
    }
    public function invoice(Order $order)
    {
        return view('checkout.invoice', compact('order'));
    }
}
