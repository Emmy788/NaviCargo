<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Add any fillable fields if needed
    protected $fillable = [
        'company_name',
        'first_name',
        'last_name',
        'email_address',
        'phone_number',
        'address',
        'status',
    ];

    public function cargo()
    {
        return $this->hasMany(Cargo::class);
    }

    // Accessor: for displaying formatted phone numbers
    public function getFormattedPhoneAttribute()
    {
        if (!$this->phone_number) return null;

        // Formats like +254712345678 → +254 712 345 678
        return preg_replace('/^(\+254)(\d{3})(\d{3})(\d{3})$/', '$1 $2 $3 $4', $this->phone_number);
    }

    // Mutator: ensure phone numbers are stored without spaces
    public function setPhoneNumberAttribute($value)
    {
        $this->attributes['phone_number'] = str_replace(' ', '', $value);
    }


}
