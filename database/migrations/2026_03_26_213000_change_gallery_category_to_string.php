<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('galleries') || ! Schema::hasColumn('galleries', 'category')) {
            return;
        }

        // Preferred: make gallery category dynamic to follow categories table.
        try {
            DB::statement("ALTER TABLE galleries MODIFY category VARCHAR(100) NOT NULL");
            return;
        } catch (\Throwable $e) {
            // Fallback for MySQL engines that reject direct enum->varchar conversion.
            DB::statement("ALTER TABLE galleries MODIFY category ENUM('buffet', 'tumpeng', 'nasibox', 'nasi-box', 'snack', 'hampers') NOT NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('galleries') || ! Schema::hasColumn('galleries', 'category')) {
            return;
        }

        DB::statement("UPDATE galleries SET category = 'nasibox' WHERE category = 'nasi-box'");
        DB::statement("UPDATE galleries SET category = 'snack' WHERE category NOT IN ('buffet', 'tumpeng', 'nasibox', 'snack')");
        DB::statement("ALTER TABLE galleries MODIFY category ENUM('buffet', 'tumpeng', 'nasibox', 'snack') NOT NULL");
    }
};
