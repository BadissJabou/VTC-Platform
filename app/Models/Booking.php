<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'client_name',
        'client_email',
        'client_phone',
        'service_id',
        'pickup_address',
        'destination_address',
        'pickup_datetime',
        'return_datetime',
        'estimated_price',
        'final_price',
        'status',
        'notes',
        'payment_status'
    ];

    protected $casts = [
        'pickup_datetime' => 'datetime',
        'return_datetime' => 'datetime',
        'estimated_price' => 'decimal:2',
        'final_price' => 'decimal:2'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public static function generateReference()
    {
        return 'VTC-' . date('Y') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
    }
}
