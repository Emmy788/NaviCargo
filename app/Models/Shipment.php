<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{

    use HasFactory;

    protected $fillable = [
        'cargo_id', 'ship_id', 'origin_port_id', 'destination_port_id',
        'departure_date', 'arrival_estimate', 'actual_arrival_date',
        'status', 'is_active', 'cancellation_reason',
    ];

    public function cargo() 
    { 
        return $this->belongsTo(Cargo::class); 
    }

    public function ship() 
    { 
        return $this->belongsTo(Ship::class); 
    }

    public function originPort() 
    { 
        return $this->belongsTo(Port::class, 'origin_port_id'); 
    }

    public function destinationPort() 
    { 
        return $this->belongsTo(Port::class, 'destination_port_id'); 
    }

}
