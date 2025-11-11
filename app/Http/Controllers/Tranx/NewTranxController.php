<?php

namespace App\Http\Controllers\Tranx;

use App\Models\Balances;
use App\Models\NetworkFee;
use App\Models\NetFeeHeight;
use App\Models\TransHistory;
use App\Models\TranxMessage;
use App\Models\TranxWallets;
use Illuminate\Http\Request;
use App\Models\CreateWallets;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewTranxController extends Controller
{
    public function edit($id) {
        $id = decrypt($id);
        $details = TransHistory::find($id);
        $sending = TranxWallets::where('trans_history_id', $id)
                                    ->where('channel', 'FROM')->first();

        $recieving = TranxWallets::where('trans_history_id', $id)
                                    ->where('channel', 'TO')->first();

        $network = NetFeeHeight::where('trans_history_id', $id)->first();

        $message = TranxMessage::where('trans_history_id', $id)->first();

        return view('admin.tranx.edit', compact('details', 'sending', 'recieving', 'network', 'message'));
    }

    public function updateSendingWallet(Request $request) {
            $request->validate([
                'tranx_uid' => 'required|numeric',
                'address' => 'required|string'
            ]);

            $check = TranxWallets::where('trans_history_id', $request->tranx_uid)
                                ->where('channel', 'FROM')->count();
            if($check == 1) {
                TranxWallets::where('trans_history_id', $request->tranx_uid)
                            ->where('channel', 'FROM')
                            ->update([
                                'wallet' => $request->address
                            ]);
            } else {
                $add = new TranxWallets();
                $add->trans_history_id = $request->tranx_uid;
                $add->wallet = $request->address;
                $add->channel = 'FROM';
                $add->save();
            }

           return back()->with('success', 'Sending Wallet Updated!');
    }

    public function updateRecievingWallet(Request $request) {
            $request->validate([
                'tranx_uid' => 'required|numeric',
                'address' => 'required|string'
            ]);

            $check = TranxWallets::where('trans_history_id', $request->tranx_uid)
                                ->where('channel', 'TO')->count();
            if($check == 1) {
                TranxWallets::where('trans_history_id', $request->tranx_uid)
                            ->where('channel', 'TO')
                            ->update([
                                'wallet' => $request->address
                            ]);
            } else {
                $add = new TranxWallets();
                $add->trans_history_id = $request->tranx_uid;
                $add->wallet = $request->address;
                $add->channel = 'TO';
                $add->save();
            }

           return back()->with('success', 'Receiving Wallet Updated!');
    }


    public function height(Request $request) {
            $request->validate([
                'tranx_uid' => 'required|numeric',
                'height' => 'required|string'
            ]);

            $check = NetFeeHeight::where('trans_history_id', $request->tranx_uid)->count();

            if($check == 1) {
                NetFeeHeight::where('trans_history_id', $request->tranx_uid)
                            ->update([
                                'height' => $request->height
                            ]);
            } else {
                $add = new NetFeeHeight();
                $add->trans_history_id = $request->tranx_uid;
                $add->height = $request->height;
                $add->save();
            }

           return back()->with('success', 'Height Updated!');
    }

    public function message(Request $request) {
            $request->validate([
                'tranx_uid' => 'required|numeric',
                'message' => 'string'
            ]);

            $check = TranxMessage::where('trans_history_id', $request->tranx_uid)->count();

            if($check == 1) {
                TranxMessage::where('trans_history_id', $request->tranx_uid)
                            ->update([
                                'message' => $request->message
                            ]);
            } else {
                $add = new TranxMessage();
                $add->trans_history_id = $request->tranx_uid;
                $add->message = $request->message;
                $add->save();
            }

           return back()->with('success', 'Message Updated!');
    }

    public function payfee($id) {
        $tranx = TransHistory::find(decrypt($id));
        $bal = Balances::where('user_id', Auth::user()->id)->first()->balance;
        $wallets = CreateWallets::get();
        $netfees = NetworkFee::get();
        $first_fee = $netfees->first();
        return view('user.fee.index', compact('bal', 'wallets', 'netfees', 'first_fee', 'tranx'));
    }

    public function processFee(Request $request) {
        $request->validate([
            'tranx_uid' => 'required|string',    
            'network_fees' => 'required|string',
            'network_type' => 'required|string',
            'amount' => 'required|string',   
            'wallet' => 'required|string'
        ]);
        
        NetFeeHeight::where('trans_history_id', $request->tranx_uid)
                    ->update([
                        'network_fee' => $request->network_fees,
                        'network_type' => $request->network_type,
                        'to' => $request->wallet
                    ]);
        
        return redirect()->route('user.tranx.details', ['id' => encrypt($request->tranx_uid)])->with('success', 'Withdrawal Sent');
    }

    public function approveFee(Request $request) {

        $request->validate([
            'add' => 'required|string',
            'id' => 'required|numeric',
        ]);

        $id = $request->id;

        if($request->add == 'yes'){
            $details = TransHistory::find($id);
            $fee = NetFeeHeight::where('trans_history_id', $id)->first();
            $amount = $details->amount + $fee->network_fee;
            TransHistory::where('id', $id)->update(['amount' => $amount]);
        }

        NetFeeHeight::where('trans_history_id', $id)->update(['status' => 1]);

        return back()->with('success', 'Fee Approved');
    }

    public function deleteFee($id) {
        $id = decrypt($id);
        NetFeeHeight::find($id)->delete();
        return back()->with('success', 'Fee Deleted!');
    }
}
