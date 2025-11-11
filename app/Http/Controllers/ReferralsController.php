<?php

namespace App\Http\Controllers;

use App\Models\Referrals;
use App\Models\Settings;

class ReferralsController extends AppLogicController
{
    //create referral
    public function createReferral($user_id) {
        $new = new Referrals();
        $new->user_id = $user_id;
        $new->code = $this->randString(10);
        return $new->save();
    }

    //get the referral bonus
    public function getBonus($user_id) {
        $bonus = Referrals::where('user_id', $user_id)->first();
        return $bonus;
    }

    //get the referral code of a user
    public function getReferralCode($user_id) {
        $code = Referrals::where('user_id', $user_id)->first();
        return $code->code;
    }

    //subtract from referral bonus
    public function debitReferral($user_id, $amount) {
        $bonus = Referrals::where('user_id', $user_id)->first();
        $bal = $bonus->bonus - $amount;
        $referral = Referrals::where('user_id', $user_id)
                                ->update([
                                    'bonus' => $bal
                                ]);
        return $referral;
    }

    //process referral link
    public function referralLink($code) {
        return view('auth.auth-register', compact('code'));
    }

    //get referral by code
    public function refCode($code) {
        $details = Referrals::where('code', $code)->first();
        return $details;
    }

    //get referral price
    public function getReferralPrice() {
        $min = Settings::where('id', 1)->first();
        return $min->referral_price;
    }

    //increase referral bonus count and amount earned
    public function topUpReferrals($user_id){
        $referral = $this->getBonus($user_id);
        $ref = Referrals::where('user_id', $user_id)
                        ->update([
                            'count' => $referral->count + 1,
                            'bonus' => $referral->bonus + $this->getReferralPrice()
                        ]);
        return $ref;
    }

}
