<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\WithdrawalCard;
use Illuminate\Support\Facades\DB;


class WithdrawalCardController extends Controller
{
    //generate card number
    public function cardPIN($length) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $pin = '';
        for ($i = 0; $i < $length; $i++) {
            $pin .= $characters[rand(0, $charactersLength - 1)];
        }
        return $pin;
    }

    //create new card
    public function create($user_id, $card_id) {
        $new = new WithdrawalCard();
        $new->user_id = $user_id;
        $new->card_id = $card_id;
        $new->card_no = $this->cardPIN(12);
        $new->cvv = $this->cardPIN(3);
        $new->exp_date = date('m/Y', strtotime('+2 years'));
        return $new->save();
    }

    //show card details
    public function show($user_id) {
        $details = WithdrawalCard::where('user_id', $user_id)->first();
        return $details;
    }

    //activate card
    public function activateCard(Request $request){
        $card = $request->all();
        $getCard = $this->show($card['card_owner']);
        $status = $getCard->status == 1 ? 0 : 1;
        $change = DB::table('withdrawal_cards')
                        ->where('user_id', $card['card_owner'])
                        ->update([
                            'status' => $status
                        ]);
            if($change){
                return response()->json([
                    'message' => 'Done!',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Failed!',
                ], 401);
            }
    }

    //toggle withdrawal (Enable/Disable)
    public function withdrawalSetting(Request $request) {
        $action = $request->all();
        $getUser = User::find($action['withdrawal_id']);
        $status = !$getUser->can_withdraw;
        $change = DB::table('users')
                        ->where('id', $action['withdrawal_id'])
                        ->update([
                            'can_withdraw' => $status
                        ]);
            if($change){
                return response()->json([
                    'message' => 'Done!',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Failed!',
                ], 401);
            }
    }

    //show all cards
    public function showCards() {
        $cards = WithdrawalCard::orderBy('id', 'desc')->get();
        $app = new AppLogicController();
        return view('admin.cards.index', compact('cards', 'app'));
    }

    public function toggleCardStatus($id) {

        $id = decrypt($id);
        $cards = WithdrawalCard::find($id);

        if(!is_null($cards)) {
            $status = $cards->status;
            WithdrawalCard::where('id', $id)->update([
                'status' => !$status
            ]);
        }

        return back()->with('success', 'Done!');

    }

    public function deleteCard($id) {
        $id = decrypt($id);
        $cards = WithdrawalCard::find($id);

        if(!is_null($cards)) {
            WithdrawalCard::where('id', $id)->delete();
        }

        return back()->with('success', 'Deleted!');

    }
}
