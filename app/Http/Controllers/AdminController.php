<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Copier;
use App\Mail\AlertMail;
use App\Models\AppLogo;
use App\Models\Settings;
use App\Models\Followers;
use App\Models\MasterTrader;
use App\Models\TransHistory;
use Illuminate\Http\Request;
use App\Models\CreateWallets;
use App\Models\Subscriptions;
use Illuminate\Support\Carbon;
use App\Mail\ActivateAccountMail;
use Illuminate\Support\Facades\DB;
use App\Mail\DeactivateAccountMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\MasterTradesNotificationMail;
use App\Models\WithdrawalCard;


class AdminController extends AppLogicController
{
    public function index() {
        $traders = $this->allTraders('users');
        $transac = $this->transHistory();
        //completed
        $depositCompleted = $transac->where('type','deposit')
                        ->where('status', 'completed');
        //pending
        $depositPending = $transac->where('type','deposit')
                        ->where('status', 'pending');

        $masters = $this->masters()->count();

        $active_cards = WithdrawalCard::where('status', 1)->count();
        $inactive_cards = WithdrawalCard::where('status', 0)->count();

        return view('admin.index', compact('traders', 'depositPending', 'depositCompleted', 'masters', 'active_cards', 'inactive_cards'));
    }

    public function copyTraders() {
        $traders = $this->allTraders('users');
        return view('admin.copytraders', compact('traders'));
    }

    public function settings() {
        $data = Settings::where('id', 1)->first();
        return view('admin.settings', compact('data'));
    }

    public function wallet() {
        $wallets = $this->wallets();
        return view('admin.wallets', compact('wallets'));
    }

    public function allHistory() {
        $history = $this->transHistory();
        return view('admin.transaction-history', compact('history'));
    }

    //process add wallets
    public function createWallets(Request $request) {
            $request->validate([
                'wallet_name' => 'required|string',
                'wallet_address' => 'required|string|min:18',
                'wallet_format' => 'nullable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $addWallet = new CreateWallets();

            if($image = $request->file('image')){
                $destinationPath = 'wallets-qrcode/';
                $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $uploadImage);
                $addWallet->qr_code = "$uploadImage";
            }

            $addWallet->wallet_name = $request->input('wallet_name');
            $addWallet->wallet_address = $request->input('wallet_address');
            $addWallet->wallet_format = $request->input('wallet_format');

            $addWallet = $addWallet->save();

            if($addWallet){
                return back()->with('success', 'New Wallet Created');
            } else {
                return back()->with('error', 'Process Failed!');
            }
    }

    //show new master page
    public function newMaster() {
        return view('admin.new-masters');
    }

    //show master traders
    public function masterTraders() {
        $masters = $this->masters();
        $followers = new FollowersController();
        return view('admin.master-traders', compact('masters', 'followers'));
    }

    //show master's account info
    public function masterAccount(Request $request, $id) {
        $details = MasterTrader::find(decrypt($id));
        $orders = Order::where('who', decrypt($id))
                        ->where('status', 'opened')
                        ->orderByDesc('id')
                        ->get();
        $closed = Order::where('who', decrypt($id))
                        ->where('status', 'closed')
                        ->orderByDesc('id')
                        ->get();

        $copiers = Copier::where('master_id', decrypt($id))
                        ->where('status', 'opened')
                        ->orderByDesc('id')
                        ->get();

        $equity = $this->getEquity(decrypt($id), 'orders', 'who', 'master');
        // dd($orders);
        $url = $request->segment(2);

        $data = Followers::where('master_id', decrypt($id))->get();

        //master's live profits
        $profit = $this->mastersAllProfit(decrypt($id));

        //master's gain
        $gain = $this->mastersAllGain(decrypt($id));

        //master's losses
        $losses = $this->mastersAllLosses(decrypt($id));

        // dd($losses);

        return view('admin.master-account', compact('details', 'orders', 'closed', 'copiers', 'equity', 'url', 'data', 'profit', 'gain', 'losses'));
    }

    //upload photo
    public function uploadPhoto(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'master_id' => 'required',
        ]);
        //get and store the photo
        $fileUpload = $this->uploadImgFile($request->file('image'), 'traders-photo/');

