<?php

namespace App\Http\Controllers;

use App\Models\adminlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class adminmanage extends Controller
{
    public function adminmanage()
    {
        $staffs = adminlist::all();
      
        foreach ($staffs as $staff) {
            $Names[] = $staff->full_name;
        }
   
        return view('Administrator.AdminManage', compact('staffs'));
    }
}
