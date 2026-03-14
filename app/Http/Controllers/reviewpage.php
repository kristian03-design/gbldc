<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class reviewpage extends Controller
{
    public function ViewReviewPage(){
          $encryptData1 = session('EncryptData1');
          $BasicInfo = Crypt::decrypt($encryptData1);
          $FirstGuarantor = session('FirstGuarantor');
        return view('Members.LoanApplicationPage5',compact('BasicInfo','FirstGuarantor'));
    }
}
