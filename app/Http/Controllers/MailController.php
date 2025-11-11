<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\AppLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function verifyNow($token) {
        $id = decrypt($token);
        $check = DB::table('users')
                        ->where('id', $id)
                        ->update([
                            'status' => 3,
                            'email_verified_at' => Date('Y-m-d H:i:s')
                        ]);
        if($check){
            $user = User::find($id);
            $logo = AppLogo::find(1)->logo;

            $MailData = [
                'fullname' => $user->first_name." ".$user->last_name,
                'logo' => $logo
            ];

            Mail::to($user->email)->send(new WelcomeMail($MailData));

            return Redirect()->route('auth.login')->with('success', 'Email Verification Successful');

        } else {
            return Redirect()->route('auth.login')->with('error', 'Invalid Verification Token');
        }
    }

}
