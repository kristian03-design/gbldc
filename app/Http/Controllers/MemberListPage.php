<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\officialmember;

class MemberListPage extends Controller
{
    public function MemberList(){
        $AllMembers = officialmember::all();
        return view('Administrator.AdminMemberList', compact('AllMembers'));
    }
}
