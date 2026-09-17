<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category',
        'path',
        'caption',
    ];

    /**
     * Get the full URL for the gallery image.
     */
    public function getImageUrlAttribute(): string
    {
        $path = ltrim($this->path, '/');

        if (is_file(public_path($path)) || is_file(base_path('../public_html/' . $path))) {
            return asset($path);
        }

        return asset('storage/' . $path);
    }

    /**
     * Get formatted category name.
     */
    public function getCategoryNameAttribute(): string
    {
        return match($this->category) {
            'buffet' => 'Buffet',
            'tumpeng' => 'Tumpeng',
            'nasi-box' => 'Nasi Box',
            'nasibox' => 'Nasi Box',
            'snack' => 'Snack',
            'hampers' => 'Hampers',
            'wedding' => 'Wedding',
            default => ucfirst($this->category),
        };
    }
}
