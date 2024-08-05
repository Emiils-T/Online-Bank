<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_number',
        'type',
        'currency',
        'amount'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public const TYPE_SEND='send';
     public const TYPE_RECEIVE='receive';
}
