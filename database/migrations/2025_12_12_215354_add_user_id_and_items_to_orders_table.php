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
            // Add user_id column
            if (!Schema::hasColumn('orders', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained()->onDelete('cascade');
            }

            // Add items column for storing order items as JSON
            if (!Schema::hasColumn('orders', 'items')) {
                $table->json('items')->nullable()->after('total_price');
            }

            // Add province, city, district, street_address if not exists
            if (!Schema::hasColumn('orders', 'province')) {
                $table->string('province')->nullable()->after('email');
            }
            if (!Schema::hasColumn('orders', 'city')) {
                $table->string('city')->nullable()->after('province');
            }
            if (!Schema::hasColumn('orders', 'district')) {
                $table->string('district')->nullable()->after('city');
            }
            if (!Schema::hasColumn('orders', 'street_address')) {
                $table->text('street_address')->nullable()->after('district');
            }

            // Add payment_status if not exists
            if (!Schema::hasColumn('orders', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'verified', 'paid', 'failed'])->default('pending')->after('payment_method');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('orders', 'items')) {
                $table->dropColumn('items');
            }
            if (Schema::hasColumn('orders', 'province')) {
                $table->dropColumn('province');
            }
            if (Schema::hasColumn('orders', 'city')) {
                $table->dropColumn('city');
            }
            if (Schema::hasColumn('orders', 'district')) {
                $table->dropColumn('district');
            }
            if (Schema::hasColumn('orders', 'street_address')) {
                $table->dropColumn('street_address');
            }
            if (Schema::hasColumn('orders', 'payment_status')) {
                $table->dropColumn('payment_status');
            }
        });
    }
};
