<?php

namespace App\Http\Controllers;

use App\Models\paymentModel;
use App\Models\loan;
use App\Models\sharedCapital;
use Illuminate\Http\Request;

class RedirectToLastRecord extends Controller
{
    public function LastRecord($member_id, $type = null){
        if ($type === 'shared_capital') {
            $ShowRecords = sharedCapital::where('member_id', $member_id)->get();
        } elseif ($type === 'loan') {
            $ShowRecords = loan::where('member_id', $member_id)->get();
        } else {
            // Default behavior - show all records
            $ShowRecords = paymentModel::where('member_id', $member_id)->get();
        }

        $ID = $member_id;
        return view('Administrator.PastRecord', compact('ShowRecords','ID', 'type'));
    }
}
