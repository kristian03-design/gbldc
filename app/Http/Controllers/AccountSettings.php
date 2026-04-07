<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\OfficialMember;

class AccountSettings extends Controller
{
    /**
     * Display the account settings form.
     */
    public function index()
    {
        /** @var \App\Models\OfficialMember $user */
        $user = Auth::guard('officialmember')->user();
        
        return view('Members.AccountSettings', [
            'user' => $user,
            'fist_name' => $user->first_name,
            'middle_name' => $user->middle_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'contact_number' => $user->contact_number,
            'gender' => $user->gender,
            'member_id' => $user->member_id,
        ]);
    }

    /**
     * Update basic information.
     */
    public function updateBasicInfo(Request $request)
    {
        /** @var \App\Models\OfficialMember $user */
        $user = Auth::guard('officialmember')->user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
        ]);

        return redirect()->route('Member.AccountSettings')->with('success', 'Basic information updated successfully!');
    }

    /**
     * Update contact information.
     */
    public function updateContact(Request $request)
    {
        /** @var \App\Models\OfficialMember $user */
        $user = Auth::guard('officialmember')->user();

        $request->validate([
            'email' => 'required|email|max:255|unique:officialmembers,email,' . $user->id,
            'contact_number' => 'required|string|max:20',
        ]);

        $user->update([
            'email' => $request->email,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()->route('Member.AccountSettings')->with('success', 'Contact information updated successfully!');
    }

    /**
     * Update address information.
     */
    public function updateAddress(Request $request)
    {
        /** @var \App\Models\OfficialMember $user */
        $user = Auth::guard('officialmember')->user();

        $request->validate([
            'street_address' => 'nullable|string|max:255',
            'barangay' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
        ]);

        $user->update([
            'street_address' => $request->street_address,
            'barangay' => $request->barangay,
            'city' => $request->city,
            'province' => $request->province,
            'zip_code' => $request->zip_code,
        ]);

        return redirect()->route('Member.AccountSettings')->with('success', 'Address information updated successfully!');
    }

    /**
     * Update password.
     */
    public function updatePassword(Request $request)
    {
        /** @var \App\Models\OfficialMember $user */
        $user = Auth::guard('officialmember')->user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $user->update([
            'password' => $request->new_password,
        ]);

        return redirect()->route('Member.AccountSettings')->with('success', 'Password updated successfully!');
    }

    public function updateProfilePicture(Request $request)
    {
        /** @var \App\Models\OfficialMember $user */
        $user = Auth::guard('officialmember')->user();

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/profile_pictures'), $filename);

            $user->update([
                'profile_picture' => $filename,
            ]);
        }

        return redirect()->route('Member.AccountSettings')->with('success', 'Profile picture updated successfully!');
    }
}
