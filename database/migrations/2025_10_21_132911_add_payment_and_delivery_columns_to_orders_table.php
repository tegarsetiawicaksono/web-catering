<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Payment columns
            if (!Schema::hasColumn('orders', 'payment_status')) {
                $table->string('payment_status')->default('pending');
            }
            if (!Schema::hasColumn('orders', 'payment_proof')) {
                $table->string('payment_proof')->nullable();
            }
            if (!Schema::hasColumn('orders', 'paid_at')) {
                $table->timestamp('paid_at')->nullable();
            }
            if (!Schema::hasColumn('orders', 'bank_name')) {
                $table->string('bank_name')->nullable();
            }
            if (!Schema::hasColumn('orders', 'account_number')) {
                $table->string('account_number')->nullable();
            }
            if (!Schema::hasColumn('orders', 'account_name')) {
                $table->string('account_name')->nullable();
            }
            
            // Delivery columns
            $table->string('delivery_method')->nullable(); // pickup atau delivery
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->string('delivery_status')->default('pending'); // pending, on_delivery, delivered
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();
            $table->timestamp('delivered_at')->nullable();
            
            // Tracking columns
            $table->json('status_history')->nullable(); // untuk menyimpan history status pesanan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_status',
                'payment_proof',
                'paid_at',
                'bank_name',
                'account_number',
                'account_name',
                'delivery_method',
                'delivery_fee',
                'delivery_status',
                'driver_name',
                'driver_phone',
                'delivered_at',
                'status_history'
            ]);
        });
    }
};
