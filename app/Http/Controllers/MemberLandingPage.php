<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberLandingPage extends Controller
{
    public function MemberLP(){
        // Support both session keys: AuthUser (after OTP login) and user (from redirect)
        $user_account = session('AuthUser') ?? session('user');
        
        if (!$user_account) {
            return redirect()->route('Member.Login')->with('error', 'Please login first.');
        }
        
        return view('Members.MemberLandingPage',compact('user_account'));
    }
}
