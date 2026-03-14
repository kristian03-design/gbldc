<?php

namespace App\Http\Controllers;

use App\Models\SharedCapital;
use Illuminate\Http\Request;

class SaveSharedCapitalRecord extends Controller
{
    public function save(Request $request){
        $SharedCapitalRecord = $request->validate([
            'last_name'=> 'required|string',
            'first_name'=> 'required|string',
            'middle_name'=> 'required|string',
            'street_address'=> 'required|string',
            'barangay'=> 'required|string',
            'city'=> 'required|string',
            'province'=> 'required|string',
            'phone'=> 'required|string',
            'email'=> 'required|email',
            'shared_capital_amount'=> 'required|integer',
            'date_of_membership'=> 'required|date',
            'member_id'=> 'required|string',
            'encoded_by'=> 'required|string',
            'remarks'=> 'string|nullable',
            'record_creation_date'=> 'required|date',
            'payment_frequency'=> 'required|string',
            'payment_amount_per_schedule'=> 'required|numeric',
            'payment_start_date'=> 'required|date',
            'number_of_payments'=> 'required|integer',
        ]);
        // dd($SharedCapitalRecord);
        $SharedCapitalRecord['shared_capital_amount_balance'] = $SharedCapitalRecord['shared_capital_amount'];

        SharedCapital::create($SharedCapitalRecord);
        return back()->with('success','You successfully create a shared capital record.');

    }
}
