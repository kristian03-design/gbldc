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
        Schema::create('registrationlist', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Basic Information
            $table->text('registration_number');
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
            // Contact Information
            $table->text('email')->unique();
            $table->text('contact_number')->unique();
            // Address
            $table->text('street_address');
            $table->text('province');
            $table->text('city');
            $table->text('barangay');
            // Addtional Information
            $table->text('year_of_stay');
            $table->text('house_ownership');
            $table->text('zip_code');

            // Emergency Contact
            $table->text('ec_fullname');
            $table->text('ec_gender');
            $table->text('ec_email')->unique();
            $table->text('ec_contact_number')->unique();
            $table->text('ec_address');
            $table->text('ec_relationship');
           
            // Employment Information
            $table->text('employment_status');
            $table->text('source_of_funds');
            $table->text('employer_business_name');
            $table->text('occupation');
            $table->text('company_business_address');
            $table->text('gross_monthly_income');
            $table->text('nature_type_of_employment_business');
            $table->text('sss_gsis_no');
            $table->text('tin_no');

            // Attachments
            $table->text('proof_of_billing');
            $table->text('two_by_two_picture');
            $table->text('valid_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrationlist');
    }
};
