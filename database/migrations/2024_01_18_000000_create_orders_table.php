<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('phone');
            $table->string('email');
            $table->text('address');
            $table->date('event_date');
            $table->time('event_time');
            $table->integer('quantity');
            $table->text('notes')->nullable();
            $table->enum('payment_method', ['transfer', 'cash']);
            $table->string('package_name');
            $table->decimal('package_price', 10, 2);
            $table->decimal('total_price', 12, 2);
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};