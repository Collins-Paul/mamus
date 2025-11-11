<?php

namespace App\Http\Controllers;

use App\Models\LiveChatApp;
use Illuminate\Http\Request;

class LiveChatAppController extends Controller
{
    //route to update app livechat form
    public function create() {
        $data = LiveChatApp::find(1);
        return view('admin.livechat-update', compact('data'));
    }

    //update script
    public function updateScript(Request $request) {
        $request->validate([
            'script' => 'required|string'
        ]);

        $update = LiveChatApp::where('id', 1)->update([
            'script' => $request->script
        ]);

        if($update){
            return back()->with('success', 'Livechat Script updated!');
        } else {
            return back()->with('error', 'Failed! Try again.');
        }
    }

    //update url
    public function updateUrl(Request $request) {
        $request->validate([
            'url' => 'required|string'
        ]);

        $update = LiveChatApp::where('id', 1)->update([
            'url' => $request->url
        ]);

        if($update){
            return back()->with('success', 'Livechat link updated!');
        } else {
            return back()->with('error', 'Failed! Try again.');
        }
    }

}
