<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah ENUM payment_method untuk menambahkan opsi bank
        DB::statement("ALTER TABLE `orders` MODIFY `payment_method` ENUM('transfer', 'cash', 'BCA', 'BNI', 'BRI', 'Mandiri') NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke nilai ENUM lama
        DB::statement("ALTER TABLE `orders` MODIFY `payment_method` ENUM('transfer', 'cash') NULL");
    }
};
