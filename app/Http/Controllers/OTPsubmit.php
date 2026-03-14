<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OTPsubmit extends Controller
{
    public function ConfirmOTP(Request $request)
    {
        // Validate the OTP input
        $request->validate([
            'OTP' => 'required|string'
        ]);
        
        // Check if session has encryptedOTP
        if (!session()->has('encryptedOTP')) {
            return redirect()->route('Admin.Login')->with('error', 'Session expired. Please login again.');
        }
        
        $DecryptOTP = Crypt::decrypt(session('encryptedOTP'));
        
        if ($request->OTP === $DecryptOTP) {
            // OTP is correct, redirect to dashboard
            return redirect()->route('Admin.dashboard');
        } else {
            // OTP is incorrect, return back with error
            return back()->with('error', 'Invalid OTP. Please try again.');
        }
    }
}
