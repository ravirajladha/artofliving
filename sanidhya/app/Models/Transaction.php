<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Sanidhya;

class Transaction extends Model
{
    use HasFactory;
    public $table = "transactions";
    public $timestamps = false;
    protected $fillable = [
        'event_id',
        'event_name',
        'phone_number',
        'category',
        'multiples',
        'amount',
        'transaction_id',
        'payment_mode',
        'description',
        'transaction_img',
        'cheque_details',
        'transaction_status',
        'date_created',
        'seats',
        'arex_id'

    ];
}
