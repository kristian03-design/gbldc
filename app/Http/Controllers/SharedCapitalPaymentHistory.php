<?php

namespace App\Http\Controllers;

use App\Models\paymentModel;
use Illuminate\Http\Request;

class SharedCapitalPaymentHistory extends Controller
{
    public function ViewSHPH($member_id){
        $FindRecord = paymentModel::where('member_id', $member_id)
            ->where('transaction_type', 'Shared Capital')
            ->get();

        // Debug: Check all records for this member_id
        // $FindRecord = paymentModel::where('member_id', $member_id)->get();     
        // dd([
        //     'member_id' => $member_id,
        //     'all_records_for_member' => $allRecords,
        //     'shared_capital_records' => $sharedCapitalRecords,
        //     'filtered_records' => $FindRecord
        // ]);

        return view('Administrator.ViewSharedCapitalPaymentHistory', compact('FindRecord'));
    }

    public function ViewSHPHDetail($member_id){
        $FindRecord = paymentModel::where('member_id', $member_id)
            ->where('transaction_type', 'Shared Capital')
            ->get();

        return view('Administrator.SharedCapitalPaymentHistoryDetail', compact('FindRecord'));
    }

    public function viewReceipt($id){
        $payment = paymentModel::findOrFail($id);
        return view('Administrator.receipt', compact('payment'));
    }
}
