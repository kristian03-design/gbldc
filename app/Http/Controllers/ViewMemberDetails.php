<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\officialmember;

class ViewMemberDetails extends Controller
{
    public function viewDetails($member_id){
        $Member = officialmember::where('member_id', $member_id)->first();
        // dd($Member);
        return view('Administrator.ViewMemberDetails', compact('Member'));
    }
}
