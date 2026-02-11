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
        return asset('storage/' . $this->path);
    }

    /**
     * Get formatted category name.
     */
    public function getCategoryNameAttribute(): string
    {
        return match($this->category) {
            'buffet' => 'Buffet',
            'tumpeng' => 'Tumpeng',
            'nasibox' => 'Nasi Box',
            'snack' => 'Snack',
            default => ucfirst($this->category),
        };
    }
}
