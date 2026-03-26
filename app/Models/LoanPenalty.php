<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPenalty extends Model
{
    protected $fillable = [
        'loan_number',
        'loan_schedule_id',
        'penalty_amount',
        'status'
    ];
}
