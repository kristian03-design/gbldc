<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistrationModel;


class AdminSubmitMemberRegisForm extends Controller
{
    public function AdminSubmitRegisMemForm(Request $request){
        $adminRegisMem = $request->validate([
            // Basic Information
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'place_of_birth' => 'required|string',
            'birthdate' => 'required|date',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'religion' => 'required|string',
            'nationality' => 'required|string',
            'civil_status' => 'required|string',
            // Contact Information
            'email' => 'required|email|unique:registrationlist,email',
            'contact_number' => 'required|string|unique:registrationlist,contact_number',
            // Address
            'street_address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',    
            'barangay' => 'required|string',
            'year_of_stay' => 'required|string',
            'house_ownership' => 'required|string',
            'zip_code' => 'required|string',

            // Emergency Contact
            'ec_fullname' => 'required|string|max:255',
            'ec_gender' => 'required|in:Male,Female',
            'ec_email' => 'nullable|email|max:255',
            'ec_contact_number' => 'required|digits:10',
            'ec_address' => 'required|string|max:255',
            'ec_relationship' => 'required|string|max:100',

            // Employment Info
            'employment_status' => 'required|string|max:100',
            'source_of_funds' => 'required|string|max:100',
            'employer_business_name' => 'required|string|max:255',
            'occupation' => 'required|string|max:100',
            'company_business_address' => 'required|string|max:255',
            'gross_monthly_income' => 'required|string|max:100',
            'nature_type_of_employment_business' => 'required|string|max:100',
            'sss_gsis_no' => 'required|string|max:100',
            'tin_no' => 'required|string|max:100',

            // Attachments
            'two_by_two_picture' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'proof_of_billing' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'valid_id' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // #region agent log
        try {
            $payload = [
                'sessionId' => '4b0db3',
                'runId' => 'pre-fix-admin-membership-submit',
                'hypothesisId' => 'H3',
                'location' => 'AdminSubmitMemberRegisForm.php:AdminSubmitRegisMemForm',
                'message' => 'Admin membership submit - required keys presence',
                'data' => [
                    'has_ec_address' => $request->has('ec_address'),
                    'has_ec_email' => $request->has('ec_email'),
                    'ec_email_empty' => $request->has('ec_email') ? (trim((string) $request->input('ec_email')) === '') : null,
                    'has_city' => $request->has('city'),
                ],
                'timestamp' => (int) round(microtime(true) * 1000),
            ];
            file_put_contents(base_path('debug-4b0db3.log'), json_encode($payload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {
        }
        // #endregion
        $lastRecord = RegistrationModel::orderBy('id', 'desc')->first();

        if ($lastRecord && isset($lastRecord->registration_number)) {
            $lastNumber = intval(substr($lastRecord->registration_number, 2));
        } else {
            $lastNumber = 0;
        }

        $newNumber = $lastNumber + 1;

        $adminRegisMem['registration_number'] = 'R-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        // 2x2 Picture Image handler
        if ($request->hasFile('two_by_two_picture')) {
            $file = $request->file('two_by_two_picture');
            $LastName = $request->last_name;
            $FirstName = $request->first_name;
            $MiddleName = $request->middle_name;
            $Filename = $LastName.$FirstName.$MiddleName.'.'.time().'.'.'two_by_two_picture'.$file->getClientOriginalExtension();
            $ImagePath = $file->storeAs('Two_by_Two_Picture', $Filename, 'local');
            $adminRegisMem['two_by_two_picture'] = $ImagePath;
        }
        // Proof of Billing Image handler
        if ($request->hasFile('proof_of_billing')) {
            $file = $request->file('proof_of_billing');
            $LastName = $request->last_name;
            $FirstName = $request->first_name;
            $MiddleName = $request->middle_name;
            $Filename = $LastName.$FirstName.$MiddleName.'.'.time().'.'.'proof_of_billing'.$file->getClientOriginalExtension();
            $ImagePath = $file->storeAs('Proof_of_Billings', $Filename, 'local');
            $adminRegisMem['proof_of_billing'] = $ImagePath;
        }
        // Proof of Billing Image handler
        if ($request->hasFile('valid_id')) {
            $file = $request->file('valid_id');
            $LastName = $request->last_name;
            $FirstName = $request->first_name;
            $MiddleName = $request->middle_name;
            $Filename = $LastName.$FirstName.$MiddleName.'.'.time().'.'.'valid_id'.$file->getClientOriginalExtension();
            $ImagePath = $file->storeAs('Valid_IDs', $Filename, 'local');
            $adminRegisMem['valid_id'] = $ImagePath;
        }
        
        $created = RegistrationModel::create($adminRegisMem);

        // #region agent log
        try {
            $payload = [
                'sessionId' => '4b0db3',
                'runId' => 'pre-fix-admin-membership-submit',
                'hypothesisId' => 'H3',
                'location' => 'AdminSubmitMemberRegisForm.php:AdminSubmitRegisMemForm',
                'message' => 'Admin membership created registrationlist row',
                'data' => [
                    'created_id' => (int) ($created->id ?? 0),
                    'saved_has_ec_address' => isset($created->ec_address) && $created->ec_address !== '' && $created->ec_address !== null,
                    'saved_has_ec_email' => isset($created->ec_email) && $created->ec_email !== '' && $created->ec_email !== null,
                ],
                'timestamp' => (int) round(microtime(true) * 1000),
            ];
            file_put_contents(base_path('debug-4b0db3.log'), json_encode($payload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {
        }
        // #endregion

        return redirect()->back()->withInput()->with('success', 'Registration successful! The member application has been submitted and is now pending approval.');
    }
}
