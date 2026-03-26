<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    protected $fillable = [
        'loan_number',
        'member_id',
        'due_date',
        'monthly_payment',
        'principal_amount',
        'interest_amount',
        'remaining_balance',
        'status',
        'amount_paid',
        'payment_id_reference',
        'payment_number',
        'beginning_balance',
        'penalty'
    ];

    protected $casts = [
        'due_date' => 'date',
        'monthly_payment' => 'decimal:2',
        'principal_amount' => 'decimal:2',
        'interest_amount' => 'decimal:2',
        'remaining_balance' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'beginning_balance' => 'decimal:2',
        'penalty' => 'decimal:2',
    ];
}
