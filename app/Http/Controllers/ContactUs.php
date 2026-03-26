<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMessage;

class ContactUs extends Controller
{
    /**
     * Display the contact us page.
     */
    public function index()
    {
        /** @var \App\Models\OfficialMember $user */
        $user = Auth::guard('officialmember')->user();
        
        return view('Members.ContactUs', [
            'user' => $user,
            'fist_name' => $user->first_name,
            'middle_name' => $user->middle_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'gender' => $user->gender,
            'member_id' => $user->member_id,
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

        /** @var \App\Models\OfficialMember $user */
        $user = Auth::guard('officialmember')->user();

        $memberName = trim($user->first_name . ' ' . ($user->middle_name ?? '') . ' ' . $user->last_name);
        $memberEmail = $user->email;

        $adminAddress = config('mail.from.address', 'gbldccoop@gmail.com');

        Mail::to($adminAddress)->send(
            new ContactUsMessage(
                memberName: $memberName,
                memberEmail: $memberEmail,
                subjectLine: $request->subject,
                body: $request->message,
            )
        );

        return redirect()
            ->route('Member.ContactUs')
            ->with('success', 'Your message has been sent successfully! Our admin team will review it and get back to you soon.');
    }
}
