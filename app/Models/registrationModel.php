<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationModel extends Model
{
    protected $table = 'registrationlist';

    protected $fillable = [
        // Basic Information
        'registration_number',
        'last_name',
        'first_name',
        'middle_name',
        'place_of_birth',
        'birthdate',
        'age',
        'gender',
        'religion',
        'nationality',
        'civil_status',

        // Contact Information
        'email',
        'contact_number',

        // Address
        'street_address',
        'province',
        'city',
        'barangay',

        // Additional Information
        'year_of_stay',
        'house_ownership',
        'zip_code',

        // Emergency Contact
        'ec_fullname',
        'ec_gender',
        'ec_email',
        'ec_contact_number',
        'ec_address',
        'ec_relationship',

        // Employment Information
        'employment_status',
        'source_of_funds',
        'employer_business_name',
        'occupation',
        'company_business_address',
        'gross_monthly_income',
        'nature_type_of_employment_business',
        'sss_gsis_no',
        'tin_no',

        // Attachments
        'proof_of_billing',
        'two_by_two_picture',
        'valid_id',
    ];

    protected function casts(): array
    {
        return [
            // Basic Information
            'last_name' => 'encrypted',
            'first_name' => 'encrypted',
            'middle_name' => 'encrypted',
            'place_of_birth' => 'encrypted',
            'birthdate' => 'encrypted',
            'age' => 'encrypted',
            'gender' => 'encrypted',
            'religion' => 'encrypted',
            'nationality' => 'encrypted',
            'civil_status' => 'encrypted',

            // Contact Information
            'email' => 'encrypted',
            'contact_number' => 'encrypted',

            // Address
            'street_address' => 'encrypted',
            'province' => 'encrypted',
            'city' => 'encrypted',
            'barangay' => 'encrypted',

            // Additional Information
            'year_of_stay' => 'encrypted',
            'house_ownership' => 'encrypted',
            'zip_code' => 'encrypted',

            // Emergency Contact
            'ec_fullname' => 'encrypted',
            'ec_gender' => 'encrypted',
            'ec_email' => 'encrypted',
            'ec_contact_number' => 'encrypted',
            'ec_address' => 'encrypted',
            'ec_relationship' => 'encrypted',

            // Employment Information
            'employment_status' => 'encrypted',
            'source_of_funds' => 'encrypted',
            'employer_business_name' => 'encrypted',
            'occupation' => 'encrypted',
            'company_business_address' => 'encrypted',
            'gross_monthly_income' => 'encrypted',
            'nature_type_of_employment_business' => 'encrypted',
            'sss_gsis_no' => 'encrypted',
            'tin_no' => 'encrypted',

            // Attachments
            'proof_of_billing' => 'encrypted',
            'two_by_two_picture' => 'encrypted',
            'valid_id' => 'encrypted',
        ];
    }
}
