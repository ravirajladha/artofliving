<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'multiples', // Add 'multiples' to the fillable attributes
        'amount',
        'phone',
        'email',
        'first_name',
        'last_name',
        'gender',
        'age',
        'pan',
        'aadhaar',
        'address',
        'pincode',
        'city',
        'state',
        'company_name',
        'company_pan',
        'company_aadhaar',
        'company_address',
        'company_pincode',
        'company_city',
        'company_state',
        'seat_number',
        'category',
        'event_id',
        'batch',
    ];

    // Rest of your model code...
}
