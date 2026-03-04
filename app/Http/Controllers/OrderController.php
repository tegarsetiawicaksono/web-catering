<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Events\NewOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'event_date' => 'required|date|after:today',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'street_address' => 'required|string',
            'notes' => 'nullable|string',
            'items' => 'required|array',
            'items.*.id' => 'required|string',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:50',
            'total_price' => 'required|integer'
        ]);

        // Add user_id if user is authenticated
        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        // Set default payment status
        $validated['payment_status'] = 'pending';
        $validated['status'] = 'pending';

        $order = Order::create($validated);

        // Broadcast new order event
        broadcast(new NewOrder($order))->toOthers();

        return response()->json($order, 201);
    }

    public function history()
    {
        try {
            // Get orders for logged in user by user_id or email with payment verification relation
            $orders = Order::with('latestPaymentVerification')
                ->where(function ($query) {
                    $query->where('user_id', auth()->id())
                        ->orWhere('email', auth()->user()->email);
                })
                ->orderBy('created_at', 'desc')
                ->get();

            return view('orders.history', compact('orders'));
        } catch (\Exception $e) {
            \Log::error('Error in order history: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat riwayat pesanan: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        // Load payment verification relationship
        $order->load('latestPaymentVerification');

        // Get active bank accounts
        $bankAccounts = \App\Models\BankAccount::where('is_active', true)->get();

        // Debugging
        Log::info('Order Data:', ['order' => $order->toArray()]);

        if (!$order) {
            Log::warning('Order not found');
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan');
        }

        return view('orders.show', compact('order', 'bankAccounts'));
    }

    public function cancel(Order $order)
    {
        try {
            // Check if order status is pending
            if ($order->status !== 'pending') {
                return back()->with('error', 'Hanya pesanan dengan status pending yang dapat dibatalkan');
            }

            // Check if payment verification exists (DP already paid)
            if ($order->latestPaymentVerification) {
                return back()->with('error', 'Pesanan yang sudah bayar DP tidak dapat dibatalkan. Silakan hubungi admin untuk pembatalan.');
            }

            // Check event date - cannot cancel within 3 days before event
            $eventDate = \Carbon\Carbon::parse($order->event_date)->startOfDay();
            $now = \Carbon\Carbon::now()->startOfDay();
            $daysUntilEvent = $now->diffInDays($eventDate, false);

            if ($daysUntilEvent < 3) {
                return back()->with('error', 'Pembatalan tidak dapat dilakukan kurang dari 3 hari sebelum tanggal event. Silakan hubungi admin melalui WhatsApp untuk pembatalan darurat.');
            }

            $order->status = 'cancelled';
            $order->save();

            Log::info('Order cancelled:', ['order_id' => $order->id, 'days_until_event' => $daysUntilEvent]);

            return back()->with('success', 'Pesanan berhasil dibatalkan');
        } catch (\Exception $e) {
            Log::error('Error cancelling order:', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal membatalkan pesanan. Silakan coba lagi.');
        }
    }

    public function downloadInvoice(Order $order)
    {
        $pdf = PDF::loadView('orders.invoice-pdf', compact('order'));
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }

    public function sendInvoiceToWhatsApp(Order $order)
    {
        try {
            // Generate PDF
            $pdf = PDF::loadView('orders.invoice-pdf', compact('order'));
            $fileName = 'invoice-' . $order->id . '.pdf';
            $pdfPath = storage_path('app/public/invoices/' . $fileName);

            // Pastikan direktori ada
            if (!Storage::exists('public/invoices')) {
                Storage::makeDirectory('public/invoices');
            }

            // Simpan PDF
            $pdf->save($pdfPath);

            // Set nomor WhatsApp Rejosari Catering
            $phone = '6282227110771'; // Nomor tetap Rejosari Catering

            // Format harga
            $formattedPrice = number_format($order->total_price, 0, ',', '.');

            // Generate pesan WhatsApp dengan emoji
            $message = "*REJOSARI CATERING*\n\n";
            $message .= "Halo *{$order->customer_name}*!\n\n";

            // Detail Pesanan dengan emoji
            $message .= "*DETAIL PESANAN #{$order->id}*\n";
            $message .= "───────────────────\n";
            if ($order->items) {
                foreach ($order->items as $item) {
                    $itemTotal = number_format($item['price'] * $item['quantity'], 0, ',', '.');
                    $message .= " {$item['name']}\n";
                    $message .= "   {$item['quantity']} pax × Rp " . number_format($item['price'], 0, ',', '.') . "\n";
                    $message .= "   = Rp {$itemTotal}\n";
                }
            } else {
                $message .= "{$order->package_name}\n";
                $message .= "   {$order->quantity} porsi × Rp " . number_format($order->package_price, 0, ',', '.') . "\n";
                $message .= "   = Rp {$formattedPrice}\n";
            }
            $message .= "───────────────────\n";
            $message .= "*Total: Rp {$formattedPrice}*\n\n";

            // Informasi Acara
            $message .= "*INFORMASI ACARA*\n";
            $message .= "Tanggal: " . \Carbon\Carbon::parse($order->event_date)->locale('id')->isoFormat('dddd, D MMMM Y') . "\n";
            $message .= "Waktu: {$order->event_time}\n";
            $message .= "Lokasi: {$order->address}\n\n";

            // Link Invoice
            $message .= "📎 *INVOICE PDF*\n";
            $pdfUrl = url('storage/invoices/' . $fileName);
            $message .= $pdfUrl . "\n\n";

            // Informasi Pembayaran
            $message .= "*INFORMASI PEMBAYARAN*\n";
            $message .= "Transfer Bank BCA\n";
            $message .= "No. Rek: *1234567890*\n";
            $message .= "a.n: *PT Rejosari Catering*\n\n";

            // Instruksi
            $message .= "*LANGKAH SELANJUTNYA*\n";
            $message .= "1. Download invoice PDF di atas\n";
            $message .= "2. Transfer sesuai total pembayaran\n";
            $message .= "3. Kirim bukti transfer ke nomor ini (0822-2711-0771)\n\n";

            if ($order->notes) {
                $message .= "*Catatan:*\n";
                $message .= "{$order->notes}\n\n";
            }

            $message .= "Terima kasih telah mempercayakan acara Anda kepada Rejosari Catering! 🙏\n";
            $message .= "Jika ada pertanyaan, silakan hubungi kami.";

            // Buat URL WhatsApp
            $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

            return redirect($whatsappUrl);
        } catch (\Exception $e) {
            Log::error('Error sending invoice to WhatsApp: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengirim invoice. Silakan coba lagi.');
        }
    }
}
