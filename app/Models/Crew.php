<?php

namespace App\Models;

use App\Models\Ship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Crew extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'role',
        'phone_number',
        'nationality',
        'ship_id',
        'is_active',
    ];

    public function ship()
        {
            return $this->belongsTo(Ship::class);
        }
}
