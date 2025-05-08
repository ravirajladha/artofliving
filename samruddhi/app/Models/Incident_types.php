<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident_types extends Model
{
    use HasFactory;
    public $table="incident_types";
    public $timestamps=false;
}
