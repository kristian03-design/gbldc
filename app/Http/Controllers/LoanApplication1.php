<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\officialmember;


class LoanApplication1 extends Controller
{
    public function LoanApplication1(Request $request){
        // Support both session keys: AuthUser (after OTP login) and user (from redirect)
        $data = session('AuthUser') ?? session('user');
        
        if (!$data) {
            return redirect()->route('Member.Login')->with('error', 'Please login first.');
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
