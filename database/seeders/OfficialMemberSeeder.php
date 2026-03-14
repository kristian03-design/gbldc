<?php

namespace Database\Seeders;

use App\Models\OfficialMember;
use App\Models\loan;
use Illuminate\Database\Seeder;

class OfficialMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample Official Member
        $member = OfficialMember::create([
            'member_id' => 'SAMPLE001',
            'member_number' => '123456',
            'last_name' => 'Doe',
            'first_name' => 'John',
            'middle_name' => 'A',
            'place_of_birth' => 'Manila',
            'birthdate' => '1990-01-01',
            'age' => '34',
            'gender' => 'Male',
            'religion' => 'Christian',
            'nationality' => 'Filipino',
            'civil_status' => 'Married',
            'email' => 'john.doe@example.com',
            'contact_number' => '09123456789',
            'street_address' => '123 Sample Street',
            'province' => 'Metro Manila',
            'city' => 'Manila',
            'barangay' => 'Sample Barangay',
            'year_of_stay' => '10',
            'house_ownership' => 'Owned',
            'zip_code' => '1000',
            'ec_fullname' => 'Jane Doe',
            'ec_gender' => 'Female',
            'ec_email' => 'jane.doe@example.com',
            'ec_contact_number' => '09123456780',
            'ec_address' => '123 Sample Street, Manila',
            'ec_relationship' => 'Spouse',
            'employment_status' => 'Employed',
            'source_of_funds' => 'Salary',
            'employer_business_name' => 'Sample Company',
            'occupation' => 'Engineer',
            'company_business_address' => '456 Business Ave, Manila',
            'gross_monthly_income' => '50000',
            'nature_type_of_employment_business' => 'Private',
            'sss_gsis_no' => '123456789',
            'tin_no' => '987654321',
            'proof_of_billing' => 'sample_proof.jpg',
            'two_by_two_picture' => 'sample_photo.jpg',
            'valid_id' => 'sample_id.jpg',
            'ApprovedBy' => 'Admin',
            'username' => 'johndoe',
            'password' => 'password123', // Will be hashed by the model
        ]);

        // Create a sample finished loan for this member
        loan::create([
            'member_id' => $member->member_id,
            'last_name' => $member->last_name,
            'first_name' => $member->first_name,
            'middle_name' => $member->middle_name,
            'place_of_birth' => $member->place_of_birth,
            'birthdate' => $member->birthdate,
            'age' => $member->age,
            'gender' => $member->gender,
            'religion' => $member->religion,
            'nationality' => $member->nationality,
            'civil_status' => $member->civil_status,
            'email' => $member->email,
            'contact_number' => $member->contact_number,
            'street_address' => $member->street_address,
            'province' => $member->province,
            'city_municipality' => $member->city,
            'barangay' => $member->barangay,
            'year_of_stay' => $member->year_of_stay,
            'house_ownership' => $member->house_ownership,
            'zip_code' => $member->zip_code,
            'employment_type' => $member->employment_status,
            'employer_business_name' => $member->employer_business_name,
            'position_nature_of_business' => $member->occupation,
            'employer_business_address' => $member->company_business_address,
            'monthly_income' => $member->gross_monthly_income,
            'year_in_service_operation' => '5',
            'loan_rec_proof_of_income' => 'sample_income_proof.jpg',
            'loan_number' => 'LN001',
            'loan_type' => 'Personal Loan',
            'loan_amount' => '100000',
            'loan_term' => '12',
            'frequency_of_payment' => 'Monthly',
            'purpose_of_loan' => 'Home Improvement',
            'loan_status' => 'Fully Paid',
            'loan_balance' => '0',
            'hr_person_name' => 'HR Manager',
            'hr_person_number' => '09123456781',
            'g1_fullname' => 'Guarantor One',
            'g1_relationship' => 'Friend',
            'g1_contact_number' => '09123456782',
            'g1_address' => '789 Guarantor St, Manila',
            'loan_rec_g1_valid_id' => 'g1_id.jpg',
            'g2_fullname' => 'Guarantor Two',
            'g2_relationship' => 'Relative',
            'g2_contact_number' => '09123456783',
            'g2_address' => '101 Guarantor Ave, Manila',
            'loan_rec_g2_valid_id' => 'g2_id.jpg',
            'approved_by' => 'Admin',
            'encoded_by' => 'Encoder',
            'due_amount' => '0',
        ]);

        // Create sample payment history for the loan (12 monthly payments)
        $paymentAmount = 100000 / 12; // Assuming equal monthly payments for simplicity
        for ($i = 1; $i <= 12; $i++) {
            paymentModel::create([
                'loan_number' => 'LN001',
                'member_id' => $member->member_id,
                'last_name' => $member->last_name,
                'first_name' => $member->first_name,
                'middle_name' => $member->middle_name,
                'transaction_type' => 'Loan Payment',
                'payment_method' => 'Bank Transfer',
                'payment_status' => 'Completed',
                'transaction_date' => now()->subMonths(13 - $i)->format('Y-m-d'), // Payments from 12 months ago to now
                'transaction_handler' => 'System',
                'updater_name' => 'Admin',
                'reference_number' => 'REF' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'payment_amount' => (string)$paymentAmount,
                'remarks' => 'Monthly loan payment ' . $i,
                'admin_copy' => 'admin_copy_' . $i . '.jpg',
                'member_copy' => 'member_copy_' . $i . '.jpg',
            ]);
        }
    }
}
