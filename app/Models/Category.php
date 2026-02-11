<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'fitur_unggulan',
        'gambar_url',
        'gambar_background',
        'harga_mulai',
        'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    // Relasi dengan Menu
    public function menus()
    {
        return $this->hasMany(Menu::class, 'kategori', 'slug');
    }
    
    // Auto generate slug dari nama
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->nama);
            }
        });
        
        static::updating(function ($category) {
            if ($category->isDirty('nama')) {
                $category->slug = Str::slug($category->nama);
            }
        });
    }
}
