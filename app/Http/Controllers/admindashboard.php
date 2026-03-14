<?php

namespace App\Http\Controllers;

use App\Models\loan;
use Illuminate\Http\Request;
use App\Models\sharedCapital;
use App\Models\officialmember;
use App\Models\LoanApplication;
use App\Models\registrationModel;
use App\Models\paymentModel;


class admindashboard extends Controller
{
    public function adminDashboard(){

        $registrations = registrationModel::all();
        $officialMembers = officialmember::all();
        $loanapplications = LoanApplication::all();
        $ApprovedLoans = loan::all();
        
        $currentMonth = now()->format('Y-m');
        $ApprovedLoansTotal = loan::where('created_at', 'like', $currentMonth . '%')->count();
        $officialMembersTotal = officialmember::count();
        $loanapplicationsTotal = LoanApplication::count();
        // Shared Capital Total Collection up to Current Month
        $currentMonthEnd = now()->endOfMonth()->format('Y-m-d');
        $allSharedCapitalPayments = paymentModel::where('transaction_type', 'Shared Capital')->get();
        $total = 0;
        foreach($allSharedCapitalPayments as $payment){
            // Filter by transaction date (decrypted) up to current month end
            if($payment->transaction_date <= $currentMonthEnd) {
                $total += $payment->payment_amount;
            }
        }

        // Loan Statistics Calculations
        $allLoans = loan::all();
        
        // Total Active Loans
        $totalActiveLoans = 0;
        
        // Total Loan Amount Disbursed
        $totalLoanAmountDisbursed = 0;
        
        // Outstanding Balance
        $outstandingBalance = 0;
        
        // Overdue Amount
        $overdueAmount = 0;
        
        $today = now();
        
        foreach($allLoans as $loan) {
            $status = $loan->loan_status;
            $loanAmount = (float) $loan->loan_amount;
            $loanBalance = (float) $loan->loan_balance;
            $paymentStartDate = $loan->payment_start_date;
            
            // Check if loan is active (status is 'Ongoing' when approved)
            if($status === 'Ongoing') {
                $totalActiveLoans++;
                $totalLoanAmountDisbursed += $loanAmount;
                $outstandingBalance += $loanBalance;
                
                // Check if overdue (payment_start_date has passed and still has balance)
                if($paymentStartDate && $today->gt($paymentStartDate) && $loanBalance > 0) {
                    $overdueAmount += $loanBalance;
                }
            }
        }
        
        // Repaid Amount - Sum of all loan payments
        $loanPayments = paymentModel::where('transaction_type', 'Loan Payment')->get();
        $repaidAmount = 0;
        foreach($loanPayments as $payment) {
            $repaidAmount += $payment->payment_amount;
        }

        // Interest Rate - average from active loans with rate set, or default 1%
        $interestRateDisplay = '1%';
        if (\Illuminate\Support\Facades\Schema::hasColumn('loanlist', 'interest_rate')) {
            $loansWithRate = loan::where('loan_status', 'Ongoing')
                ->whereNotNull('interest_rate')
                ->where('interest_rate', '!=', '')
                ->get();
            if ($loansWithRate->isNotEmpty()) {
                $sum = 0;
                $count = 0;
                foreach ($loansWithRate as $l) {
                    $val = (float) $l->interest_rate;
                    if ($val > 0) {
                        $sum += ($val <= 1 ? $val * 100 : $val); // assume 0.01 = 1% or 1 = 1%
                        $count++;
                    }
                }
                if ($count > 0) {
                    $avg = $sum / $count;
                    $interestRateDisplay = number_format($avg, 1) . '%';
                }
            }
        }

        return view('Administrator.Admindashboard', 
        compact('registrations','officialMembers','loanapplications','officialMembersTotal','loanapplicationsTotal','total', 'ApprovedLoans', 'ApprovedLoansTotal', 'totalActiveLoans', 'totalLoanAmountDisbursed', 'outstandingBalance', 'repaidAmount', 'overdueAmount', 'interestRateDisplay'));
    }
}
