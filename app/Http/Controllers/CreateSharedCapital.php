<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficialMember;

class CreateSharedCapital extends Controller
{
    public function ShareCapitalRecord(){
        $memberdata = session("Member");
        $details = OfficialMember::where("member_id",$memberdata)->first();
        if(empty($details)){
            return back();
        }

        return view("Administrator.AdminCreateSharedCapitalRecord",compact("details"));
    }
}
