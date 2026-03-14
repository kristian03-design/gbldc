<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("loanlist", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Basic Info
            $table->text("member_id");
            $table->text('last_name');
            $table->text('first_name');
            $table->text('middle_name');
            $table->text('place_of_birth');
            $table->text('birthdate');
            $table->text('age');
            $table->text('gender');
            $table->text('religion');
            $table->text('nationality');
            $table->text('civil_status');
            $table->text('email')->unique();
            $table->text('contact_number');
            $table->text('street_address');
            $table->text('province');
            $table->text('city_municipality');
            $table->text('barangay');
            $table->text('year_of_stay');
            $table->text('house_ownership');
            $table->text('zip_code');

            // Employment Info
            $table->text('employment_type');
            $table->text('employer_business_name');
            $table->text('position_nature_of_business');
            $table->text('employer_business_address');
            $table->text('monthly_income');
            $table->text('year_in_service_operation');

            $table->text('loan_rec_proof_of_income');

            // Loan Details
            $table->text('loan_number')->unique();
            $table->text('loan_type');
            $table->text('loan_amount');
            $table->text('loan_term');
            $table->text('frequency_of_payment');
            $table->date('payment_start_date');
            $table->text('purpose_of_loan');
            $table->text('hr_person_name')->nullable();
            $table->text('hr_person_number')->nullable();
            $table->text('loan_balance');
            $table->text('loan_status');

            // First Guarantor
            $table->text('g1_fullname');
            $table->text('g1_relationship');
            $table->text('g1_contact_number');
            $table->text('g1_address');
            $table->text('loan_rec_g1_valid_id');

            // Second Guarantor
            $table->text('g2_fullname');
            $table->text('g2_relationship');
            $table->text('g2_contact_number');
            $table->text('g2_address');
            $table->text('loan_rec_g2_valid_id');

            $table->text('due_amount');
            $table->text('approved_by');
            $table->text('encoded_by');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loanlist');
    }
};
