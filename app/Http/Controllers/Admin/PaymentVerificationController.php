<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentVerificationController extends Controller
{
    public function index()
    {
        // Get orders with pending payment verification
        $pendingOrders = Order::whereHas('latestPaymentVerification', function ($query) {
            $query->where('status', 'pending');
        })
        ->with('latestPaymentVerification')
        ->orderBy('created_at', 'desc')
        ->get();

        // Get orders with verified payment
        $verifiedOrders = Order::whereHas('latestPaymentVerification', function ($query) {
            $query->where('status', 'verified');
        })
        ->with('latestPaymentVerification')
        ->orderBy('updated_at', 'desc')
        ->limit(10)
        ->get();

        return view('admin.payment-verifications.index', compact('pendingOrders', 'verifiedOrders'));
    }

    public function verify(Request $request, Order $order)
    {
        \Log::info('Payment verification request', [
            'order_id' => $order->id,
            'action' => $request->action,
            'all_data' => $request->all()
        ]);

        $request->validate([
            'action' => 'required|in:verify,reject',
            'notes' => 'required_if:action,reject|string|max:500'
        ]);

        // Get the latest payment verification
        $verification = $order->latestPaymentVerification;

        if (!$verification) {
            \Log::error('No payment verification found for order: ' . $order->id);
            return back()->with('error', 'Bukti pembayaran tidak ditemukan');
        }

        \Log::info('Found verification', ['verification_id' => $verification->id, 'current_status' => $verification->status]);

        if ($request->action === 'verify') {
            // Use the verifyPayment() method which handles auto-sending invoice
            $verification->verifyPayment();

            return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi! Invoice sudah dikirim ke WhatsApp customer.');
        } else {
            // Update verification status to rejected
            $verification->status = 'rejected';
            $verification->verification_notes = $request->notes;
            $verification->verified_at = now();
            $verification->verified_by = auth()->id();
            $verification->save();

            // Update order payment status
            $order->payment_status = 'rejected';
            $order->save();

            \Log::info('Payment rejected', [
                'order_id' => $order->id, 
                'verification_id' => $verification->id,
                'reason' => $request->notes
            ]);

            return redirect()->back()->with('success', 'Pembayaran ditolak. Customer akan menerima notifikasi.');
        }
    }
}
