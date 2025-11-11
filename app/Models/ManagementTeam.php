<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_name',
        'staff_position',
        'photo'
    ];
}
