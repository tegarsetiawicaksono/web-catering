<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('orders')) {
            return;
        }

        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'dp_percentage')) {
                $table->decimal('dp_percentage', 5, 2)->default(50.00);
            }

            if (! Schema::hasColumn('orders', 'dp_amount')) {
                $table->decimal('dp_amount', 12, 2)->default(0);
            }

            if (! Schema::hasColumn('orders', 'paid_amount')) {
                $table->decimal('paid_amount', 12, 2)->default(0);
            }

            if (! Schema::hasColumn('orders', 'remaining_amount')) {
                $table->decimal('remaining_amount', 12, 2)->default(0);
            }
        });

        DB::table('orders')->update([
            'dp_percentage' => DB::raw('COALESCE(dp_percentage, 50)'),
            'dp_amount' => DB::raw('COALESCE(dp_amount, 0)'),
            'paid_amount' => DB::raw('COALESCE(paid_amount, 0)'),
            'remaining_amount' => DB::raw('COALESCE(remaining_amount, total_price)'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('orders')) {
            return;
        }

        Schema::table('orders', function (Blueprint $table) {
            $dropColumns = [];

            foreach (['dp_percentage', 'dp_amount', 'paid_amount', 'remaining_amount'] as $column) {
                if (Schema::hasColumn('orders', $column)) {
                    $dropColumns[] = $column;
                }
            }

            if (! empty($dropColumns)) {
                $table->dropColumn($dropColumns);
            }
        });
    }
};