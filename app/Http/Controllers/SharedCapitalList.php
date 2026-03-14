<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sharedCapital;

class SharedCapitalList extends Controller
{
    public function ViewSharedCapitalList(){
        // Update all records that don't have a status or have 'Active' status to 'ongoing'
        sharedCapital::where(function($query) {
            $query->whereNull('status')
                  ->orWhere('status', 'Active');
        })->update(['status' => 'ongoing']);

        $AllSharedCapital = sharedCapital::all();

        return view('Administrator.SharedCapitalList', compact('AllSharedCapital'));
    }

    public function viewSharedCapitalDetails($member_id){
        $sharedCapital = sharedCapital::where('member_id', $member_id)->first();

        return view('Administrator.ViewSharedCapitalDetails', compact('sharedCapital'));
    }

    public function markFullyPaid($member_id){
        $sharedCapital = sharedCapital::where('member_id', $member_id)->first();
        
        if($sharedCapital){
            $sharedCapital->status = 'fully paid';
            $sharedCapital->save();
            
            return redirect()->route('Shared.Capital.List.View')->with('success', 'Shared capital marked as fully paid successfully.');
        }
        
        return redirect()->route('Shared.Capital.List.View')->with('error', 'Shared capital record not found.');
    }
}
