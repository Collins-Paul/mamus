<?php

namespace App\Http\Controllers\Tranx;

use App\Models\Balances;
use App\Models\NetworkFee;
use Illuminate\Http\Request;
use App\Models\CreateWallets;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppLogicController;
use App\Models\NetFeeHeight;
use App\Models\TranxWallets;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $bal = Balances::where('user_id', Auth::user()->id)->first()->balance;
        $wallets = CreateWallets::get();
        $netfees = NetworkFee::get();
        $first_fee = $netfees->first();
        
        return view('user.deposit.index', compact('bal', 'wallets', 'netfees', 'first_fee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'amount' => 'required|string',
            'wallet' => 'required|string',
            'network_fees' => 'required|string',
        ]);

        $amount = str_replace(',', '', $request->amount);
        // $payment = CreateWallets::find($request->wallet);

        //create tranx history
        $app =  new AppLogicController();
        $tranx_id = $app->createHistory($amount, 'Deposit');

        $fee = new NetFeeHeight();
        $fee->trans_history_id = $tranx_id;
        $fee->network_fee = $request->network_fees;
        $fee->height = '000000';
        $fee->save();

        $wallet = new TranxWallets();
        $wallet->trans_history_id = $tranx_id;
        $wallet->wallet = $request->wallet;
        $wallet->save();

        return redirect()->route('user.tranx.details', ['id' => encrypt($tranx_id)])->with('success', 'Deposit Sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
