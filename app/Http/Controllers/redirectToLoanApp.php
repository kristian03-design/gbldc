<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class redirectToLoanApp extends Controller
{
    public function RedirectToLoanApp(Request $request){
        
        $data = $request->validate([
            'account' => 'required|string',
        ]);
        $user = $data['account'];
        session(['user' => $user]);
        return redirect()->route('Loan.App');
    }
}
