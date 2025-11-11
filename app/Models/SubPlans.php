<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPlans extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_title',
        'price',
        'purchase_date',
        'exp_date',
        'status',
        'reciept'
    ];
}
