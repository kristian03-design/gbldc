<?php

namespace App\Http\Controllers;

use App\Models\paymentModel;
use Illuminate\Http\Request;
use App\Models\LoanApplication;
use Illuminate\Support\Facades\Storage;

class ViewPastRecord extends Controller
{
    public function view($id){
       $Recipt = paymentModel::findOrFail($id);
        
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
            abort(404, 'One or more files not found.');
        }

        $Record = $Recipt;

        $AdminFileContents = Storage::get($AdminFilePath);
        $MemberFileContents = Storage::get($MemberFilePath);

        $AdminMimeType = Storage::mimeType($AdminFilePath);
        $MemberMimeType = Storage::mimeType($MemberFilePath);

        $AdminBase64 = base64_encode($AdminFileContents);
        $MemberBase64 = base64_encode($MemberFileContents);

        
        return view('Administrator.ViewPastRecord', 
        compact('Record', 'AdminBase64', 'MemberBase64',
                          'AdminMimeType', 'MemberMimeType',
                          'AdminFilePath', 'MemberFilePath'));
    }
}
