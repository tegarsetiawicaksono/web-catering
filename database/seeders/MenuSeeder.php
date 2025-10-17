<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Menu::create([
            'nama' => 'Paket Prasmanan Silver',
            'kategori' => 'Prasmanan',
            'deskripsi' => '7 pilihan menu dengan berbagai hidangan lezat',
            'harga' => 35000,
            'min_order' => 100,
            'gambar' => 'foto/buffet.jpg'
        ]);

        \App\Models\Menu::create([
            'nama' => 'Paket Prasmanan Gold',
            'kategori' => 'Prasmanan',
            'deskripsi' => '10 pilihan menu premium dengan hidangan spesial',
            'harga' => 45000,
            'min_order' => 100,
            'gambar' => 'foto/buffet.jpg'
        ]);

        \App\Models\Menu::create([
            'nama' => 'Paket Prasmanan Platinum',
            'kategori' => 'Prasmanan',
            'deskripsi' => '12 pilihan menu premium dengan hidangan spesial dan eksklusif',
            'harga' => 55000,
            'min_order' => 100,
            'gambar' => 'foto/buffet.jpg'
        ]);
    }
}
