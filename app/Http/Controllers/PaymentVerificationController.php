<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PaymentVerificationController extends Controller
{
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'payment_proof' => 'required|image|max:2048', // max 2MB
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'transfer_receipt_number' => 'required|string',
            'transfer_date' => 'required|date'
        ]);

        // Process and store payment proof
        $paymentProof = $request->file('payment_proof');
        $path = $paymentProof->store('payment-proofs', 'public');

        // Create payment verification record
        $verification = new PaymentVerification([
            'order_id' => $order->id,
            'payment_proof' => $path,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'amount' => $request->amount,
            'transfer_receipt_number' => $request->transfer_receipt_number,
            'transfer_date' => $request->transfer_date,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        // Extract and store metadata
        $verification->metadata = $verification->extractImageMetadata($paymentProof);
        $verification->save();

        // Check for suspicious activity
        $fraudCheck = $verification->isLikelyFraudulent();
        if ($fraudCheck['is_suspicious']) {
            // Log suspicious activity for admin review
            \Log::warning('Suspicious payment verification', [
                'order_id' => $order->id,
                'flags' => $fraudCheck['flags'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
        }

        return redirect()->route('orders.show', $order)
            ->with('success', 'Bukti pembayaran berhasil diunggah dan sedang diverifikasi.');
    }

    public function verify(Request $request, PaymentVerification $verification)
    {
        $request->validate([
            'action' => 'required|in:verify,reject',
            'notes' => 'required_if:action,reject|string'
        ]);

        if ($request->action === 'verify') {
            $verification->verifyPayment();
            $message = 'Pembayaran berhasil diverifikasi.';
        } else {
            $verification->rejectPayment($request->notes);
            $message = 'Pembayaran ditolak.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function adminIndex()
    {
        $verifications = PaymentVerification::where('status', 'pending')
            ->with('order')
            ->latest()
            ->paginate(10);

        return view('admin.payment-verifications.index', compact('verifications'));
    }
}