<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = ['referrer_id','referred_user_id','transaction_id','amount', 'level'
];

    protected $casts = [
        'amount' => 'decimal:2',
        'level'  => 'integer',
    ];

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
