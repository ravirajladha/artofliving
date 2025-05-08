<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    public $timestamps=false;

    protected $fillable = ['serial_number', 'apex_body_id', 'members', 'account_name', 'account_number', 'ifsc_code', 'customer_id', 'home_branch_address', 'account_opening_date', 'authorized_signatory'];
}
