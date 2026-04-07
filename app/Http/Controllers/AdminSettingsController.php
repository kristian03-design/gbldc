<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\adminlist;

class AdminSettingsController extends Controller
{
    public function show()
    {
        return view('Administrator.AdminSettings');
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\adminlist $admin */
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:adminlist,email,' . $admin->id],
            'position' => ['required', 'string', 'max:255'],
        ]);

        $admin->fill($validated);
        $admin->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        /** @var \App\Models\adminlist $admin */
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($validated['current_password'], $admin->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $admin->forceFill([
            'password' => $validated['new_password'], // hashed via model mutator
        ])->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
    public function updateProfilePicture(Request $request)
    {
        /** @var \App\Models\adminlist $admin */
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'profile_picture' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/profile_pictures'), $filename);

            $admin->profile_picture = $filename;
            $admin->save();
        }

        return redirect()->back()->with('success', 'Profile picture updated successfully.');
    }
}

