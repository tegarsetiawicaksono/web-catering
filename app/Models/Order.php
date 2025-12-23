<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasOrderStatus;

class Order extends Model
{
    use HasFactory, HasOrderStatus;

    protected $fillable = [
        'user_id',
        'customer_name',
        'phone',
        'email',
        'province',
        'city',
        'district',
        'street_address',
        'event_date',
        'event_time',
        'quantity',
        'notes',
        'package_name',
        'package_price',
        'total_price',
        'items',
        'status',
        // Payment fields
        'payment_method',
        'payment_status',
        'payment_proof',
        'paid_at',
        'bank_name',
        'account_number',
        'account_name',
        // Delivery fields
        'delivery_method',
        'delivery_fee',
        'delivery_status',
        'driver_name',
        'driver_phone',
        'delivered_at',
        // Tracking field
        'status_history'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'event_date'
    ];

    protected $casts = [
        'items' => 'array',
        'event_date' => 'date:Y-m-d',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'package_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'paid_at' => 'datetime:Y-m-d H:i:s',
        'delivered_at' => 'datetime:Y-m-d H:i:s',
        'status_history' => 'array'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
