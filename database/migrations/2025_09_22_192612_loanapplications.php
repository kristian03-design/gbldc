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
        Schema::create('loanapplications', function(Blueprint $table ){
  	        $table->id();
            $table->timestamps();
            $table->text('member_id');
            // Basic Info
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

            $table->text('email')->nullable();
            $table->text('contact_number');

            $table->text('street_address');
            $table->text('province');            
            $table->text('city_municipality');
            $table->text('barangay');
            $table->text('year_of_stay');
            $table->text('house_ownership');
            $table->text('zip_code');
           
            // First Guarantor
            $table->text('g1_fullname');
            $table->text('g1_relationship');
            $table->text('g1_contact_number');
            $table->text('g1_address');
            $table->text('g1_valid_id');
            // Second Guarantor
            $table->text('g2_fullname');
            $table->text('g2_relationship');
            $table->text('g2_contact_number');
            $table->text('g2_address');
            $table->text('g2_valid_id');

            // Employment Info
            $table->text('employment_type');
            $table->text('employer_business_name')->nullable();
            $table->text('position_nature_of_business')->nullable();
            $table->text('employer_business_address')->nullable();
            $table->text('monthly_income');
            $table->text('year_in_service_operation')->nullable();
            
            // image
            $table->text('proof_of_income')->nullable();

            $table->text('loan_type');
            $table->text('loan_amount');
            $table->text('loan_term');
            $table->text('purpose_of_loan');
            $table->text('hr_person_name')->nullable();
            $table->text('hr_person_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loanapplications');
    }
};
