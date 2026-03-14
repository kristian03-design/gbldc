<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminlogin extends Controller
{
    public function adminlogin(){
        return view('Administrator.AdminLoginPage');
    }
}
