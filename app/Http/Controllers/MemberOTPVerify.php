<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class MemberOTPVerify extends Controller
{
    public function verifyMemberOTP(Request $request)
    {
        // Check if session has required data
        if (!session()->has('member_encryptedOTP')) {
            return redirect()->route('Member.Login')->with('error', 'Session expired. Please login again.');
        }

        // Validate the OTP input
        $request->validate([
            'OTP' => 'required|string'
        ]);

        try {
            $decryptedOTP = Crypt::decrypt(session('member_encryptedOTP'));
        } catch (\Exception $e) {
            return back()->with('error', 'Invalid OTP format. Please try again.');
        }

        $inputOTP = strtoupper($request->OTP);

        if ($inputOTP === $decryptedOTP) {
            // OTP is correct - login the user
            // Get the member_id from session
            $memberId = session('member_user_id');
            
            // Log the member in
            $user = \App\Models\OfficialMember::where('member_id', $memberId)->first();
            
            if ($user) {
                // Store session data
                session(['AuthUser' => $user->member_id]);
                
                // Clear OTP-related session data
                session()->forget('member_encryptedOTP');
                
                // LOGIN the user via Laravel Auth guard (THIS IS THE KEY FIX)
                Auth::guard('officialmember')->login($user);
                
                // Regenerate session
                $request->session()->regenerate();
                
                return redirect()->route('Member.Landing');
            } else {
                return redirect()->route('Member.Login')->with('error', 'User not found. Please login again.');
            }
        }

        return back()->with('error', 'Invalid OTP. Please try again.');
    }
}
