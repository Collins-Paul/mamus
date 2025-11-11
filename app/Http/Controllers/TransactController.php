<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\AlertMail;
use App\Models\AppLogo;
use App\Models\TransHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class TransactController extends Controller
{
    //
    public function create($id) {
        $user_id = decrypt($id);
        $app = new AppLogicController();
        $bal = $app->getBalances($user_id);
        return view('admin.transact', compact('user_id', 'bal'));
    }


    public function store(Request $request) {
        $request->validate([
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'account' => 'required|string',
            'user_id' => 'required',
            'status' => 'required|string'
        ]);

        $app = new AppLogicController();

        $id = $request->user_id;
        $amount = $request->amount;

        if($request->status !== 'pending' && $request->status !== 'cancelled') {
            if($request->type == 'Deposit'){
                if($request->account == 'balance') {
                    $app->addUpDeposit($id, $amount);
                } else if ($request->account == 'profit') {
                    $app->addUpProfit($id, $amount);
                } else {
                    $app->processBonus($id, $amount, 'add');
                }
            }

            if($request->type == 'Withdrawal'){
                if($request->account == 'balance') {
                    $app->subWithdrawal($id, $amount);
                } else if ($request->account == 'profit') {
                    $app->debitProfit($id, $amount);
                } else {
                    $app->processBonus($id, $amount, 'minus');
                }
            }
        }

        $ref = $app->randString(30);

        $history = new TransHistory();
        $history->user_id = $id;
        $history->amount = $amount;
        $history->type = $request->type;
        $history->status = $request->status;
        $history->ref = $ref;

        // $user = User::find($id);
        // $fullname = $user->first_name." ".$user->last_name;

        // $app = new AppLogicController();

        // $logo = AppLogo::find(1)->logo;

        // $bal = $app->getBalances($id);

        //$MailData = [
            //'type' => $request->type,
            //'fullname' => $fullname,
            //'amount' => $amount,
            //'balance' => $bal->balance,
            //'profit' => $bal->profit,
            //'bonus' => $bal->capital,
            //'ref' => $ref,
            //'created_at' => date('Y-m-d H:i:s'),
            //'logo' => $logo
        //];

        //send mail
        //Mail::to($user->email)->send(new AlertMail($MailData));

        if($history->save()){
            return back()->with('success', Str::ucfirst($request->type).' Successful');
        }
    }
}
