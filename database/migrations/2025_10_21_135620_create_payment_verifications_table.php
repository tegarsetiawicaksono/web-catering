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
        Schema::create('payment_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('payment_proof');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_name');
            $table->decimal('amount', 10, 2);
            $table->string('transfer_receipt_number')->nullable(); // Nomor referensi transfer
            $table->timestamp('transfer_date');
            $table->string('status')->default('pending'); // pending, verified, rejected
            $table->text('verification_notes')->nullable();
            $table->string('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();
            // Metadata untuk deteksi kecurangan
            $table->string('ip_address');
            $table->string('user_agent');
            $table->json('metadata')->nullable(); // Menyimpan data tambahan seperti EXIF dari gambar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_verifications');
    }
};
