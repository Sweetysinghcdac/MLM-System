<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id','amount','mode','platform_fee','points_awarded'];

    protected $casts = [
        'amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'points_awarded' => 'integer',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commission()
    {
        return $this->hasOne(Commission::class, 'transaction_id');
    }
}
