<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class registrationmessege extends Controller
{
    public function messege(){
        return view("Guest.RegistrationMessege");
    }
}
