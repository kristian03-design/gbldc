<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FAQController extends Controller
{
    /**
     * Display the FAQ page.
     */
    public function index()
    {
        $user = Auth::guard('officialmember')->user();
        
        return view('Members.FAQ', [
            'user' => $user,
            'fist_name' => $user->first_name,
            'middle_name' => $user->middle_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'gender' => $user->gender,
        ]);
    }
}
