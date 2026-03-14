<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loan extends Model
{
    protected $table = 'loanlist';

    protected $fillable = [
        'member_id',
        'first_name',
        'last_name',
        'middle_name',
        'place_of_birth',
        'birthdate',
        'age',
        'gender',
        'religion',
        'nationality',
        'civil_status',
        'email',
        'contact_number',
        'street_address',
        'province',
        'city_municipality',
        'barangay',
        'year_of_stay',
        'house_ownership',
        'zip_code',

        'employment_type',
        'employer_business_name',
        'position_nature_of_business',
        'employer_business_address',
        'monthly_income',
        'year_in_service_operation',
        'loan_rec_proof_of_income',

        'loan_number',
        'loan_type',
        'loan_amount',
        'loan_term',
        'interest_rate',
        'monthly_payment',
        'total_amount_due',
        'frequency_of_payment',
        'payment_start_date',
        'payment_end_date',
        'loan_release_date',
        'purpose_of_loan',
        'purpose',
        'loan_status',
        'loan_balance',
        'outstanding_balance',
        'amount_paid',
        'remarks',

        'hr_person_name',
        'hr_person_number',

        'g1_fullname',
        'g1_relationship',
        'g1_contact_number',
        'g1_address',
        'loan_rec_g1_valid_id',

        'g2_fullname',
        'g2_relationship',
        'g2_contact_number',
        'g2_address',
        'loan_rec_g2_valid_id',

        'approved_by',
        'encoded_by',
        'due_amount'
    ];
    
    protected function casts(): array{
        return [
            'payment_start_date' => 'date',
            'loan_release_date' => 'date',
            'payment_end_date' => 'date',
        ];
    }

}
