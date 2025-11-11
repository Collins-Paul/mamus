<?php

namespace App\Http\Controllers;

use App\Models\ContactDetails;
use Illuminate\Http\Request;

class ContactDetailsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = ContactDetails::where('id', 1)->first();
        return view('admin.update-contacts', compact('data'));
    }

    //update phone
    public function updatePhone(Request $request) {
        $request->validate([
            'phone' => 'required|numeric'
        ]);

        $update = ContactDetails::where('id', 1)->update([
            'phone_1' => $request->phone
        ]);

        if($update){
            return back()->with('success', 'Phone updated!');
        } else {
            return back()->with('error', 'Failed! Try again.');
        }
    }

    //update url
    public function updateAddress(Request $request) {
        $request->validate([
            'address' => 'required|string'
        ]);

        $update = ContactDetails::where('id', 1)->update([
            'address' => $request->address
        ]);

        if($update){
            return back()->with('success', 'Address updated!');
        } else {
            return back()->with('error', 'Failed! Try again.');
        }
    }
}
