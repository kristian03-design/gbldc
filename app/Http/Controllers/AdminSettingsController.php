<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSettingsController extends Controller
{
    public function show()
    {
        return view('Administrator.AdminSettings');
    }

    public function updateProfile(Request $request)
    {
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
}

