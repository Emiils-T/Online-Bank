<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoWallet extends Model
{
    use HasFactory;
    protected $fillable =[
        'account_number',
        'symbol',
        'purchase_price',
        'price',
        'amount',
        'value',
        'value_now',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
