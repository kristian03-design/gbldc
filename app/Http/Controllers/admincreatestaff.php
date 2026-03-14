<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admincreatestaff extends Controller
{
    public function AdminCreate(){
        return view('Administrator.AdminCreateStaff');
    }    
}
