<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    /**
     * Get the public URL for the menu image regardless of how its path was stored.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->gambar) {
            return null;
        }

        if (Str::startsWith($this->gambar, ['http://', 'https://', '//'])) {
            return $this->gambar;
        }

        $path = ltrim($this->gambar, '/');

        if (!Str::startsWith($path, 'foto/')) {
            $path = 'foto/' . $path;
        }

        return asset($path);
    }
}
