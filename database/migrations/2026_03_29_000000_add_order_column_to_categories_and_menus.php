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
        // Add order column to categories table
        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                if (!Schema::hasColumn('categories', 'order')) {
                    $table->integer('order')->default(0)->after('id');
                }
            });
        }

        // Add order column to menus table
        if (Schema::hasTable('menus')) {
            Schema::table('menus', function (Blueprint $table) {
                if (!Schema::hasColumn('menus', 'order')) {
                    $table->integer('order')->default(0)->after('id');
                }
            });
        }

        // Add order column to package_menus table
        if (Schema::hasTable('package_menus')) {
            Schema::table('package_menus', function (Blueprint $table) {
                if (!Schema::hasColumn('package_menus', 'order')) {
                    $table->integer('order')->default(0)->after('id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('package_menus', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
