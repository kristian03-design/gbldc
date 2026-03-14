<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanAppConfirmationRedirectBack extends Controller
{
    public function redirectBack(Request $request){
        $data= $request->validate([
            "user"=> "required|string",
        ]);
        $user_account = $data["user"];
    
        session(["user_account" => $user_account]);
        return redirect()->route('Member.Landing');
    }
}
