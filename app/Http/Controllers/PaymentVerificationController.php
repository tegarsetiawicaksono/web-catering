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
            'payment_type' => 'required|in:dp,full',
            'payment_proof' => 'required|image|max:2048', // max 2MB
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'transfer_receipt_number' => 'nullable|string',
            'transfer_date' => 'required|date'
        ]);

        $paymentType = $request->payment_type;
        
        // Calculate DP amount if payment type is DP
        $dpPercentage = 50; // Default 50%
        $dpAmount = round($order->total_price * ($dpPercentage / 100));
        $expectedAmount = $paymentType === 'dp' ? $dpAmount : $order->total_price;
        
        // Update order DP fields
        if ($paymentType === 'dp') {
            $order->update([
                'dp_percentage' => $dpPercentage,
                'dp_amount' => $dpAmount,
                'paid_amount' => 0,
                'remaining_amount' => $order->total_price,
                'payment_status' => 'unpaid'
            ]);
        } else {
            // Full payment
            $order->update([
                'dp_percentage' => 0,
                'dp_amount' => 0,
                'paid_amount' => 0,
                'remaining_amount' => $order->total_price,
                'payment_status' => 'unpaid'
            ]);
        }

        // Process and store payment proof
        $paymentProof = $request->file('payment_proof');
        $path = $paymentProof->store('payment-proofs', 'public');

        // Create payment verification record
        $verification = new PaymentVerification([
            'order_id' => $order->id,
            'payment_type' => $paymentType,
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
                'payment_type' => $paymentType,
                'flags' => $fraudCheck['flags'],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
        }

        $message = $paymentType === 'dp' 
            ? 'Bukti pembayaran DP berhasil diunggah. Silakan bayar sisa pembayaran sebelum tanggal event.' 
            : 'Bukti pembayaran lunas berhasil diunggah dan sedang diverifikasi. Terima kasih!';

        return redirect()->route('orders.show', $order)
            ->with('success', $message);
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
}
