<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminMemberRegistrationForm extends Controller
{
    public function AdminMemberRegisForm(){
        return view("Administrator.AdminRegistrationForm");
    }
}
