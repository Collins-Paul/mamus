<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
     //process minimum deposit
    public function minDeposit(Request $request){
        $request->validate([
            'amount' => 'required|numeric'
        ]);

        Settings::where('id', 1)->update([
            'min_deposit' => $request->amount
        ]);

        return back()->with('success', 'Updated Successfully!');
    }

     //process referral bonus amount
     public function referralBonus(Request $request){
        $request->validate([
            'amount' => 'required|numeric'
        ]);

        Settings::where('id', 1)->update([
            'referral_price' => $request->amount
        ]);
        return back()->with('success', 'Updated Successfully!');
    }
}
