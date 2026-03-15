<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'base_price',
        'price_unit',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
