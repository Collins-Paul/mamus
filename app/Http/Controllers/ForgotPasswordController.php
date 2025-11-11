<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\ResetPasswordSuccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\AppLogo;
use Illuminate\Support\Facades\Redirect;

class ForgotPasswordController extends Controller
{

    //show reset new password form
    public function create($id) {
        $user = User::find(decrypt($id));
        if($user) {
            $fullname = $user->first_name." ".$user->last_name;
            $token = $user->two_factor_recovery_codes;
            $id = decrypt($id);
            return view('auth.auth-password', compact('fullname', 'token', 'id'));
        } else {
            return url('/');
        }
    }

    //update the new password
    public function update(Request $request) {
        $data = $request->validate([
            'password'  => 'required|min:6',
            'cpassword' => 'required|same:password',
            'id' =>  'required|string',
            'token' => 'required|string'
        ]);

       $password = Hash::make($data['password']);

       $update = DB::table('users')
                    ->where('id', $data['id'])
                    ->where('two_factor_recovery_codes', $data['token'])
                    ->update([
                        'password' => $password,
                        'two_factor_recovery_codes' => null
                    ]);

        if($update) {
            $user = User::find($data['id']);
            $logo = AppLogo::find(1)->logo;
            $MailData = [
                'fullname' =>  $user->first_name." ".$user->last_name,
                'logo' => $logo
            ];
            Mail::to($user->email)->send(new ResetPasswordSuccess($MailData));
            return redirect()->route('auth.login')->with('success', 'New Password Updated!');
        } else {
            return redirect()->route('auth.login')->with('error', 'Password Reset Failed!');
        }
    }

    //process and send the new password link to user
    public function forgotPassword(Request $request) {
        $data = $request->validate([
            'email' => 'required|email'
        ]);

        $token = new AppLogicController();
        $code = $token->randString(50);

        $user = User::where('email', $data['email'])
                    ->first();
        if($user){
            $token = config('app.url')."/recover-password/".$code."/id/".encrypt($user->id);
            User::where('id', $user->id)->update([
                'two_factor_recovery_codes' => $code
            ]);
            $app = new AppLogicController();
            $logo = AppLogo::find(1)->logo;
            $MailData = [
                'fullname' =>  $user->first_name." ".$user->last_name,
                'token' => $token,
                'logo' => $logo
            ];
            Mail::to($user->email)->send(new ForgotPassword($MailData));
            return back()->with('success', 'Kindly check your email '.$app->mask_email($user->email).' and click the link sent.');
        } else {
            return back()->with('error', 'Invalid email address');
        }
    }

    //process the recovery link
    public function link($token, $id) {
        $id = decrypt($id);
        $check = User::where('id', $id)
                        ->where('two_factor_recovery_codes', $token)
                        ->first();
        // dd($id);
        if($check) {
            return $this->create(encrypt($id));
        } else {
            return Redirect()->route('auth.login')
                    ->with('error', 'Invalid Password Reset Link');
        }
    }

}
