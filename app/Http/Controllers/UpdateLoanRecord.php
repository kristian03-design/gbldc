<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\loan;

class UpdateLoanRecord extends Controller
{
    public function updateRecord($loan_number){
        return view("Administrator.UpdateLoanRecord");
    }

    public function markFinished($loan_number){
        $loan = loan::where('loan_number', $loan_number)->first();
        if ($loan) {
            $loan->loan_status = 'Fully Paid';
            $loan->loan_balance = '0';
            $loan->save();
            return redirect()->back()->with('success', 'Loan marked as finished successfully.');
        }
        return redirect()->back()->with('error', 'Loan not found.');
    }
}
