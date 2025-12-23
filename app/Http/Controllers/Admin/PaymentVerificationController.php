<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentVerificationController extends Controller
{
    public function index()
    {
        $pendingOrders = Order::where('payment_status', 'pending')
            ->whereNotNull('payment_proof')
            ->orderBy('created_at', 'desc')
            ->get();

        $verifiedOrders = Order::whereIn('payment_status', ['verified', 'paid'])
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.payment-verifications.index', compact('pendingOrders', 'verifiedOrders'));
    }

    public function verify(Request $request, Order $order)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'rejection_reason' => 'required_if:action,reject|string|max:500'
        ]);

        if ($request->action === 'approve') {
            $order->update([
                'payment_status' => 'verified',
                'paid_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil diverifikasi'
            ]);
        } else {
            $order->update([
                'payment_status' => 'rejected',
                'rejection_reason' => $request->rejection_reason
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran ditolak'
            ]);
        }
    }
}
