<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'client_name',
        'client_email',
        'client_phone',
        'service_type',
        'description',
        'estimated_price',
        'final_price',
        'status',
        'valid_until',
        'pdf_path'
    ];

    protected $casts = [
        'estimated_price' => 'decimal:2',
        'final_price' => 'decimal:2',
        'valid_until' => 'datetime'
    ];

    public static function generateReference()
    {
        return 'DEVIS-' . date('Y') . '-' . str_pad(static::count() + 1, 4, '0', STR_PAD_LEFT);
    }
}
