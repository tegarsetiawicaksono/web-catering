<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $package = $request->query('package');
        $name = $request->query('name');
        $price = $request->query('price');
        $minOrder = $request->query('min');

        if (!$package || !$name || !$price || !$minOrder) {
            return redirect()->back()->with('error', 'Invalid package details');
        }

        // Store package info in session
        session([
            'checkout_package' => $package,
            'checkout_name' => $name,
            'checkout_price' => $price,
            'checkout_min' => $minOrder
        ]);

        return redirect()->route('checkout.step1');
    }

    public function step1()
    {
        if (!session('checkout_package')) {
            return redirect()->route('home')->with('error', 'Please select a package first');
        }

        return view('checkout.step1', [
            'name' => session('checkout_name'),
            'price' => session('checkout_price'),
            'minOrder' => session('checkout_min')
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

        return view('checkout.step2', [
            'name' => session('checkout_name'),
            'price' => session('checkout_price'),
            'minOrder' => session('checkout_min')
        ]);
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'event_date' => 'required|date|after:today',
            'event_time' => 'required|date_format:H:i',
            'quantity' => 'required|integer|min:' . session('checkout_min'),
            'notes' => 'nullable|string'
        ]);

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

        return view('checkout.step3', [
            'name' => session('checkout_name'),
            'price' => session('checkout_price'),
            'minOrder' => session('checkout_min'),
            'customer' => $step1,
            'event' => $step2
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:transfer,ewallet,cash',
        ]);

        // Get all session data
        $step1 = session('checkout_step1');
        $step2 = session('checkout_step2');

        if (!$step1 || !$step2) {
            return redirect()->route('checkout.step1')->with('error', 'Session expired. Please start again.');
        }

        $totalPrice = $step2['quantity'] * session('checkout_price');

        $order = Order::create([
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

        return redirect()->route('orders.show', $order);
    }
    public function invoice(Order $order)
    {
        return view('checkout.invoice', compact('order'));
    }
}
