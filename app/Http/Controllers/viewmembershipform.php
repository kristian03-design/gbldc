<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\registrationModel;
use Illuminate\Support\Facades\Crypt;



class viewmembershipform extends Controller
{
    public function ViewMF(){
        $membershipData = session('encryptMember');
        $decryptMemberData = Crypt::decrypt($membershipData);
    
        return view('Administrator.ViewMembershipForm', compact('decryptMemberData'));
    }
}
