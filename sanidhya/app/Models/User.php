<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'type', // Add 'type' to allow mass assignment
        'apex',     // Add other fields that can be mass-assigned as needed
    ];
}
