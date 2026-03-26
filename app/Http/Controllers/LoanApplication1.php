<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\officialmember;
use App\Models\SharedCapital;


class LoanApplication1 extends Controller
{
    public function LoanApplication1(Request $request){
        // Support both session keys: AuthUser (after OTP login) and user (from redirect)
        $data = session('AuthUser') ?? session('user');
        
        if (!$data) {
            return redirect()->route('Member.Login')->with('error', 'Please login first.');
        }

        $sharedCapital = SharedCapital::where('member_id', $data)->first();
        if (!$sharedCapital) {
            return redirect()->route('Member.Loans')->with('error', 'You must have a Shared Capital account before applying for a loan.');
        }

        $paidAmount = $sharedCapital->shared_capital_amount_balance - $sharedCapital->shared_capital_amount;
        $requiredAmount = $sharedCapital->shared_capital_amount_balance * 0.5;

        if ($paidAmount < $requiredAmount) {
            return redirect()->route('Member.Loans')->with('error', 'You cannot apply for a loan yet. Your Shared Capital must be at least 50% paid.');
        }
        
        $AutoComplete = OfficialMember::where('member_id' , $data)->first();
        
        return view('Members.LoanApplicationPage1',compact('AutoComplete'));
    }
    
    // Admin loan application - with member_id from search
    public function AdminLoanApplication(Request $request, $member_id){
        $AutoComplete = OfficialMember::where('member_id', $member_id)->first();
        
        if (!$AutoComplete) {
            return redirect()->route('Add.Transactions')->with('error', 'Member not found.');
        }
        
        $interestTiers = config('loan_interest_tiers.tiers', []);
        return view('Administrator.AdminCreateLoan', compact('AutoComplete', 'interestTiers'));
    }
}
