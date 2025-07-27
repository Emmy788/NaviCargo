<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ship extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'capacity_in_tonnes',
        'registration_number',
        'status',
    ];
}
