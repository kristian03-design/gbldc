<?php

namespace App\Http\Controllers;

use App\Models\loan;
use App\Models\paymentModel;
use Illuminate\Http\Request;

class loanRecords extends Controller
{
    public function loans() {
        $loans = loan::all();
        
        return view('Administrator.LoanRecord', compact('loans'));
    }
}
