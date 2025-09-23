<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = ['user_id','amount','status','note'];
    protected $casts = [
        'amount' => 'decimal:2',
    ];
    public function user(){ return $this->belongsTo(User::class); }
}
