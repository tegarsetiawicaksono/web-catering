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
        'gambar'
    ];
}
