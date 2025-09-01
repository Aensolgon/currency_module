<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static pluck(string $string)
 */
class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'symbol'];
}
