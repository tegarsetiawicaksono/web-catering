<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama' => 'Buffet',
                'slug' => 'buffet',
                'deskripsi' => 'Menu prasmanan dengan berbagai pilihan lauk pauk untuk acara besar',
                'gambar_url' => 'foto/buffet.jpg',
                'harga_mulai' => 30000,
                'is_active' => true,
            ],
            [
                'nama' => 'Tumpeng',
                'slug' => 'tumpeng',
                'deskripsi' => 'Nasi tumpeng untuk acara syukuran dan perayaan',
                'gambar_url' => 'foto/buffet.jpg',
                'harga_mulai' => 350000,
                'is_active' => true,
            ],
            [
                'nama' => 'Nasi Box',
                'slug' => 'nasibox',
                'deskripsi' => 'Paket nasi kotak praktis untuk berbagai acara',
                'gambar_url' => 'foto/buffet.jpg',
                'harga_mulai' => 25000,
                'is_active' => true,
            ],
            [
                'nama' => 'Snack',
                'slug' => 'snack',
                'deskripsi' => 'Aneka kudapan dan snack untuk coffee break atau rapat',
                'gambar_url' => 'foto/buffet.jpg',
                'harga_mulai' => 15000,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
