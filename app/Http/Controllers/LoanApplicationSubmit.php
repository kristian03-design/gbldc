<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // To handle date formatting
use Illuminate\Support\Facades\Log;

class LoanApplicationSubmit extends Controller
{
    public function LoanAppSubmit(Request $request)
    {
        // Validate the request
        $LoanApplicationForm = $request->validate([
            // Basic Info
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'place_of_birth' => 'required|string',
            'birthdate' => 'required',
            'age' => 'required|integer|min:18',
            'gender' => 'required|string',
            'religion' => 'nullable|string',
            'nationality' => 'required|string',
            'civil_status' => 'required|string',

            'email' => 'nullable|email',
            'contact_number' => 'required|string|max:10',
            'street_address' => 'required|string',
            'province' => 'required|string',
            'city_municipality' => 'required|string',
            'barangay' => 'required|string',
            'year_of_stay' => 'required|integer|min:0',
            'house_ownership' => 'required|string',
            'zip_code' => 'required|string|max:10',

            // First Guarantor
            'g1_fullname' => 'required|string',
            'g1_relationship' => 'required|string',
            'g1_contact_number' => 'required|string|max:15',
            'g1_address' => 'required|string',
            'g1_valid_id' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Second Guarantor
            'g2_fullname' => 'required|string',
            'g2_relationship' => 'required|string',
            'g2_contact_number' => 'required|string',
            'g2_address' => 'required|string',
            'g2_valid_id' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Employment Info
            'employment_type' => 'required|string',
            'employer_business_name' => 'nullable|string',
            'position_nature_of_business' => 'nullable|string',
            'employer_business_address' => 'nullable|string',
            'monthly_income' => 'required|numeric|min:0',
            'year_in_service_operation' => 'nullable|string|min:0',

            // Image / Proof
            'proof_of_income' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Loan Info
            'loan_type' => 'required|string',
            'loan_amount' => 'required|numeric|min:0',
            'loan_term' => 'required|string',
            'purpose_of_loan' => 'required|string',
            'hr_person_name' => 'nullable|string',
            'hr_person_number' => 'nullable|string',
            'member_id' => 'required|string',
        ]);
        
        Log::info('Loan Application Submit - Data:', $LoanApplicationForm);
        
        // First Guarantor ID Image handler
        if ($request->hasFile('g1_valid_id')) {
            $file = $request->file('g1_valid_id');
            $FullName = $request->g1_fullname;
            $Filename = $FullName .'.'.time().'.'.'First_Guarantor_Valid_ID'.'.'.$file->getClientOriginalExtension();
            $ImagePath = $file->storeAs('G1_Valid_ID', $Filename, 'local');
            $LoanApplicationForm['g1_valid_id'] = $ImagePath;
        }
        // Second Guarantor ID Image handler 
        if ($request->hasFile('g2_valid_id')) {
            $file = $request->file('g2_valid_id');
            $FullName = $request->g2_fullname;
            $Filename = $FullName .'.'.time().'.'.'Second_Guarantor_Valid_ID'.'.'.$file->getClientOriginalExtension();
            $ImagePath = $file->storeAs('G2_Valid_ID', $Filename, 'local');
            $LoanApplicationForm['g2_valid_id'] = $ImagePath;
        }
        // Proof of Income Image handler
        if ($request->hasFile('proof_of_income')) {
            $file = $request->file('proof_of_income');
            $LastName = $request->last_name;
            $FirstName = $request->first_name;
            $MiddleName = $request->middle_name;
            $Filename = $LastName.'_'.$FirstName.'_'.$MiddleName.'.'.time().'.'.'Proof_of_Income'.'.'.$file->getClientOriginalExtension();
            $ImagePath = $file->storeAs('Proof_of_Income', $Filename, 'local');
            $LoanApplicationForm['proof_of_income'] = $ImagePath;
        }
       
        Log::info('Loan Application After File Upload:', $LoanApplicationForm);
        
        try {
            if (LoanApplication::where('member_id', $LoanApplicationForm['member_id'])->exists()) {
                return redirect()->back()->with('error', 'You already have a pending loan application.');
            }

            $loanApplication = LoanApplication::create($LoanApplicationForm);
            
            Log::info('Loan Application Created Successfully - ID:', ['id' => $loanApplication->id]);

            return redirect()->back()->with('success', 'You successfully sent a loan application, wait until further update.');
        } catch (\Exception $e) {
            Log::error('Loan Application Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'data' => $LoanApplicationForm
            ]);
            return redirect()->back()->with('error', 'Failed to submit loan application: ' . $e->getMessage());
        }
    }
}
