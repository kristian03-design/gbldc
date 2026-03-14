<?php

namespace App\Http\Controllers;

use App\Models\paymentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ViewLoanReceipt extends Controller
{
    public function ViewLoanReceipt($id){
        $Recipt = paymentModel::findOrFail($id);

        // Check if the record is for Loan Payment
        if ($Recipt->transaction_type !== 'Loan Payment') {
            return redirect()->back()->with('error', 'This record is not a Loan Payment.');
        }

        // Check if admin_copy or member_copy are missing
        if (!$Recipt->admin_copy || !$Recipt->member_copy) {
            return redirect()->back()->with('error', 'No data to display: admin_copy or member_copy is missing.');
        }

        $AdminFilePath = $Recipt->admin_copy;
        $MemberFilePath = $Recipt->member_copy;

        $fileExit = true;

        if (empty($AdminFilePath) || !Storage::exists($AdminFilePath)) {
            $fileExit = false;
        }
        if (empty($MemberFilePath) || !Storage::exists($MemberFilePath)) {
            $fileExit = false;
        }
        if (!$fileExit) {
            return redirect()->back()->with('error', 'One or more files not found.');
        }

        $Record = $Recipt;

        $AdminFileContents = Storage::get($AdminFilePath);
        $MemberFileContents = Storage::get($MemberFilePath);

        $AdminMimeType = Storage::mimeType($AdminFilePath);
        $MemberMimeType = Storage::mimeType($MemberFilePath);

        $AdminBase64 = base64_encode($AdminFileContents);
        $MemberBase64 = base64_encode($MemberFileContents);


        return view('Administrator.receipt',
        compact('Record', 'AdminBase64', 'MemberBase64',
                          'AdminMimeType', 'MemberMimeType',
                          'AdminFilePath', 'MemberFilePath'));
    }
}
