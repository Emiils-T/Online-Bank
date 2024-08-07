<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_number',
        'type',
        'currency',
        'starting_amount',
        'amount_now'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public const TYPE_INVESTMENT = 'investing ';
    public const TYPE_CHECKING = 'checking';
}