        //find the master
        $master_photo = MasterTrader::find($request->master_id);
        //update the photo
        $master_photo->photo = $fileUpload;

        if ($master_photo->save()) {
            return back()->with('success', 'Uploaded!');
        } else {
            return back()->with('error', 'Could not update profile picture.');
        }
    }

    //active account
    public function activateStatus($id, $who){
        $user = $who == 'master' ? MasterTrader::find(decrypt($id)) : User::find(decrypt($id));
        // dd(decrypt($id));
        $user->status = 1;
        if ($user->save()) {

            if ($who !== 'master') {
                $logo = AppLogo::find(1)->logo;
                $MailData = [
                    'fullname' =>  $user->first_name." ".$user->last_name,
                    'logo' => $logo
                ];
                Mail::to($user->email)->send(new ActivateAccountMail($MailData));
            }

            return back()->with('success', 'Activated!');
        } else {
            return back()->with('error', 'Failed!');
        }
    }

    //deactive account
    public function deactivateStatus($id, $who){
        $user = $who == 'master' ? MasterTrader::find(decrypt($id)): User::find(decrypt($id));
        $user->status = 2;
        if ($user->save()) {

            if ($who !== 'master') {
                $logo = AppLogo::find(1)->logo;
                $MailData = [
                    'fullname' =>  $user->first_name." ".$user->last_name,
                    'logo' => $logo
                ];
                Mail::to($user->email)->send(new DeactivateAccountMail($MailData));
            }

            return back()->with('success', 'Deactivated!');
        } else {
            return back()->with('error', 'Failed!');
        }
    }

    //edit master account
    public function editAccount(Request $request) {
        $request->validate([
            'id' => 'required',
            'master_balance' => 'required|numeric',
            'master_bonus' => 'required|numeric',
            'leverage' => 'required|string'
        ]);
        $master = MasterTrader::find($request->id);
        $master->balance = $request->master_balance;
        $master->bonus = $request->master_bonus;
        $master->leverage = $request->leverage;
        if($master->save()){
            return back()->with('success', 'Done!');
        } else {
            return back()->with('error', 'Failed!');
        }
    }

    //edit master minimum investment & commission
    public function editMinInvestment(Request $request){
        $request->validate([
            'id' => 'required',
            'minimum_investment' => 'required|numeric',
            'commission' => 'required|numeric'
        ]);
        $master = MasterTrader::find($request->id);
        $master->minimum_investment = $request->minimum_investment;
        $master->commission = $request->commission;
        if($master->save()){
            return back()->with('success', 'Done!');
        } else {
            return back()->with('error', 'Failed!');
        }
    }

    //edit master strategy description
    public function editStrategy(Request $request){
        $request->validate([
            'id' => 'required',
            'strategy_description' => 'required|string',
        ]);
        $master = MasterTrader::find($request->id);
        $master->description = $request->strategy_description;
        if($master->save()){
            return back()->with('success', 'Done!');
        } else {
            return back()->with('error', 'Failed!');
        }
    }

    //edit risk and expertise
    public function editRiskExperstise(Request $request) {
        $request->validate([
            'id' => 'required',
            'risk' => 'required|string',
            'expertise' => 'required|string'
        ]);
        $master = MasterTrader::find($request->id);
        $master->risk_score = $request->risk;
        $master->expertise = $request->expertise;
        if($master->save()){
            return back()->with('success', 'Done!');
        } else {
            return back()->with('error', 'Failed!');
        }
    }

    //edit risk management
    public function editRiskManagement(Request $request){
        $request->validate([
            'id' => 'required',
            'max_loss' => 'required|numeric',
            'max_drawdown' => 'required|numeric',
        ]);
        $master = MasterTrader::find($request->id);
        $master->max_unrealised_loss = $request->max_loss;
        $master->max_drawndown_duration = $request->max_drawdown;
        if($master->save()){
            return back()->with('success', 'Done!');
        } else {
            return back()->with('error', 'Failed!');
        }
    }

    //create new master account
    public function createNewMaster(Request $request){
        $request->validate([
            'fname' => 'required|string|min:3',
            'lname' => 'required|string|min:3',
        ]);
        $master = new MasterTrader();
        $master->fname = $request->fname;
        $master->lname = $request->lname;
        $master->username = $request->fname."_".$request->lname.rand(1,99);
        $master->master_id = 'master_'.rand(100000,1000000000);
        $master->save();
        return redirect('/admin/masters')->with('success', 'New master created!');
    }

    //delete master's account
    public function deleteMaster($id){
        $delete = DB::table('master_traders')->where('id', decrypt($id))->delete();
        if($delete){
            return back()->with('success', 'Deleted!');
        } else {
            return back()->with('error', 'Failed!');
        }
    }

    //delete user's account
    public function deleteUser($id){
        $delete = DB::table('users')->where('id', decrypt($id))->delete();
        if($delete){
            return back()->with('success', 'Deleted!');
        } else {
            return back()->with('error', 'Failed!');
        }
    }

    //delete wallet
    public function deleteWallet($id){
        $delete = DB::table('wallets')->where('id', decrypt($id))->delete();
        if($delete){
            return back()->with('success', 'Deleted!');
        } else {
            return back()->with('error', 'Failed!');
        }
    }

    //truncate
    public function truncateTable($table) {
        DB::table($table)->truncate();
        return back()->with('success', 'Deleted!');
    }

    //approve transaction
    public function approveTransaction($id) {
        $id = decrypt($id);

        $type = TransHistory::find($id);

        if($type->type == 'Deposit') {
            $transaction = $this->addUpDeposit($type->user_id, $type->amount);
        } else {
            $transaction = $this->subWithdrawal($type->user_id, $type->amount);
        }

        $user = User::find($type->user_id);
        $fullname = $user->first_name." ".$user->last_name;

        $app = new AppLogicController();

        $logo = AppLogo::find(1)->logo;

        $bal = $app->getBalances($type->user_id);

        $MailData = [
            'type' => $type->type,
            'fullname' => $fullname,
            'amount' => $type->amount,
            'balance' => $bal->balance,
            'profit' => $bal->profit,
            'bonus' => $bal->capital,
            'ref' => $type->ref,
            'created_at' => date('Y-m-d H:i:s'),
            'logo' => $logo
        ];

        //send mail
        Mail::to($user->email)->send(new AlertMail($MailData));

        if($transaction == true) {
            $type->status = 'completed';
            $type->save();
            return Redirect()->route('admin.all-history')->with('success', 'Approved!');
        } else {
            return back()->with('failed', 'Error!');
        }
    }

    //delete transaction
    public function deleteTransaction($id) {
        $delete = DB::table('trans_history')->where('id', decrypt($id))->delete();
        if($delete){
            return Redirect()->route('admin.all-history')->with('success', 'Deleted!');
        } else {
            return Redirect()->route('admin.all-history')->with('error', 'Failed!');
        }
    }

    //create order page
    public function placeOrder($master_id, $master_bal) {
        $master_id = decrypt($master_id);
        $master_bal = decrypt($master_bal);
        return view('admin.place-order', compact('master_id', 'master_bal'));
    }

    //forex order UI
    public function forexOrder() {
        return view('admin.forex');
    }

    //crypto order UI
    public function cryptoOrder() {
        return view('admin.crypto');
    }

    //show all the subscription plan
    public function subPlans() {
        $data = Subscriptions::all();
        return view('admin.subscriptions', compact('data'));
    }

    //show create new plan page
    public function createSubPlans() {
        return view('admin.create-subscriptions');
    }

    //show all opened trades
    public function showOpenTrades(Request $request) {
        $orders = Order::where('status', 'opened')
                        ->orderByDesc('id')
                        ->get();
        $url = $request->segment(2);
        return view('admin.opened-trades', compact('orders', 'url'));
    }

    //show all closed trades
    public function showClosedTrades() {
        $closed = Order::where('status', 'closed')
        ->orderByDesc('id')
        ->get();
        return view('admin.closed-order', compact('closed'));
    }

   //create buy order
   public function buyOrder(Request $request) {

    $lot_size = $request->input('lot_size');
    $last_price = $request->input('last_price');
    $market = $request->input('market');
    $symbols = $request->input('symbols');
    $master_id = $request->input('master_id');
    $master_bal = $request->input('master_bal');

    $amount = ($lot_size / $last_price) * 100000;

    $ref = $this->randString(5);

    $order =  new Order();
    $order->lot_size = $lot_size;
    $order->open_price = $last_price;
    $order->market = $market;
    $order->currency_pair = $symbols;
    $order->order_type = 'buy';
    $order->order_id = $ref;
    $order->amount = $amount;
    $order->who = $master_id;
    $order->user = 0;

    $master = MasterTrader::find($master_id);

    $order->commission_paid = $master->commission;

    if($order->amount > $master_bal){
        return response()->json([
            'message' => 'Insufficient Balance',
            'status' => 401
        ]);
    } else {

        if($order->save()){

            //create copy trades for all those following the master trader
            $copiers = Copier::where('master_id', $master_id)->get();

            //check each copier and open trades for them
            foreach ($copiers as $copi) {

                //get the copier's copy proportion as specified by the copy trader
                $copy_p = Copier::where([
                                        ['copier_id', $copi->copier_id],
                                        ['master_id', $master_id]
                                    ])->first();

                //calculate trade margin using the copier proportion
                if($copy_p->copy_proportion == 'Tripple x3'){
                    $copy_margin = $amount * 3;
                } else if ($copy_p->copy_proportion == 'Double x2') {
                    $copy_margin = $amount * 2;
                } else {
                    $copy_margin = $amount;
                }

                //check the copier balance
                $copierBal = $this->getBalances($copi->copier_id);

                //check if the balance is higher than or equal to the copy trade margin
                if($copierBal->balance >= $copy_margin){

                     //check if the copier has enough funds to copy this trade?
                    if($copy_margin >= $master->minimum_investment){

                        //create copy trades for the copier
                        $order =  new Order();
                        $order->lot_size = $lot_size;
                        $order->open_price = $last_price;
                        $order->market = $market;
                        $order->currency_pair = $symbols;
                        $order->order_type = 'buy';
                        $order->order_id = $ref;
                        $order->amount = $copy_margin;
                        $order->who = 0;
                        $order->user = $copi->copier_id;
                        $order->commission_paid = $master->commission;

                        //if saved, debit the copiers balance
                        if($order->save()){

                            // debit the copier's account with the margin
                            $this->subWithdrawal($copi->copier_id, $copy_margin);

                            // get the email address of this trade copier
                            $copierEmail = User::find($copi->copier_id)->email;

                            $logo = AppLogo::find(1)->logo;

                            $currentDateTime = Carbon::now();
                            $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

                            $MailData = [
                                'master' => $master->fname." ".$master->lname,
                                'order' => 'buy',
                                'currency_pair' => $symbols,
                                'opening_price' => $last_price,
                                'created_at' => $formattedDateTime,
                                'ref' => $ref,
                                'status' => 'Open',
                                'logo' => $logo
                            ];

                            //send mail to notify the copier of this trade
                            Mail::to($copierEmail)->send(new MasterTradesNotificationMail($MailData));

                        }
                    }
                }
            }

            DB::table('master_traders')
                ->where('id', $master_id)
                ->update([
                    'balance' => (int)$master_bal - (int)$amount,
            ]);

            return response()->json([
                'message' => number_format($order->amount, 2),
                'status' => 200
            ]);

        } else {
            return response()->json([
                'message' => 'Order Failed!',
                'status' => 401
            ]);
        }
    }

}

