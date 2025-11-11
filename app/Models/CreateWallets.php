<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateWallets extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    protected $fillable = [
        'wallet_name',
        'wallet_address'
    ];
}
