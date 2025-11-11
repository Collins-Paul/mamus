<?php

namespace App\Http\Controllers;

use App\Models\TransHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;

class WithdrawalController extends Controller
{

    //crypto withdrawal
    public function cryptoMethod(Request $request) {

        $data = $request->all();

        $ref_no =  new AppLogicController();
        //$card = new WithdrawalCardController();
        //$card = $card->show($data['user_id']);

        //check if amount is correct
        if(!is_numeric($data['amount'])){
            return response()->json([
                'message' => 'Enter a valid amount in integer',
                'status' => 401
            ], 200);
        }


        //check if the card number is correct
        //if($card->card_no !== $data['card_number']){
            //return response()->json([
                //'message' => 'Unknown Card No. (Enter a valid card number.)',
                //'status' => 401
            //], 200);
        //}

            $amount = preg_replace('/[\s,]+/', '', $data['amount']);

            $trans = new TransHistory();
            $trans->user_id = $data['user_id'];
            $trans->amount = $amount;
            $trans->type = 'withdrawal';
            $trans->method = $data['coin'];
            $trans->wallet_address = $data['address'];
            $trans->ref = $ref_no->randString(10);

            if ($trans->save()) {
                return response()->json([
                    'message' => true,
                    'status' => 200
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Failed',
                    'status' => 401
                ], 200);
            }
    }

    //bank withdrawal
    public function bankMethod(Request $request) {
        $data = $request->all();
         //check if amount is correct
         if(!is_numeric($data['amount'])){
            return response()->json([
                'message' => 'Enter a valid amount in integer',
                'status' => 401
            ], 200);
        }

        if(!is_numeric($data['account_no'])){
            return response()->json([
                'message' => 'Invalid Account Number',
                'status' => 401
            ]);
        }

        $ref_no =  new AppLogicController();
        //$card = new WithdrawalCardController();
        //$card = $card->show($data['user_id']);

        //check if the card number is correct
        //if($card->card_no !== $data['card_number']){
            //return response()->json([
                //'message' => 'Unknown Card No. (Enter a valid card number.)',
                //'status' => 401
            //]);
        //}

        //check if the pin matches the password
        //if(Hash::check($data['pin'], Auth::user()->password)){

            $amount = preg_replace('/[\s,]+/', '', $data['amount']);

            $trans = new TransHistory();
            $trans->user_id = $data['user_id'];
            $trans->amount = $amount;
            $trans->type = 'withdrawal';
            $trans->method = 'Bank Withdrawal';
            $trans->account_number = $data['account_no'];
            $trans->bank_name = $data['bank_name'];
            $trans->swift_code = $data['swift_code'];
            $trans->ref = $ref_no->randString(15);

            if ($trans->save()) {
                return response()->json([
                    'message' => true,
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed',
                    'status' => 401
                ]);
            }
    }

    public function bonusWithdrawal(Request $request)
    {
        $data = $request->all();

        if(!is_numeric($data['amount'])){
            return response()->json([
                'message' => 'Invalid Amount',
                'status' => 401
            ]);
        }

        if(empty($data['address'])){
            return response()->json([
                'message' => 'Address Required',
                'status' => 401
            ]);
        }

        $ref_no =  new AppLogicController();

            $trans = new TransHistory();
            $trans->user_id = Auth::user()->id;
            $trans->amount = $data['amount'];
            $trans->type = 'Bonus withdrawal';
            $trans->method = $data['method'];
            $trans->wallet_address = $data['address'];
            $trans->ref = $ref_no->randString(15);

            if ($trans->save()) {
                return response()->json([
                    'message' => true,
                    'status' => 200
                ]);
            } else {
                return response()->json([
                    'message' => 'Failed',
                    'status' => 401
                ]);
            }
    }
}
