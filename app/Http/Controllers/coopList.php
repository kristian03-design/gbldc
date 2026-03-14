<?php

namespace App\Http\Controllers;

use App\Models\LoanApplication;
use Illuminate\Http\Request;

class coopList extends Controller
{
    public function List(){
        $LoanApplications = LoanApplication::all();
        return view('Administrator.List',compact('LoanApplications'));
    }
}
