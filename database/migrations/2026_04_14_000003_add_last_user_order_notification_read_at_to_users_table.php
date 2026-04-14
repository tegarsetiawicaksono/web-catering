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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'last_user_order_notification_read_at')) {
                $table->timestamp('last_user_order_notification_read_at')->nullable()->after('last_schedule_notification_read_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'last_user_order_notification_read_at')) {
                $table->dropColumn('last_user_order_notification_read_at');
            }
        });
    }
};
