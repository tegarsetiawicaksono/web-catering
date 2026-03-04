<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CancelUnpaidOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-unpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically cancel orders without payment confirmation for 3 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for unpaid orders...');

        // Get orders that are:
        // 1. Status = pending
        // 2. Created more than 3 days ago
        // 3. No payment verification uploaded
        $threeDaysAgo = Carbon::now()->copy()->subDays(3);

        $orders = Order::where('status', 'pending')
            ->where('created_at', '<', $threeDaysAgo)
            ->whereDoesntHave('paymentVerifications')
            ->get();

        if ($orders->isEmpty()) {
            $this->info('No unpaid orders found.');
            return 0;
        }

        $count = 0;
        foreach ($orders as $order) {
            $order->status = 'cancelled';
            $order->save();
            
            $this->line("Order #{$order->id} cancelled (created: {$order->created_at->format('d M Y H:i')})");
            $count++;
        }

        $this->info("Successfully cancelled {$count} unpaid orders.");
        
        \Log::info('Auto-cancelled unpaid orders', [
            'count' => $count,
            'order_ids' => $orders->pluck('id')->toArray()
        ]);

        return 0;
    }
}
