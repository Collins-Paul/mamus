<?php

namespace App\Http\Controllers\Tranx;

use App\Models\AppLogo;
use App\Models\Balances;
use App\Models\NetworkFee;
use App\Models\UserWallets;
use App\Models\NetFeeHeight;
use App\Models\TranxWallets;
use Illuminate\Http\Request;
use App\Models\CreateWallets;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppLogicController;
use App\Http\Controllers\WithdrawalCardController;

class NewWithdrawalController extends Controller
{
    public function create()
    {
        //
        $bal = Balances::where('user_id', Auth::user()->id)->first()->balance;
        $wallets = UserWallets::where('user_id', Auth::user()->id)->get();
        $netfees = NetworkFee::get();
        $first_fee = $netfees->first();
        $card = new WithdrawalCardController();
        $card = $card->show(Auth::user()->id);
        $logo = AppLogo::find(1);
        return view('user.withdrawal.index', compact('bal', 'wallets', 'netfees', 'first_fee', 'card', 'logo'));
    }

    public function store(Request $request) {
        //
        $data = $request->all();
        $app =  new AppLogicController();
        $card = new WithdrawalCardController();
        $card = $card->show(Auth::user()->id);

        //check if the card number is correct
        if($card->card_no !== $data['card_number']){
           return back()->with('error', 'Unknown Card No. (Enter a valid card number.)');
        }

        //check if the pin matches the password
        if(Hash::check($data['pin'], Auth::user()->password)){

            $amount = str_replace(',', '', $data['amount']);
            $payingwallet = UserWallets::find($data['address']);
            $tranx_id = $app->createHistory($amount, 'Withdrawal');

            $fee = new NetFeeHeight();
            $fee->trans_history_id = $tranx_id;
            $fee->network_fee = $data['fee'];
            $fee->height = '000000';
            $fee->save();

            $wallet = new TranxWallets();
            $wallet->trans_history_id = $tranx_id;
            $wallet->wallet = $payingwallet->address;
            $wallet->channel = $payingwallet->coin;
            $wallet->save();

            return redirect()->route('user.tranx.details', ['id' => encrypt($tranx_id)])->with('success', 'Withdrawal Sent');
        }
    }
}
