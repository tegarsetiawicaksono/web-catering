<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('categories')) {
            return;
        }

        DB::table('categories')->updateOrInsert(
            ['slug' => 'wedding'],
            [
                'nama' => 'Wedding',
                'deskripsi' => 'Dokumentasi catering untuk acara pernikahan',
                'gambar_url' => 'foto/buffet.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        if (Schema::hasTable('categories')) {
            DB::table('categories')->where('slug', 'wedding')->delete();
        }
    }
};