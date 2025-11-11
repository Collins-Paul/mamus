<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTrader extends Model
{
    use HasFactory;
    protected $fillable = [
        'fname',
        'lname'
        // 'description',
        // 'risk_score',
        // 'expertise',
        // 'minimum_investment',
        // 'commission'
    ];
}
