<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'category' => 'buffet',
                'caption' => 'Prasmanan Buffet Premium dengan berbagai pilihan menu',
                'path' => 'foto/galeri/buffet-1.jpg',
            ],
            [
                'category' => 'buffet',
                'caption' => 'Set up buffet lengkap untuk acara kantor',
                'path' => 'foto/galeri/buffet-2.jpg',
            ],
            [
                'category' => 'tumpeng',
                'caption' => 'Tumpeng Nasi Kuning untuk acara syukuran',
                'path' => 'foto/galeri/tumpeng-1.jpg',
            ],
            [
                'category' => 'tumpeng',
                'caption' => 'Tumpeng Mini dengan lauk lengkap',
                'path' => 'foto/galeri/tumpeng-2.jpg',
            ],
            [
                'category' => 'nasibox',
                'caption' => 'Nasi Box Ayam Goreng dengan lauk komplit',
                'path' => 'foto/galeri/nasibox-1.jpg',
            ],
            [
                'category' => 'nasibox',
                'caption' => 'Paket Nasi Box untuk rapat atau meeting',
                'path' => 'foto/galeri/nasibox-2.jpg',
            ],
            [
                'category' => 'snack',
                'caption' => 'Aneka kue dan snack untuk coffee break',
                'path' => 'foto/galeri/snack-1.jpg',
            ],
            [
                'category' => 'snack',
                'caption' => 'Snack Box lengkap untuk acara seminar',
                'path' => 'foto/galeri/snack-2.jpg',
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
