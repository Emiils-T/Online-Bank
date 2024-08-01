<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

     protected $fillable = [
         'symbol',
        'type',
        'name',
        'price',
        '1h_change',
        '12h_change',
        '24h_change',
        '7d_change',
        'market_cap',
        'market_cap',
     ];

     public const TYPE_CRYPTO = 'crypto';
     public const TYPE_FIAT = 'fiat';

}
