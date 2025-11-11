<?php

namespace App\Http\Controllers;

use App\Models\AppLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppLogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $logo = DB::table('app_logos')->first();
        return view('admin.update-logo', compact('logo'));
    }

        //website logo upload
        public function uploadImg(Request $request){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if($image = $request->file('image')){
                $destinationPath = 'assets/logo/';
                $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $uploadImage);
                $logoUpload = "$uploadImage";
            }

            $createLogo = DB::table('app_logos')
                                ->update(['logo' => $logoUpload]);

            if ($createLogo) {
                return back()->with('success', 'Logo Updated successfully!');
            } else {
                return back()-with('error', 'Could not update logo.');
            }
    }

    //Website icon update
    public function iconImg(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($image = $request->file('image')){
            $destinationPath = 'assets/logo/';
            $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $uploadImage);
            $iconUpload = "$uploadImage";
        }

        $icon = $createLogo = DB::table('app_logos')
                                    ->update(['icon' => $iconUpload]);

        if ($icon) {
            return back()->with('success', 'Icon updated successfully!');
        } else {
            return back()-with('error', 'Could not update icon.');
        }
    }

}
