<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Models\OfficialMember;

class memberOTPpage extends Controller
{
    public function MemberOTP(Request $request)
    {
        // Check if session has required data
        if (!session()->has('member_email') || !session()->has('member_encryptedOTP')) {
            return redirect()->route('Member.Login')->with('error', 'Session expired. Please login again.');
        }

        $email = session('member_email');
        
        return view('Members.MemberOTPpage', compact('email'));
    }
    
    public function resendMemberOTP(Request $request)
    {
        // Check if session has required data
        if (!session()->has('member_email') || !session()->has('member_encryptedOTP')) {
            return redirect()->route('Member.Login')->with('error', 'Session expired. Please login again.');
        }
        
        // Get user info from session
        $email = session('member_email');
        $memberId = session('member_user_id');
        
        // Find the member user
        $user = OfficialMember::where('member_id', $memberId)->orWhere('email', $email)->first();
        
        if (!$user) {
            return redirect()->route('Member.Login')->with('error', 'User not found. Please login again.');
        }
        
        // Generate new OTP
        $OTP = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 6);
        
        // Get user name
        $userName = $user->first_name ?? 'Member';
        if (isset($user->first_name) && isset($user->last_name)) {
            $userName = $user->first_name . ' ' . $user->last_name;
        }
        
        try {
            Mail::to($user->email)->send(new \App\Mail\OTP($OTP, $userName, 'member'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send OTP email. Please try again.');
        }
        
        // Update session with new OTP
        $encryptedOTP = Crypt::encrypt($OTP);
        session([
            'member_encryptedOTP' => $encryptedOTP,
        ]);
        
        return back()->with('success', 'A new OTP has been sent to your email.');
    }
}
