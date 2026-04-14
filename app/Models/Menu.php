<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order',
        'nama',
        'kategori',
        'deskripsi',
        'harga',
        'min_order',
        'gambar',
        'is_custom',
    ];

    protected $casts = [
        'is_custom' => 'boolean',
    ];
}
