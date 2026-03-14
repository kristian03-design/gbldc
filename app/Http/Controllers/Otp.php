<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class Otp extends Controller
{
    public function OTPpage(Request $request){
        // OTP
        $encryptedOTP = session('encryptedOTP');
        $decryptOTP = Crypt::decrypt($encryptedOTP);
        // Email
        $email = session('email');
       
       
        return view('Administrator.OtpPage', compact('email'));
    }
    
    public function resendOTP(Request $request)
    {
        // Check if session has email (user has completed login step 1)
        if (!session()->has('email') || !session()->has('encryptedOTP')) {
            return redirect()->route('Admin.Login')->with('error', 'Session expired. Please login again.');
        }
        
        // Get user email from session
        $email = session('email');
        
        // Find the admin user by email
        $user = \App\Models\adminlist::where('email', $email)->first();
        
        if (!$user) {
            return redirect()->route('Admin.Login')->with('error', 'User not found. Please login again.');
        }
        
        // Generate new OTP
        $OTP = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 6);
        
        try {
            Mail::to($user->email)->send(new \App\Mail\OTP($OTP, $user->full_name, 'admin'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send OTP email. Please try again.');
        }
        
        // Update session with new OTP
        $encryptedOTP = Crypt::encrypt($OTP);
        session([
            'encryptedOTP' => $encryptedOTP,
        ]);
        
        return back()->with('success', 'A new OTP has been sent to your email.');
    }
}
