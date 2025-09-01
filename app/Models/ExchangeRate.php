<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string $base
 * @property mixed|string $code
 * @property float|mixed $rate
 * @property mixed|string $fetched_at
 */
class ExchangeRate extends Model
{
    use HasFactory;

    protected $fillable = ['base', 'code', 'rate', 'fetched_at'];
    protected $casts = [
        'fetched_at' => 'datetime',
        'rate' => 'decimal:8',
    ];
}
