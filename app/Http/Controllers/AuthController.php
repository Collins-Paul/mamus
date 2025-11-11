<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmEmailMail;
use App\Models\AppLogo;
use App\Models\User;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function AuthLogin()
    {
        return view('auth.auth-login');
    }

    public function AuthRegister()
    {
        $code = null;
        return view('auth.auth-register', compact('code'));
    }

    public function AuthReset()
    {
        return view('auth.auth-reset');
    }

    public function AuthSuccess()
    {
        return view('auth.auth-success');
    }

    // Registration input rules
    protected function rules()
    {
        return [
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'email' => 'required|email|unique:users',
            'dob' => 'required|before:today',
            'currency' => 'required',
            'phone' => 'required|string|min:11',
            'investment' => 'required',
            'country_of_residence' => 'required|string',
            'country_of_reg' => 'nullable',
            'company_name' => 'nullable',
            'reg_no' => 'nullable',
            'code' => 'nullable',
            'accept' => 'required|accepted',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
        ];
    }

    // Registration function with transaction
    public function CreateAccount(Request $request)
    {
        $credentials = $request->validate($this->rules());
        $credentials['password'] = Hash::make($credentials['password']);
        $credentials['dob'] = date("d-M-Y", strtotime($credentials['dob']));

        // Use a transaction to ensure all operations succeed or roll back
        try {
            DB::beginTransaction();

            // Check the account type: Individual or Corporate
            $credentials['account_type'] = !is_null($credentials['country_of_reg']) ? 'corporate' : 'individual'; // Fixed typo: 'corperate' to 'corporate'

            // Create the new user
            $user = User::create($credentials);

            // Create balance for the new user
            $balances = DB::table('balances')->insert([
                'user_id' => $user->id
            ]);

            // Create currency for the user
            $symbol = match ($request->currency) {
                'EUR' => '€',
                'GBP' => '£',
                default => '$',
            };
            $create = new Currency();
            $create->user_id = $user->id;
            $create->abbr = $request->currency;
            $create->symbol = $symbol;
            $create->save();

            // Create referral code
            $referral_code = new ReferralsController();
            $newReferral = $referral_code->createReferral($user->id);

            // Check if referral code was used and give bonus
            if (!is_null($credentials['code'])) {
                $who = $referral_code->refCode($credentials['code']);
                $referral_code->topUpReferrals($who->user_id);
            }

            // Give the user a one-week free robot plan
            $free = new SubscriptionsController();
            $free->freePlan($user->id);

            // Send verification mail
            $token = encrypt($user->id);
            $token = config('app.url') . "/email/verify/" . $token;
            $logo = AppLogo::find(1)->logo;

            $MailData = [
                'fullname' => $user->first_name . " " . $user->last_name,
                'token' => $token,
                'logo' => $logo
            ];

            Mail::to($user->email)->send(new ConfirmEmailMail($MailData));

            // If all operations succeed, commit the transaction
            DB::commit();

            return redirect()->route('auth.success');

        } catch (\Exception $e) {
            // If any operation fails, roll back all database changes
            DB::rollBack();

            // Log the error (optional, requires use Illuminate\Support\Facades\Log;)
            // \Log::error('Registration failed: ' . $e->getMessage());

            return back()->with('message', 'Registration failed: ' . $e->getMessage())->withInput();
        }
    }

    // Login function (unchanged)
    public function LoginAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $app = new AppLogicController();

            if (Auth::user()->who !== 2 && Auth::user()->status == 0) {
                return back()->with(
                    'error',
                    'Kindly check your email [' . $app->mask_email(Auth::user()->email) . '] inbox and click the link sent, to verify your account. Thank you.'
                );
            }

            if (Auth::user()->who !== 2 && Auth::user()->status == 2) {
                return back()->with(
                    'info',
                    'Notice! Please be informed that the account with the email [' . $app->mask_email(Auth::user()->email) . '] has been deactivated/suspended. For further enquiry send a mail to ' . config('app.email') . '. Thank you.'
                );
            }

            if (Auth::user()->who !== 2 && Auth::user()->status == 3) {
                return back()->with(
                    'info',
                    'The account with the email [' . $app->mask_email(Auth::user()->email) . '] is under review and awaits administrative approval. This usually takes within 24-72 hours. For complaints/enquiry send a mail to ' . config('app.email') . '. Thank you.'
                );
            }

            if (Auth::user()->who == 2) {
                return redirect()->intended('/admin/index')->with('success', "You're Logged In");
            } else {
                return redirect()->intended('/user/overview')->with('success', "You're Logged In");
            }
        }

        return back()->with('error', 'Invalid Email or Password');
    }
}