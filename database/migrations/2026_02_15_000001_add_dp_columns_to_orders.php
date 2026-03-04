<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('orders', 'dp_percentage')) {
                $table->decimal('dp_percentage', 5, 2)->default(50.00)->after('total_price');
            }
            if (!Schema::hasColumn('orders', 'dp_amount')) {
                $table->decimal('dp_amount', 12, 2)->default(0)->after('total_price');
            }
            if (!Schema::hasColumn('orders', 'paid_amount')) {
                $table->decimal('paid_amount', 12, 2)->default(0)->after('total_price');
            }
            if (!Schema::hasColumn('orders', 'remaining_amount')) {
                $table->decimal('remaining_amount', 12, 2)->default(0)->after('total_price');
            }
        });
        
        // Step 1: Change to VARCHAR to preserve existing data
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_status VARCHAR(50) DEFAULT 'unpaid'");
        
        // Step 2: Update any invalid values
        DB::statement("UPDATE orders SET payment_status = 'unpaid' WHERE payment_status NOT IN ('pending', 'paid', 'failed', 'verified', 'unpaid', 'dp_paid', 'fully_paid') OR payment_status IS NULL");
        
        // Step 3: Change to ENUM with all values
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_status ENUM('pending', 'paid', 'failed', 'verified', 'unpaid', 'dp_paid', 'fully_paid') DEFAULT 'unpaid'");
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['dp_percentage', 'dp_amount', 'paid_amount', 'remaining_amount']);
        });
        
        // Restore original enum values
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_status ENUM('pending', 'paid', 'failed', 'verified') DEFAULT 'pending'");
    }
};
