<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all columns that should exist in loanlist
        $columns = [
            'member_id', 'last_name', 'first_name', 'middle_name', 
            'place_of_birth', 'birthdate', 'age', 'gender', 
            'religion', 'nationality', 'civil_status', 'email', 
            'contact_number', 'street_address', 'province', 
            'city_municipality', 'barangay', 'year_of_stay', 
            'house_ownership', 'zip_code', 'employment_type', 
            'employer_business_name', 'position_nature_of_business', 
            'employer_business_address', 'monthly_income', 
            'year_in_service_operation', 'loan_rec_proof_of_income', 
            'loan_number', 'loan_type', 'loan_amount', 'loan_term', 
            'frequency_of_payment', 'payment_start_date', 
            'purpose_of_loan', 'hr_person_name', 'hr_person_number', 
            'loan_balance', 'loan_status', 'g1_fullname', 
            'g1_relationship', 'g1_contact_number', 'g1_address', 
            'loan_rec_g1_valid_id', 'g2_fullname', 'g2_relationship', 
            'g2_contact_number', 'g2_address', 'loan_rec_g2_valid_id', 
            'due_amount', 'approved_by', 'encoded_by'
        ];
        
        foreach ($columns as $column) {
            try {
                DB::statement("ALTER TABLE loanlist ADD COLUMN IF NOT EXISTS {$column} TEXT NULL");
            } catch (\Exception $e) {
                // Column might already exist or table structure issue
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to drop columns in reverse
    }
};
