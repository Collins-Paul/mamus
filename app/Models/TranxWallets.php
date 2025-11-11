<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranxWallets extends Model
{
    use HasFactory;

    protected $fillable = [
        'tranx_uid',
        'wallet'   
    ];
}
