<?php

namespace App\Http\Controllers;

use App\Models\OfficialMember;
use Illuminate\Http\Request;

class FindMember extends Controller
{
    // Handle GET request - display the find member page
    public function findMember(){
        $Members = OfficialMember::all();
        return view('Administrator.AddTransactions', compact('Members'));
    }
    
    // Handle POST request - process the member search
    public function findMemberPost(Request $request){
          $FindMember = $request->validate([
          'member_id' => 'required|string',
        ]);
        $GetMember = OfficialMember::where('member_id', $FindMember['member_id'])->first();
    if($GetMember){
        $Member = $GetMember['member_id'];
        session(['Member'=> $Member]);
        return redirect()->route('Shared.Capital.Form');
        }
    return redirect()->back()->with('error', 'Error!, Member ID is invalid.');
    }
    
    // Handle POST request - process the member search for loan
    public function findMemberForLoan(Request $request){
          $FindMember = $request->validate([
          'member_id' => 'required|string',
        ]);
        $GetMember = OfficialMember::where('member_id', $FindMember['member_id'])->first();
    if($GetMember){
        $Member = $GetMember['member_id'];
        return redirect()->route('Admin.Create.Loan', ['member_id' => $Member]);
        }
    return redirect()->back()->with('error', 'Error!, Member ID is invalid.');
    }
}
