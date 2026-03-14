<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberLogin extends Controller
{
    public function MemberLoginPage(Request $request){
        return view('Guest.MemberLoginPage');
    }
}
