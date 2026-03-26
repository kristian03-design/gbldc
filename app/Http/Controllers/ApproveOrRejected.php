<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registrationModel;
use Illuminate\Support\Facades\Auth;
use App\Models\officialmember;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use App\Models\SharedCapital;



class ApproveOrRejected extends Controller
{
    public function ApproveOrRejected(Request $request){
        $decision = $request->validate([
            'id' => 'required',
            'member_id' => 'required',
        ]);
        $memberid = $decision['member_id'];
        $find = registrationModel::where('id', $decision['id'])->first();
        if (!$find) {
            return redirect()->back()->with('error', 'Registration not found.');
        }

       $AddToOfficialList = [
            'last_name' => $find->last_name,
            'first_name' => $find->first_name,
            'middle_name' => $find->middle_name,
            'place_of_birth' => $find->place_of_birth,
            'birthdate' => $find->birthdate,
            'age' => $find->age,
            'gender' => $find->gender,
            'religion' => $find->religion,
            'nationality' => $find->nationality,
            'civil_status' => $find->civil_status,

            // Contact Information
            'email' => $find->email,
            'contact_number' => $find->contact_number,

            // Address
            'street_address' => $find->street_address,
            'province' => $find->province,
            'city' => $find->city,
            'barangay' => $find->barangay,

            // Additional Information
            'year_of_stay' => $find->year_of_stay,
            'house_ownership' => $find->house_ownership,
            'zip_code' => $find->zip_code,

            // Emergency Contact
            'ec_fullname' => $find->ec_fullname,
            'ec_gender' => $find->ec_gender,
            'ec_email' => $find->ec_email,
            'ec_contact_number' => $find->ec_contact_number,
            'ec_address' => $find->ec_address,
            'ec_relationship' => $find->ec_relationship,

            // Employment Information
            'employment_status' => $find->employment_status,
            'source_of_funds' => $find->source_of_funds,
            'employer_business_name' => $find->employer_business_name,
            'occupation' => $find->occupation,
            'company_business_address' => $find->company_business_address,
            'gross_monthly_income' => $find->gross_monthly_income,
            'nature_type_of_employment_business' => $find->nature_type_of_employment_business,
            'sss_gsis_no' => $find->sss_gsis_no,
            'tin_no' => $find->tin_no,

            // Attachments
            'proof_of_billing' => $find->proof_of_billing,
            'two_by_two_picture' => $find->two_by_two_picture,
            'valid_id' => $find->valid_id,
        ];
        $lastRecord = RegistrationModel::orderBy('id', 'desc')->first();

        if ($lastRecord && isset($lastRecord->member_number)) {
            $lastNumber = intval(substr($lastRecord->member_number, 2));
        } else {
            $lastNumber = 0;
        }

        $newNumber = $lastNumber + 1;

        $AddToOfficialList['member_number'] = 'M-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        $AddToOfficialList['member_id'] = $memberid;
        $AddToOfficialList['ApprovedBy'] = Auth::user()->email;
        $AddToOfficialList['username'] = $AddToOfficialList['email'];
        $tempPassword = Str::password(12); // secure temporary password
        $AddToOfficialList['password'] = $tempPassword; // hashed by model mutator
        // Avoid crashing if migration hasn't been run yet
        if (Schema::hasColumn('officialmembers', 'must_change_password')) {
            $AddToOfficialList['must_change_password'] = true;
        }
        // 2x2 Picture Image handler
        if ($request->hasFile('two_by_two_picture')) {
            $file = $request->file('two_by_two_picture');
            $LastName = $request->last_name;
            $FirstName = $request->first_name;
            $MiddleName = $request->middle_name;
            $Filename = $LastName.$FirstName.$MiddleName.'.'.time().'.'.'two_by_two_picture'.$file->getClientOriginalExtension();
            $ImagePath = $file->storeAs('Two_by_Two_Picture', $Filename, 'local');
            $basic_info['two_by_two_picture'] = $ImagePath;
        }
        // Proof of Billing Image handler
        if ($request->hasFile('proof_of_billing')) {
            $file = $request->file('proof_of_billing');
            $LastName = $request->last_name;
            $FirstName = $request->first_name;
            $MiddleName = $request->middle_name;
            $Filename = $LastName.$FirstName.$MiddleName.'.'.time().'.'.'proof_of_billing'.$file->getClientOriginalExtension();
            $ImagePath = $file->storeAs('Proof_of_Billings', $Filename, 'local');
            $basic_info['proof_of_billing'] = $ImagePath;
        }
        // Proof of Billing Image handler
        if ($request->hasFile('valid_id')) {
            $file = $request->file('valid_id');
            $LastName = $request->last_name;
            $FirstName = $request->first_name;
            $MiddleName = $request->middle_name;
            $Filename = $LastName.$FirstName.$MiddleName.'.'.time().'.'.'valid_id'.$file->getClientOriginalExtension();
            $ImagePath = $file->storeAs('Valid_IDs', $Filename, 'local');
            $basic_info['valid_id'] = $ImagePath;
        }

        

        
        // dd($AddToOfficialList);
        try {
            officialmember::create($AddToOfficialList);
        } catch (\Throwable $e) {
            // #region agent log
            try {
                $payload = [
                    'sessionId' => '4b0db3',
                    'runId' => 'approve-member',
                    'hypothesisId' => 'H-APPROVE-SCHEMA-MISMATCH',
                    'location' => 'ApproveOrRejected.php:ApproveOrRejected',
                    'message' => 'Approve failed creating officialmember',
                    'data' => [
                        'errorClass' => get_class($e),
                        'errorCode' => (string) $e->getCode(),
                        'hasMustChangeColumn' => Schema::hasColumn('officialmembers', 'must_change_password'),
                    ],
                    'timestamp' => (int) (microtime(true) * 1000),
                ];
                @file_put_contents(base_path('debug-4b0db3.log'), json_encode($payload) . PHP_EOL, FILE_APPEND);
            } catch (\Throwable $e2) {}
            // #endregion

            throw $e;
        }
        
        // Auto-create default shared capital record for new member (50 shares = ₱5,000)
        if (!SharedCapital::where('member_id', $memberid)->exists()) {
            $now = now();
            $sharedCapitalAmount = 5000;
            $defaultMonths = 12;
            $paymentPerSchedule = round($sharedCapitalAmount / $defaultMonths, 2);
            $paymentStartDate = $now->copy()->addMonthNoOverflow()->startOfMonth()->toDateString();

            SharedCapital::create([
                'last_name' => $find->last_name,
                'first_name' => $find->first_name,
                'middle_name' => $find->middle_name,
                'street_address' => $find->street_address,
                'barangay' => $find->barangay,
                'city' => $find->city,
                'province' => $find->province,
                'phone' => $find->contact_number,
                'email' => $find->email,
                'shared_capital_amount' => $sharedCapitalAmount,
                'shared_capital_amount_balance' => $sharedCapitalAmount,
                'date_of_membership' => $now->toDateString(),
                'member_id' => $memberid,
                'encoded_by' => Auth::user()->email,
                'remarks' => 'Auto-generated 50-share membership subscription',
                'record_creation_date' => $now->toDateString(),
                'payment_frequency' => 'monthly',
                'payment_amount_per_schedule' => $paymentPerSchedule,
                'payment_start_date' => $paymentStartDate,
                'number_of_payments' => $defaultMonths,
            ]);
        }
        
        // Send welcome email to the newly approved member
        $memberEmail = $find->email;
        $memberName = $find->first_name . ' ' . $find->last_name;
        $memberNumber = $AddToOfficialList['member_number'];
        $username = $AddToOfficialList['username'];
        $password = $AddToOfficialList['password'];
        
        try {
            Mail::to($memberEmail)->send(new \App\Mail\MembershipApproved(
                $memberEmail,
                $memberName,
                $memberNumber,
                $username,
                $tempPassword
            ));
        } catch (\Exception $e) {
            // Log the error but don't stop the process
            Log::error('Failed to send membership approval email: ' . $e->getMessage());
        }
        
        $find->delete();

        // #region agent log
        try {
            $prev = url()->previous();
            $ref = (string) $request->headers->get('referer', '');
            $payload = [
                'sessionId' => '4b0db3',
                'runId' => 'approve-member',
                'hypothesisId' => 'H-APPROVE-REDIRECT-404',
                'location' => 'ApproveOrRejected.php:ApproveOrRejected',
                'message' => 'Approved member completed; about to redirect back',
                'data' => [
                    'created' => true,
                    'must_change_password' => true,
                    'tempPasswordLen' => strlen((string) $tempPassword),
                    'prevUrlLen' => strlen((string) $prev),
                    'hasReferer' => $ref !== '',
                    'refererLen' => strlen((string) $ref),
                ],
                'timestamp' => (int) (microtime(true) * 1000),
            ];
            @file_put_contents(base_path('debug-4b0db3.log'), json_encode($payload) . PHP_EOL, FILE_APPEND);
        } catch (\Throwable $e) {}
        // #endregion

        return redirect()->back()->with('success', 'Member approved successfully.');
    }

    public function Reject(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
        ]);
        $find = registrationModel::where('id', $validated['id'])->first();
        if (!$find) {
            return redirect()->back()->with('error', 'Registration not found.');
        }
        $find->delete();
        return redirect()->back()->with('rejected', 'Member application rejected.');
    }
}
