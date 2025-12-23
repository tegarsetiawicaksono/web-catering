<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('province')->after('address');
            $table->string('city')->after('province');
            $table->string('district')->after('city');
            $table->renameColumn('address', 'street_address');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('street_address', 'address');
            $table->dropColumn(['province', 'city', 'district']);
        });
    }
};