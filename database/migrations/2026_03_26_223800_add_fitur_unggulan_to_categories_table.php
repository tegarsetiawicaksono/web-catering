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
        if (! Schema::hasColumn('categories', 'fitur_unggulan')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->text('fitur_unggulan')->nullable()->after('deskripsi');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('categories', 'fitur_unggulan')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn('fitur_unggulan');
            });
        }
    }
};
