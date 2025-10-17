<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'address',
        'note',
        'items',
        'total',
        'status'
    ];

    protected $casts = [
        'items' => 'array',
        'date' => 'date',
        'total' => 'integer'
    ];
}