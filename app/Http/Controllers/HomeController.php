<?php

namespace App\Http\Controllers;

use App\Models\AppLogo;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index() {
        $liveChat = DB::table('live_chat_apps')->first();
        $footerContacts = DB::table('contact_details')->first();
        $referral = new ReferralsController;
        $referral = $referral->getReferralPrice();
        $logo = AppLogo::first();
        return view('home.index', compact('liveChat', 'footerContacts', 'referral', 'logo'));
    }

    public function privacyPolicy() {
        return view('home.policy-privacy');
    }

    public function termsCondition() {
        return view('home.terms');
    }
}
