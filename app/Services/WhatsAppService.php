<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;

class WhatsAppService
{
    /**
     * Format phone number to include country code for WhatsApp API
     * @param string $phone
     * @return string
     */
    public function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // If starts with 0, replace with 62
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } 
        // If doesn't start with 62, add it
        elseif (!str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }

    /**
     * Generate invoice PDF for order
     * @param Order $order
     * @return string PDF file path
     */
    public function generateInvoicePDF(Order $order)
    {
        $pdf = PDF::loadView('orders.invoice-pdf', compact('order'));
        $fileName = 'invoice-' . $order->id . '.pdf';
        
        // Use absolute path and ensure directory exists
        $invoicesDir = storage_path('app/public/invoices');
        
        // Create directory if it doesn't exist
        if (!is_dir($invoicesDir)) {
            @mkdir($invoicesDir, 0755, true);
        }
        
        $pdfPath = $invoicesDir . '/' . $fileName;
        $pdf->save($pdfPath);
        
        return $fileName;
    }

    /**
     * Build invoice message for WhatsApp
     * @param Order $order
     * @param string $pdfFileName
     * @return string WhatsApp message
     */
    public function buildInvoiceMessage(Order $order, $pdfFileName)
    {
        $formattedPrice = number_format($order->total_price, 0, ',', '.');
        
        $message = "*REJOSARI CATERING*\n\n";
        $message .= "Halo *{$order->customer_name}*!\n\n";

        // Detail Pesanan
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
        $message .= "Tanggal: " . Carbon::parse($order->event_date)->locale('id')->isoFormat('dddd, D MMMM Y') . "\n";
        $message .= "Waktu: {$order->event_time}\n";
        if ($order->address) {
            $message .= "Lokasi: {$order->address}\n\n";
        } else {
            $message .= "\n";
        }

        // Link Invoice
        $message .= "📎 *INVOICE PDF*\n";
        $pdfUrl = URL::to('storage/invoices/' . $pdfFileName);
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
        $message .= "3. Kirim bukti transfer ke WhatsApp: 0822-2711-0771\n\n";

        if ($order->notes) {
            $message .= "*Catatan:*\n";
            $message .= "{$order->notes}\n\n";
        }

        $message .= "Terima kasih telah mempercayakan acara Anda kepada Rejosari Catering! 🙏\n";
        $message .= "Jika ada pertanyaan, silakan hubungi kami.";

        return $message;
    }

    /**
     * Get WhatsApp URL for wa.me redirect
     * @param string $phone Customer's phone number
     * @param string $message Message to send
     * @return string WhatsApp URL
     */
    public function getWhatsAppURL($phone, $message)
    {
        $phone = $this->formatPhoneNumber($phone);
        return "https://wa.me/{$phone}?text=" . urlencode($message);
    }

    /**
     * Send invoice to customer's WhatsApp
     * @param Order $order
     * @return string WhatsApp URL for redirect or error message
     */
    public function sendInvoice(Order $order)
    {
        try {
            // Generate PDF
            $pdfFileName = $this->generateInvoicePDF($order);
            
            // Build message
            $message = $this->buildInvoiceMessage($order, $pdfFileName);
            
            // Get WhatsApp URL
            $whatsappUrl = $this->getWhatsAppURL($order->phone, $message);
            
            return $whatsappUrl;
        } catch (\Exception $e) {
            \Log::error('Error sending invoice via WhatsApp: ' . $e->getMessage(), [
                'order_id' => $order->id,
                'exception' => $e
            ]);
            throw $e;
        }
    }
}
