<?php

namespace App\Http\Controllers\Cards;

use App\Models\User;
use App\Models\AppLogo;
use App\Models\Card\Cards;
use Illuminate\Http\Request;
use App\Models\WithdrawalCard;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppLogicController;
use App\Http\Controllers\WithdrawalCardController;

class CardsController extends Controller
{
    //
    public function create() {
        $cards = Cards::get();
        $mycard = WithdrawalCard::where('user_id', Auth::user()->id)->first();
        $app = new AppLogicController();
        if(is_null($mycard) || $app->isDateExpired($mycard->exp_date)) {
            return view('user.cards.index', compact('cards'));
        } else {
            $uid = Auth::user()->id;
            $card = new WithdrawalCardController();
            $card = $card->show($uid);
            $logo = AppLogo::find(1);
            $cardDetails = Cards::where('id', $card->card_id)->first();
            return view('user.cards', compact('card', 'logo', 'cardDetails'));
        }
    }

    public function proceed(Request $request) {
        $card = Cards::find($request->card_id);
        $user = new UserController();
        $allWallets = $user->wallets();
        return view('user.cards.create', compact('card', 'allWallets'));
    }

    public function createCard(Request $request) {

        //
        $request->validate([
            'file' => 'required|mimes:pdf,png,jpeg,jpg|max:10240'
        ]);

        $card = new WithdrawalCardController();

        $card->create(Auth::user()->id, $request->card_id);

        //upload payment receipt
        $app = new AppLogicController();
        $fileUpload = $app->uploadImgFile($request->file('file'), 'receipts/');

        WithdrawalCard::where('user_id', Auth::user()->id)
                        ->update([
                            'type' => $request->card_type,
                            'network' => $request->card_network,
                            'payment_receipt' => $fileUpload
                        ]);

        return Redirect()->route('user.my.cards')
                        ->with('success', 'New Card Created!');

    }

    public function showAdminUserCard($id) {
        $uid = decrypt($id);
        $card = new WithdrawalCardController();
        $card = $card->show($uid);
        $logo = AppLogo::find(1);
        $cardDetails = Cards::where('id', $card->card_id)->first();
        $user = User::find($card->user_id);
        return view('admin.cards.card', compact('card', 'logo', 'cardDetails', 'user'));
    }
}
