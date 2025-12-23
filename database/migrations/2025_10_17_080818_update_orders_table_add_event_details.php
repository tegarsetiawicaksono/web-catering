<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'items')) {
                $table->dropColumn('items');
            }
            if (Schema::hasColumn('orders', 'total')) {
                $table->dropColumn('total');
            }
            if (Schema::hasColumn('orders', 'date')) {
                $table->dropColumn('date');
            }
            if (Schema::hasColumn('orders', 'note')) {
                $table->dropColumn('note');
            }
            
            // Rename kolom jika ada
            if (Schema::hasColumn('orders', 'name') && !Schema::hasColumn('orders', 'customer_name')) {
                $table->renameColumn('name', 'customer_name');
            }
            
            // Tambah kolom baru jika belum ada
            if (!Schema::hasColumn('orders', 'event_time')) {
                $table->time('event_time')->after('event_date')->nullable();
            }
            if (!Schema::hasColumn('orders', 'quantity')) {
                $table->integer('quantity')->after('event_time')->nullable();
            }
            if (!Schema::hasColumn('orders', 'notes')) {
                $table->text('notes')->nullable()->after('quantity');
            }
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->enum('payment_method', ['transfer', 'cash'])->after('notes')->nullable();
            }
            if (!Schema::hasColumn('orders', 'package_name')) {
                $table->string('package_name')->after('payment_method')->nullable();
            }
            if (!Schema::hasColumn('orders', 'package_price')) {
                $table->decimal('package_price', 10, 2)->after('package_name')->nullable();
            }
            if (!Schema::hasColumn('orders', 'total_price')) {
                $table->decimal('total_price', 12, 2)->after('package_price')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Restore original columns if they don't exist
            if (!Schema::hasColumn('orders', 'items')) {
                $table->json('items')->nullable();
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->integer('total')->nullable();
            }
            if (!Schema::hasColumn('orders', 'date')) {
                $table->date('date')->nullable();
            }
            if (!Schema::hasColumn('orders', 'note')) {
                $table->text('note')->nullable();
            }
            
            // Reverse rename if needed
            if (Schema::hasColumn('orders', 'customer_name') && !Schema::hasColumn('orders', 'name')) {
                $table->renameColumn('customer_name', 'name');
            }
            
            // Drop new columns
            $table->dropColumn([
                'event_time',
                'quantity',
                'notes',
                'payment_method',
                'package_name',
                'package_price',
                'total_price'
            ]);
        });
    }
};
