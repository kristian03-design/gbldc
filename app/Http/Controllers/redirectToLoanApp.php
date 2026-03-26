<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SharedCapital;

class redirectToLoanApp extends Controller
{
    public function RedirectToLoanApp(Request $request){
        
        $data = $request->validate([
            'account' => 'required|string',
        ]);
        $user = $data['account'];

        $sharedCapital = SharedCapital::where('member_id', $user)->first();
        if (!$sharedCapital) {
            return redirect()->back()->with('error', 'You must have a Shared Capital account before applying for a loan.');
        }

        $paidAmount = $sharedCapital->shared_capital_amount_balance - $sharedCapital->shared_capital_amount;
        $requiredAmount = $sharedCapital->shared_capital_amount_balance * 0.5;

        if ($paidAmount < $requiredAmount) {
            return redirect()->back()->with('error', 'You cannot apply for a loan yet. Your Shared Capital must be at least 50% paid.');
        }

        session(['user' => $user]);
        return redirect()->route('Loan.App');
    }
}
