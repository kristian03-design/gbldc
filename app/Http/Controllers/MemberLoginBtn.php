<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class MemberLoginBtn extends Controller
{
    public function MemberLoginBtn(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('officialmember')->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $user = Auth::guard('officialmember')->user();
            
            // Check if account is deactivated
            if (isset($user->status) && $user->status === 'Deactivated') {
                Auth::guard('officialmember')->logout();
                return redirect()->back()->with('error', 'Your account has been deactivated.');
            }

            // Generate OTP
            $OTP = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 6);

            // Get user email - check multiple possible fields
            $userEmail = $user->email ?? $user->username ?? null;
            
            if (!$userEmail) {
                Auth::guard('officialmember')->logout();
                return redirect()->back()->with('error', 'Your account does not have an email address. Please contact support.');
            }

            // Get user name - check multiple possible fields
            $userName = $user->first_name ?? $user->full_name ?? 'Member';
            if (isset($user->first_name) && isset($user->last_name)) {
                $userName = $user->first_name . ' ' . $user->last_name;
            }

            try {
                Mail::to($userEmail)->send(new \App\Mail\OTP($OTP, $userName, 'member'));
            } catch (\Exception $e) {
                return back()->with('error', 'Failed to send OTP email. Please try again.');
            }

            // Store encrypted OTP and user info in session
            $encryptedOTP = Crypt::encrypt($OTP);
            session([
                'member_encryptedOTP' => $encryptedOTP,
                'member_email' => $userEmail,
                'member_user_id' => $user->member_id,
            ]);

            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            return redirect()->route('Member.OTPpage');
        }
        return redirect()->back()->with('error', 'Invalid email or password.');
    }
}