//create sell order
public function sellOrder(Request $request) {

    $lot_size = $request->input('lot_size');
    $last_price = $request->input('last_price');
    $market = $request->input('market');
    $symbols = $request->input('symbols');
    $master_id = $request->input('master_id');
    $master_bal = $request->input('master_bal');

    $amount = ($lot_size / $last_price) * 100000;

    $ref = $this->randString(5);

    $order =  new Order();
    $order->lot_size = $lot_size;
    $order->open_price = $last_price;
    $order->market = $market;
    $order->currency_pair = $symbols;
    $order->order_type = 'sell';
    $order->order_id = $ref;
    $order->amount = $amount;
    $order->who = $master_id;
    $order->user = 0;

    $master = MasterTrader::find($master_id);

    $order->commission_paid = $master->commission;

    if($order->amount > $master_bal){
        return response()->json([
            'message' => 'Insufficient Balance',
            'status' => 401
        ]);
    } else {

        if($order->save()){

            //create copy trades for all those following the master trader
            $copiers = Copier::where('master_id', $master_id)->get();

            //check each copier and open trades for them
            foreach ($copiers as $copi) {

                //get the copier's copy proportion as specified by the copy trader
                $copy_p = Copier::where([
                                        ['copier_id', $copi->copier_id],
                                        ['master_id', $master_id]
                                    ])->first();

                //calculate trade margin using the copier proportion
                if($copy_p->copy_proportion == 'Tripple x3'){
                    $copy_margin = $amount * 3;
                } else if ($copy_p->copy_proportion == 'Double x2') {
                    $copy_margin = $amount * 2;
                } else {
                    $copy_margin = $amount;
                }

                //check the copier balance
                $copierBal = $this->getBalances($copi->copier_id);

                //check if the balance is higher than or equal to the copy trade margin
                if($copierBal->balance >= $copy_margin){

                     //check if the copier has enough funds to copy this trade?
                    if($copy_margin >= $master->minimum_investment){

                        //create copy trades for the copier
                        $order =  new Order();
                        $order->lot_size = $lot_size;
                        $order->open_price = $last_price;
                        $order->market = $market;
                        $order->currency_pair = $symbols;
                        $order->order_type = 'sell';
                        $order->order_id = $ref;
                        $order->amount = $copy_margin;
                        $order->who = 0;
                        $order->user = $copi->copier_id;
                        $order->commission_paid = $master->commission;

                        //if saved, debit the copiers balance
                        if($order->save()){

                            // debit the copier's account with the margin
                            $this->subWithdrawal($copi->copier_id, $copy_margin);

                            // get the email address of this trade copier
                            $copierEmail = User::find($copi->copier_id)->email;

                            $logo = AppLogo::find(1)->logo;

                            $currentDateTime = Carbon::now();
                            $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

                            $MailData = [
                                'master' => $master->fname." ".$master->lname,
                                'order' => 'sell',
                                'currency_pair' => $symbols,
                                'opening_price' => $last_price,
                                'created_at' => $formattedDateTime,
                                'ref' => $ref,
                                'status' => 'Open',
                                'logo' => $logo
                            ];

                            //send mail to notify the copier of this trade
                            Mail::to($copierEmail)->send(new MasterTradesNotificationMail($MailData));

                        }
                    }
                }
            }

            DB::table('master_traders')
                ->where('id', $master_id)
                ->update([
                    'balance' => (int)$master_bal - (int)$amount,
            ]);

            return response()->json([
                'message' => number_format($order->amount, 2),
                'status' => 200
            ]);

        } else {
            return response()->json([
                'message' => 'Order Failed!',
                'status' => 401
            ]);
        }
    }

}


    //show edit trade form
    public function editTradeView($order_id) {
        $order_id = decrypt($order_id);
        $order = Order::where('order_id', $order_id)->first();
        if($order){
            $pl = $order->profit_or_loss;
            $pair = $order->currency_pair;
            $type = $order->order_type;
            $order_ref = $order->order_id;
            $method = $order->method;
        } else {
            $order = Copier::where('order_id', $order_id)->first();
            $pl = $order->profit_or_loss;
            $pair = $order->currency_pair;
            $type = $order->order_type;
            $order_ref = $order->order_id;
            $method = $order->method;
        }

        if($order->market == 'crypto'){
            $vendor = 'BINANCE';
            $pair = $order->currency_pair;
        } elseif ($order->market == 'forex') {
            $vendor = 'FX';
            $pair = str_replace('/', '', $order->currency_pair);
        } else {
            $vendor ='NASDAQ';
            $pair = $order->currency_pair;
        }

        return view('admin.edit-trade', compact('order_id', 'pair', 'pl', 'type', 'order_ref', 'method', 'vendor', 'pair'));
    }

    //save opened edited trade to database
    public function saveEditTrade(Request $request) {
        $request->validate([
            'order_id' => 'required',
            'pl' => 'required|numeric',
            'order_type' => 'string',
            'entry_price' => 'string',
            'lot_size' => 'numeric'
        ]);

        if($request->order_type !== null && $request->order_type !== null && $request->lot_size !== null){
            $order = DB::table('orders')
                    ->where('order_id', $request->order_id)
                    ->update([
                        'profit_or_loss' => $request->pl,
                        'order_type' => $request->order_type,
                        'open_price' => $request->entry_price,
                        'lot_size' => $request->lot_size
                    ]);
        } else {
            $order = DB::table('orders')
                    ->where('order_id', $request->order_id)
                    ->update(['profit_or_loss' => $request->pl]);
        }

        if($order){
            return back()->with('success', 'Done!');
        } else {

            $order = DB::table('copiers')
            ->where('order_id', $request->order_id)
            ->update(['profit_or_loss' => $request->pl]);

            if ($order) {
                return back()->with('success', 'Done!');
            } else {
                return back()->with('error', 'Failed');
            }

        }
    }

    //robot history
    public function robotHistory($order, $id) {
        $order = $order == 'opened' ? 'opened' : 'closed';
        $trades = Order::where('user', decrypt($id))
                        ->where('status', $order)
                        ->orderByDesc('id')
                        ->get();
        if($order == 'opened'){
            return view('user.robot-opened-trading-history', compact('trades'));
        } else {
            return view('user.robot-closed-trading-history', compact('trades'));
        }
    }

    //route to admin compose mail page
    public function composeMail() {
        return view('admin.compose-mail');
    }

    //calculate master's gain
    public function mastersAllGain($id) {
        $gainOrder = Order::where('who', $id)
                        ->where('profit_or_loss', '>', 0)
                        ->sum('profit_or_loss');

        $gainCopier = Copier::where('master_id', $id)
                        ->where('profit_or_loss', '>', 0)
                        // ->where('status', 'closed')
                        ->sum('profit_or_loss');

        $gain = $gainOrder + $gainCopier;

        $bal = MasterTrader::find($id);

        if($bal->balance == 0){
            return $gain;
        } else {
            $gain = $gain / ($bal->balance * 100);
            return $gain;
        }

    }

    //calculate master's profit
    public function mastersAllProfit($id) {
        $profitOrder = Order::where('who', $id)
                        ->where('profit_or_loss', '>', 0)
                        ->sum('profit_or_loss');

        $profitCopier = Copier::where('master_id', $id)
                        ->where('profit_or_loss', '>', 0)
                        ->sum('profit_or_loss');

        $profit = $profitOrder + $profitCopier;

        return $profit;
    }


    //calculate master's losses
    public function mastersAllLosses($id) {
        $profitOrder = Order::where('who', $id)
                        ->where('profit_or_loss', '<', 0)
                        ->sum('profit_or_loss');

        $profitCopier = Copier::where('master_id', $id)
                        ->where('profit_or_loss', '<', 0)
                        ->sum('profit_or_loss');

        $profit = $profitOrder + $profitCopier;

        return $profit;
    }

}
