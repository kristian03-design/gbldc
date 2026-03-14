<?php

namespace App\Http\Controllers;
use App\Models\registrationModel;

use Illuminate\Http\Request;

class register extends Controller
{
    Public function Register(Request $request){
        $membership = $request->validate([
            // Basic Information
            'salutation' => 'required|string',
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'required|string',
            'place_of_birth' => 'required|string',
            'birthdate' => 'required|date',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'religion' => 'required|string',
            'nationality' => 'required|string',
            'civil_status' => 'required|string',
            // Contact Information
            'email' => 'required|email|unique:registrationlist,email',
            'contact_number' => 'required|string|unique:registrationlist,contact_number',
            // Address
            'street_address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',    
            'barangay' => 'required|string',
            'year_of_stay' => 'required|string',
            'house_ownership' => 'required|string',
            'zip_code' => 'required|string',
        ]);
        registrationModel::create($membership);
        return redirect()->back();
    }
}
