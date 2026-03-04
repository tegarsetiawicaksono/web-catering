<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PaymentVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_type',
        'payment_proof',
        'bank_name',
        'account_number',
        'account_name',
        'amount',
        'transfer_receipt_number',
        'transfer_date',
        'status',
        'verification_notes',
        'verified_by',
        'verified_at',
        'ip_address',
        'user_agent',
        'metadata'
    ];

    protected $casts = [
        'transfer_date' => 'datetime',
        'verified_at' => 'datetime',
        'metadata' => 'array',
        'amount' => 'decimal:2'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function verifyPayment()
    {
        $this->status = 'verified';
        $this->verified_by = auth()->user()->name;
        $this->verified_at = now();
        $this->save();

        $order = $this->order;
        
        // Update order based on payment type
        if ($this->payment_type === 'dp') {
            // DP payment verified
            $order->update([
                'paid_amount' => $this->amount,
                'remaining_amount' => $order->total_price - $this->amount,
                'payment_status' => 'dp_paid'
            ]);
            // Don't change order status yet, waiting for full payment
        } elseif ($this->payment_type === 'remaining') {
            // Remaining payment verified
            $order->update([
                'paid_amount' => $order->paid_amount + $this->amount,
                'remaining_amount' => 0,
                'payment_status' => 'fully_paid'
            ]);
            // Update order status to paid
            $order->updatePaymentStatus('paid');
        } else {
            // Full payment verified
            $order->update([
                'paid_amount' => $this->amount,
                'remaining_amount' => 0,
                'payment_status' => 'fully_paid'
            ]);
            // Update order status to paid
            $order->updatePaymentStatus('paid');
        }
    }

    public function rejectPayment($notes)
    {
        $this->status = 'rejected';
        $this->verification_notes = $notes;
        $this->verified_by = auth()->user()->name;
        $this->verified_at = now();
        $this->save();

        // Update order status
        $this->order->updatePaymentStatus('failed');
    }

    public function extractImageMetadata($file)
    {
        $metadata = [];

        // Get EXIF data if available
        if (function_exists('exif_read_data')) {
            $exif = @exif_read_data($file);
            if ($exif) {
                // Simpan data EXIF yang relevan
                $metadata['exif'] = [
                    'make' => $exif['Make'] ?? null,
                    'model' => $exif['Model'] ?? null,
                    'datetime' => $exif['DateTime'] ?? null,
                    'software' => $exif['Software'] ?? null
                ];
            }
        }

        // Get image information tanpa Intervention Image
        $imageInfo = getimagesize($file);
        $metadata['image'] = [
            'mime' => $imageInfo['mime'] ?? null,
            'width' => $imageInfo[0] ?? null,
            'height' => $imageInfo[1] ?? null,
            'size' => $file->getSize(),
            'hash' => md5_file($file)
        ];

        return $metadata;
    }

    public function isLikelyFraudulent()
    {
        if (!$this->metadata) {
            return ['is_suspicious' => true, 'flags' => ['no_metadata']];
        }

        $suspiciousFlags = [];

        // Cek waktu transfer
        $transferTime = $this->transfer_date;
        $uploadTime = $this->created_at;
        if ($uploadTime->diffInHours($transferTime) > 24) {
            $suspiciousFlags[] = 'transfer_time_mismatch';
        }

        // Cek metadata gambar
        if (isset($this->metadata['image'])) {
            // Cek ukuran gambar yang tidak wajar
            if ($this->metadata['image']['width'] < 600 || $this->metadata['image']['height'] < 600) {
                $suspiciousFlags[] = 'low_resolution_image';
            }

            // Cek jika gambar terlalu kecil (mungkin screenshot)
            if ($this->metadata['image']['size'] < 50000) { // 50KB
                $suspiciousFlags[] = 'suspicious_file_size';
            }
        }

        // Cek EXIF data
        if (empty($this->metadata['exif'])) {
            $suspiciousFlags[] = 'no_exif_data';
        }

        // Cek jumlah verifikasi dari IP yang sama
        $similarIpCount = self::where('ip_address', $this->ip_address)
            ->where('created_at', '>', now()->subHours(24))
            ->count();
        if ($similarIpCount > 3) {
            $suspiciousFlags[] = 'multiple_attempts_same_ip';
        }

        return [
            'is_suspicious' => count($suspiciousFlags) > 0,
            'flags' => $suspiciousFlags
        ];
    }
}
