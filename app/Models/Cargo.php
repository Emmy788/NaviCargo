<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'weight',
        'volume',
        'client_id',
        'cargo_type',
        'is_active',
    ];

    public function client() 
    {
        return $this->belongsTo(Client::class);
    }

}
