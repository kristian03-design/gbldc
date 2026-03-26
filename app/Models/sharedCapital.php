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
        'last_name' => \App\Casts\GracefulEncrypt::class,
        'first_name' => \App\Casts\GracefulEncrypt::class,
        'middle_name' => \App\Casts\GracefulEncrypt::class,
        'street_address' => \App\Casts\GracefulEncrypt::class,
        'barangay' => \App\Casts\GracefulEncrypt::class,
        'city' => \App\Casts\GracefulEncrypt::class,
        'province' => \App\Casts\GracefulEncrypt::class,
        'phone' => \App\Casts\GracefulEncrypt::class,
        'email' => \App\Casts\GracefulEncrypt::class,
        'shared_capital_amount' => \App\Casts\GracefulEncrypt::class,
        'shared_capital_amount_balance' => \App\Casts\GracefulEncrypt::class,
        'date_of_membership' => \App\Casts\GracefulEncrypt::class,
        'encoded_by' => \App\Casts\GracefulEncrypt::class,
        'remarks' => \App\Casts\GracefulEncrypt::class,
        'record_creation_date' => \App\Casts\GracefulEncrypt::class,
        'payment_frequency' => \App\Casts\GracefulEncrypt::class,
        'payment_amount_per_schedule' => \App\Casts\GracefulEncrypt::class,
        'payment_start_date' => \App\Casts\GracefulEncrypt::class,
        'number_of_payments' => \App\Casts\GracefulEncrypt::class,
    ];
}
