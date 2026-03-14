<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class registration extends Controller
{
    public function registration_page1(){
        return view('Guest.registration');
    }
}
