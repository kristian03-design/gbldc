<?php

namespace App\Http\Controllers;

use App\Models\adminlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class createstaff extends Controller
{
    public function createstaff(Request $request)
    {
        $credentials = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:adminlist,email',
            'password' => 'required|string',
            'position' => 'required|string'
        ]);

        $credentials['status'] = 'Active';
        
        // Save to database
        adminlist::create($credentials);

        return redirect()->back()->with('success', 'Staff created successfully');
    }
}
