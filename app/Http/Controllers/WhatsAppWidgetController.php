<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhatsAppContact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class WhatsAppWidgetController extends Controller
{
    //create form
    public function create() {
        $info = WhatsAppContact::find(1);
        return view('admin.whatsapp-update', compact('info'));
    }

    //update whatsapp number
    public function update(Request $request) {
        $request->validate([
            'phone' => 'required|numeric'
        ]);

        $update = DB::table('whatsappwidget')
                    ->where('id', 1)
                    ->update([
                        'number' => $request->phone
                    ]);

        if($update){
            return back()->with('success', 'WhatsApp number updated!');
        } else {
            return back()->with('error', 'Failed, try again.');
        }
    }

    //change the whatsapp widget status to on/off
    public function toggelWhatsApp() {
        $check = DB::table('whatsappwidget')
                    ->where('id', 1)
                    ->first();

        $status = !$check->status;

        $update = DB::table('whatsappwidget')
                    ->where('id', 1)
                    ->update([
                        'status' => $status
                    ]);

        if($update){
            return Response::json([
                'message' => 'Done!'
            ], 200);
        }
    }
}
