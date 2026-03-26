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
        // Ubah payment_method dari ENUM ke VARCHAR untuk support dynamic payment methods
        DB::statement("ALTER TABLE `orders` MODIFY `payment_method` VARCHAR(100) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke ENUM dengan nilai default
        DB::statement("ALTER TABLE `orders` MODIFY `payment_method` ENUM('transfer', 'cash', 'BCA', 'BNI', 'BRI', 'Mandiri') NULL");
    }
};
