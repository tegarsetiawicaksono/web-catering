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
        if (! Schema::hasTable('galleries') || ! Schema::hasColumn('galleries', 'category')) {
            return;
        }

        if (DB::getDriverName() !== 'sqlite') {
            return;
        }

        $tableSql = DB::table('sqlite_master')
            ->where('type', 'table')
            ->where('name', 'galleries')
            ->value('sql');

        if (! is_string($tableSql) || stripos($tableSql, 'check') === false) {
            return;
        }

        if (Schema::hasTable('galleries_old')) {
            Schema::drop('galleries_old');
        }

        Schema::rename('galleries', 'galleries_old');

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('category', 100);
            $table->string('path');
            $table->string('caption')->nullable();
            $table->timestamps();

            $table->index('category');
        });

        DB::statement("\n            INSERT INTO galleries (id, category, path, caption, created_at, updated_at)\n            SELECT id,\n                   CASE WHEN category = 'nasi-box' THEN 'nasibox' ELSE category END,\n                   path,\n                   caption,\n                   created_at,\n                   updated_at\n            FROM galleries_old\n        ");

        Schema::drop('galleries_old');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('galleries')) {
            return;
        }

        if (DB::getDriverName() !== 'sqlite') {
            return;
        }

        if (Schema::hasTable('galleries_old')) {
            Schema::drop('galleries_old');
        }

        Schema::rename('galleries', 'galleries_old');

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['buffet', 'tumpeng', 'nasibox', 'snack']);
            $table->string('path');
            $table->string('caption')->nullable();
            $table->timestamps();
        });

        DB::statement("\n            INSERT INTO galleries (id, category, path, caption, created_at, updated_at)\n            SELECT id,\n                   CASE\n                       WHEN category NOT IN ('buffet', 'tumpeng', 'nasibox', 'snack') THEN 'snack'\n                       ELSE category\n                   END,\n                   path,\n                   caption,\n                   created_at,\n                   updated_at\n            FROM galleries_old\n        ");

        Schema::drop('galleries_old');
    }
};