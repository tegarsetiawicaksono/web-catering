<?php

namespace App\Traits;

trait HasOrderStatus
{
    public function addStatusHistory(string $status, string $description = null): void
    {
        $currentHistory = $this->status_history ?? [];
        $currentHistory[] = [
            'status' => $status,
            'description' => $description,
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'user' => auth()->user() ? auth()->user()->name : 'System'
        ];
        
        $this->status_history = $currentHistory;
        $this->status = $status;
        $this->save();
    }

    public function updatePaymentStatus(string $status): void
    {
        $this->payment_status = $status;
        if ($status === 'paid') {
            $this->paid_at = now();
            $this->addStatusHistory('payment_confirmed', 'Pembayaran telah dikonfirmasi');
        }
        $this->save();
    }

    public function updateDeliveryStatus(string $status): void
    {
        $this->delivery_status = $status;
        if ($status === 'delivered') {
            $this->delivered_at = now();
            $this->addStatusHistory('delivered', 'Pesanan telah diantar');
        }
        $this->save();
    }

    public function assignDriver(string $name, string $phone): void
    {
        $this->driver_name = $name;
        $this->driver_phone = $phone;
        $this->delivery_status = 'on_delivery';
        $this->addStatusHistory('driver_assigned', "Driver {$name} telah ditugaskan");
        $this->save();
    }
}