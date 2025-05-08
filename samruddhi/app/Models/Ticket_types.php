<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket_types extends Model
{
    use HasFactory;
    public $table="ticket_types";
    public $timestamps=false;
}
