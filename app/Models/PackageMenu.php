<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageMenu extends Model
{
    use HasFactory;

    protected $table = 'package_menus';

    protected $fillable = [
        'order',
        'category',
        'name',
        'package_type',
        'price',
        'min_order',
        'description',
        'menu_items',
        'image_path',
        'is_available'
    ];

    protected $casts = [
        'menu_items' => 'array',
        'is_available' => 'boolean',
        'price' => 'decimal:2'
    ];
}
