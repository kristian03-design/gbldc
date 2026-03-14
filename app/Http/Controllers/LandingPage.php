<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPage extends Controller
{
    public function Landing(){
        return view('guest.GBLDC');
    }
}
