<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registrationModel;


class managemember extends Controller
{
    public function managemember(Request $request){
        
        $members = registrationModel::all();
        return view('Administrator.ManageMember',compact('members'));

    }
}
