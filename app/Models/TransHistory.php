<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransHistory extends Model
{
    use HasFactory;

    protected $table = 'trans_history';

    protected $fillable = [
        'amount',
        'wallet_name',
        'wallet_address'
    ];
    
    public function currency()
    {
        return $this->hasOne(Currency::class, 'user_id', 'user_id');
    }
}
