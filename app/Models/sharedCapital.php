<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedCapital extends Model
{
    protected $table = 'sharedcapitalrecords';

protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'street_address',
        'barangay',
        'city',
        'province',
        'phone',
        'email',
        'shared_capital_amount',
        'shared_capital_amount_balance',
        'date_of_membership',
        'member_id',
        'encoded_by',
        'remarks',
        'record_creation_date',   
        'payment_frequency',
        'payment_amount_per_schedule',
        'payment_start_date',
        'number_of_payments',
        'status',
    ];

    protected $casts = [
        'last_name' => 'encrypted',
        'first_name' => 'encrypted',
        'middle_name' => 'encrypted',
        'street_address' => 'encrypted',
        'barangay' => 'encrypted',
        'city' => 'encrypted',
        'province' => 'encrypted',
        'phone' => 'encrypted',
        'email' => 'encrypted',
        'shared_capital_amount' => 'encrypted',
        'shared_capital_amount_balance' => 'encrypted',
        'date_of_membership' => 'encrypted',
        'encoded_by' => 'encrypted',
        'remarks' => 'encrypted',
        'record_creation_date' => 'encrypted',
        'payment_frequency' => 'encrypted',
        'payment_amount_per_schedule' => 'encrypted',
        'payment_start_date' => 'encrypted',
        'number_of_payments' => 'encrypted',
    ];
}
