<?php

namespace App\Http\Controllers;

use App\Models\OfficialMember;
use Illuminate\Http\Request;

class AddTransactions extends Controller
{
    public function Transaction(){
        $Members = OfficialMember::all();
        return view('Administrator.AddTransactions', compact('Members'));
    }
}
