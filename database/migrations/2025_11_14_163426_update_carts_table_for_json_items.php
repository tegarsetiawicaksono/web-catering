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
        Schema::table('carts', function (Blueprint $table) {
            // Drop foreign key constraint first if exists
            if (Schema::hasColumn('carts', 'menu_id')) {
                $table->dropForeign(['menu_id']);
                $table->dropColumn(['menu_id', 'quantity', 'price', 'package_name']);
            }

            // Add items column if it doesn't exist
            if (!Schema::hasColumn('carts', 'items')) {
                $table->json('items')->nullable()->after('user_id');
            }
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            // Restore old structure
            if (Schema::hasColumn('carts', 'items')) {
                $table->dropColumn('items');
            }

            $table->foreignId('menu_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            $table->string('package_name')->nullable();
        });
    }
};
