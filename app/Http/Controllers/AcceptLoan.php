<?php

namespace App\Http\Controllers;

use App\Models\loan;
use App\Services\LoanInterestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\LoanApplication;
use App\Models\officialmember;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AcceptLoan extends Controller
{
    public function SaveLoan(Request $request){
        $AcceptLoan = $request->validate([
            'id' => 'required|integer',
            'loan_number' => 'required|string',
            'loan_term' => 'required|string',
            'frequency_of_payment' => 'required|string',
            'payment_start_date' => 'required|date',
            'loan_amount' => 'required|numeric|min:0',
            'due_amount' => 'required|numeric|min:0',
            'approved_by' => 'required|string|max:255',
            'encoded_by' => 'required|string|max:255',
        ], [
            'loan_number.required' => 'Loan number is required (use the auto-generated value).',
            'due_amount.required' => 'Due amount is required. Enter a loan amount and term, then use the interest calculator or fill Due Amount.',
            'payment_start_date.required' => 'Payment start date is required.',
            'approved_by.required' => 'Approved by (approver name) is required.',
            'encoded_by.required' => 'Encoded by (encoder name) is required.',
        ]);

        $ApplicationRecord = LoanApplication::where('id', $AcceptLoan['id'])->first();

        if (!$ApplicationRecord) {
            return redirect()->route('LoanApp.list')
                ->with('error', 'Loan application not found or already processed.');
        }

        $CreateLoan = [];
        $CreateLoan['loan_number'] = $AcceptLoan['loan_number'];
        $CreateLoan['member_id'] = $ApplicationRecord['member_id'];
        
        // Match the actual column order: first_name, last_name, middle_name
        $CreateLoan['first_name'] = $ApplicationRecord['first_name'];
        $CreateLoan['last_name'] = $ApplicationRecord['last_name'];
        $CreateLoan['middle_name'] = $ApplicationRecord['middle_name'];
        
        $CreateLoan['place_of_birth'] = $ApplicationRecord['place_of_birth'];
        $CreateLoan['birthdate'] = $ApplicationRecord['birthdate'];
        $CreateLoan['age'] = $ApplicationRecord['age'];
        $CreateLoan['gender'] = $ApplicationRecord['gender'];
        $CreateLoan['religion'] = $ApplicationRecord['religion'];
        $CreateLoan['nationality'] = $ApplicationRecord['nationality'];
        $CreateLoan['civil_status'] = $ApplicationRecord['civil_status'];
        $CreateLoan['email'] = $ApplicationRecord['email'];
        $CreateLoan['contact_number'] = $ApplicationRecord['contact_number'];
        $CreateLoan['street_address'] = $ApplicationRecord['street_address'];
        $CreateLoan['province'] = $ApplicationRecord['province'];
        $CreateLoan['city_municipality'] = $ApplicationRecord['city_municipality'];
        $CreateLoan['barangay'] = $ApplicationRecord['barangay'];
        $CreateLoan['year_of_stay'] = $ApplicationRecord['year_of_stay'];
        $CreateLoan['house_ownership'] = $ApplicationRecord['house_ownership'];
        $CreateLoan['zip_code'] = $ApplicationRecord['zip_code'];

        $CreateLoan['employment_type'] = $ApplicationRecord['employment_type'];
        $CreateLoan['employer_business_name'] = $ApplicationRecord['employer_business_name'];
        $CreateLoan['position_nature_of_business'] = $ApplicationRecord['position_nature_of_business'];
        $CreateLoan['employer_business_address'] = $ApplicationRecord['employer_business_address'];
        $CreateLoan['monthly_income'] = $ApplicationRecord['monthly_income'];
        $CreateLoan['year_in_service_operation'] = $ApplicationRecord['year_in_service_operation'];
        $CreateLoan['loan_rec_proof_of_income'] = $ApplicationRecord['proof_of_income'];
        
        $CreateLoan['loan_type'] = $ApplicationRecord['loan_type'];
        $CreateLoan['loan_amount'] = $AcceptLoan['loan_amount'];
        $CreateLoan['loan_term'] = $ApplicationRecord['loan_term'];

        // Tiered compound interest (Philippines cooperative–inspired): rate by loan amount, monthly compounding
        $principal = (float) $AcceptLoan['loan_amount'];
        $termMonths = LoanInterestService::termToMonths($ApplicationRecord['loan_term'] ?? 12);
        $tiered = LoanInterestService::tieredCompound($principal, $termMonths);
        $dueAmount = $tiered['total_due'];
        $interestRate = $tiered['annual_rate'];

        // Only set optional numeric fields if the column exists in loanlist
        $optionalNumeric = [
            'monthly_payment'     => $termMonths > 0 ? round($dueAmount / $termMonths, 2) : null,
            'total_amount_due'   => $dueAmount,
            'interest_rate'      => $interestRate,
            'outstanding_balance' => $AcceptLoan['loan_amount'] ?? null,
            'amount_paid'        => null,
            'loan_release_date'  => date('Y-m-d'),
        ];
        foreach ($optionalNumeric as $column => $value) {
            if (Schema::hasColumn('loanlist', $column)) {
                $CreateLoan[$column] = $value;
            }
        }

        $CreateLoan['frequency_of_payment'] = $AcceptLoan['frequency_of_payment'];
        $CreateLoan['payment_start_date'] = $AcceptLoan['payment_start_date'];
        $CreateLoan['loan_balance'] = $AcceptLoan['loan_amount'];
        $CreateLoan['due_amount'] = $dueAmount;
        $CreateLoan['purpose_of_loan'] = $ApplicationRecord['purpose_of_loan'];
        $CreateLoan['loan_status'] = 'Ongoing';

        $CreateLoan['hr_person_name'] = $ApplicationRecord['hr_person_name'];
        $CreateLoan['hr_person_number'] = $ApplicationRecord['hr_person_number'];

        $CreateLoan['g1_fullname'] = $ApplicationRecord['g1_fullname'];
        $CreateLoan['g1_relationship'] = $ApplicationRecord['g1_relationship'];
        $CreateLoan['g1_contact_number'] = $ApplicationRecord['g1_contact_number'];
        $CreateLoan['g1_address'] = $ApplicationRecord['g1_address'];
        $CreateLoan['loan_rec_g1_valid_id'] = $ApplicationRecord['g1_valid_id'];

        $CreateLoan['g2_fullname'] = $ApplicationRecord['g2_fullname'];
        $CreateLoan['g2_relationship'] = $ApplicationRecord['g2_relationship'];
        $CreateLoan['g2_contact_number'] = $ApplicationRecord['g2_contact_number'];
        $CreateLoan['g2_address'] = $ApplicationRecord['g2_address'];
        $CreateLoan['loan_rec_g2_valid_id'] = $ApplicationRecord['g2_valid_id'];
        
        $CreateLoan['approved_by'] = $AcceptLoan['approved_by'];
        $CreateLoan['encoded_by'] = $AcceptLoan['encoded_by'];

        loan::create($CreateLoan);
        
        // Send loan approval notification email
        $this->sendLoanApprovalNotification($CreateLoan);
        
        $ApplicationRecord->delete();
        return redirect()->route('LoanApp.list')->with('success', 'You successfully add new loan.');
    }
    
    /**
     * Send loan approval notification email to member
     */
    private function sendLoanApprovalNotification($loanData)
    {
        // Try to get member email from officialmember table
        $member = officialmember::where('member_id', $loanData['member_id'])->first();
        
        if ($member && $member->email) {
            $email = $member->email;
            $memberName = $loanData['first_name'] . ' ' . $loanData['last_name'];
            
            try {
                Mail::to($email)->send(new \App\Mail\LoanStatusNotification(
                    $email,
                    $memberName,
                    'Approved',
                    $loanData['loan_number'],
                    $loanData['loan_amount'],
                    $loanData['due_amount'],
                    $loanData['loan_term'],
                    $loanData['payment_start_date']
                ));
                Log::info('Loan approval notification email sent successfully to: ' . $email);
            } catch (\Exception $e) {
                Log::error('Failed to send loan approval notification email: ' . $e->getMessage());
            }
        } else {
            Log::warning('Loan approval notification skipped: No email address found for member ID: ' . $loanData['member_id']);
        }
    }
}
