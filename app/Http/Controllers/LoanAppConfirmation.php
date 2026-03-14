<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanAppConfirmation extends Controller
{
    public function LoanConfirmation(){
        $user_account = session("data");
    
        return view('Members.LoanApplicationMessege',compact('user_account'));
    }
}
