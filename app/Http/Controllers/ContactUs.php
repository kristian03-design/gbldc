<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactUs extends Controller
{
    /**
     * Display the contact us page.
     */
    public function index()
    {
        $user = Auth::guard('officialmember')->user();
        
        return view('Members.ContactUs', [
            'user' => $user,
            'fist_name' => $user->first_name,
            'middle_name' => $user->middle_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'gender' => $user->gender,
        ]);
    }

    /**
     * Handle contact form submission.
     */
    public function submit(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // In a real application, you would save this to a database 
        // or send an email to the admin
        // For now, we'll just redirect with a success message
        
        return redirect()->route('Member.ContactUs')->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }
}
