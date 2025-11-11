<?php

namespace App\Http\Controllers;

// use Illuminate\Auth\Events\Login;

use App\Models\Balances;
use App\Models\Copier;
use App\Models\MasterTrader;
use App\Models\Order;
use App\Models\SubPlans;
use Illuminate\Http\Request;
use App\Models\TransHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Settings;
use App\Models\NetFeeHeight;
use App\Models\TranxMessage;
use App\Models\TranxWallets;
use Illuminate\Support\Facades\DB;
use App\Models\AppLogo;
use App\Models\Card\Cards;
class UserController extends AppLogicController
{
    //process all user's deposit
    public function submitDeposit(Request $request) {
        $request->validate([
            'amount' => 'required|numeric',
            'wallet_name' => 'required|string',
            'wallet_address' => 'required|string'
        ]);

        if($request->amount < $this->getMinDeposit()){
            return back()->with(
                'error', 'Min. deposit required is $'.$this->getMinDeposit()
            );
        }

        $saveDeposit = new TransHistory();

        $wallet = $this->showWallet($request->input('wallet_name'));

        $saveDeposit->method = $wallet->wallet_name." ". !is_null($wallet->wallet_format) ? " (".($wallet->wallet_format).")" : null;

        $method = $wallet->wallet_name." ".$saveDeposit->method;

        // dd($method);

        $saveDeposit->method = $method;

        $saveDeposit->user_id = Auth::user()->id;
        $saveDeposit->amount = $request->input('amount');
        $saveDeposit->type = 'deposit';
        $saveDeposit->wallet_address = $request->input('wallet_address');
        $saveDeposit->ref = $this->randString(30);

        $saveDeposit = $saveDeposit->save();

        if($saveDeposit){
            return back()->with(
                'success', 'Awaiting Confirmation'
            );
        } else {
            return back()->with(
                'error', 'Failed, Try again.'
            );
        }
    }

    public function accountOverview() {
        $uid = Auth::user()->id;
        $balances = $this->getBalances($uid);
        $referral = new ReferralsController();
        $referral = $referral->getBonus(Auth::user()->id);
        $data = Settings::where('id', 1)->first();
        return view('user.overview', compact('balances', 'referral', 'data'));
    }

    public function indexPage() {
        $uid = Auth::user()->id;
        $balances = $this->getBalances($uid);
        //the history if user or admin
        if (Auth::user()->who == 2) {
            $history = $this->transHistory();
        } else {
            $history = $this->transHistory($uid);
        }
        return view('user.index', compact('balances', 'history'));
    }

    // public function bitcoinDeposit(Request $request) {
    //     $url = $request->route()->getName();
    //     $wallet_a = $this->wallets(null, null, null, 'bitcoin', 'P2PKH');
    //     $wallet_b = $this->wallets(null, null, null, 'bitcoin', 'SegWit');
    //     $method = $this->depositRoute('user.bitcoin');
    //     $allWallets = $this->wallets();
    //     return view('user.bitcoinDeposit', compact('url', 'wallet_a', 'wallet_b', 'method', 'allWallets'));
    // }

    public function depositUrl(Request $request) {
        $url = $request->route()->getName();
        $wallet_a = $this->wallets(null, null, null, 'bitcoin', 'P2PKH');
        $wallet_b = $this->wallets(null, null, null, 'bitcoin', 'SegWit');
        $method = $this->depositRoute('user.bitcoin');
        $allWallets = $this->wallets();
        $data = Settings::where('id', 1)->first();
        return view('user.deposit', compact('url', 'wallet_a', 'wallet_b', 'method', 'allWallets', 'data'));
    }

    public function notifications() {
        return view('user.notification');
    }

    public function contact() {
        $liveChat = DB::table('live_chat_apps')->where('id', 1)->first();
        $contactsInfo = DB::table('contact_details')->where('id', 1)->first();
        return view('user.contact', compact('contactsInfo', 'liveChat'));
    }

    public function settings() {
        return view('user.settings');
    }

    public function masterRating() {
        $masters = $this->allTraders('master_traders')->where('status', 1);
        // dd($masters);
        return view('user.master', compact('masters'));
    }

    public function tradesTransactions() {
        $copiers = Copier::where('copier_id', Auth::user()->id)
                                    ->where('status', 'closed')
                                    ->orderByDesc('id')
                                    ->get();
        return view('user.transactions', compact('copiers'));
    }

    public function mastersPerformance(Request $request, String $id) {
        $uid = Auth::user()->id;
        $balances = $this->getBalances($uid);
        $user = $balances;
        //get the details of the master trader
        $masterInfo = $this->viewDetails('master_traders', 'id', decrypt($id));
        //get the orders of the master trader
        $orders = $this->allTraders('orders',  'who', decrypt($id));
        //get the master's equity balance
        $equity = $this->getEquity(decrypt($id), 'orders', 'who', 'master');
        $url = $request->segment(2);
        return view('user.mastersperformance', compact('balances', 'masterInfo', 'orders', 'equity', 'url' , 'user'));
    }

    public function policyAndTerms() {
        return view('user.terms');
    }

    public function viewTransactionDetails($id) {
        $show = $this->viewDetails('trans_history', 'id', decrypt($id));
        if(!is_null($show)) {
            return view('user.transaction-details', compact('show'));
        } else {
            return redirect()->route('user.index')->with('error', 'Invalid Transaction Reference');
        }
    }

    public function withdrawUrl() {
        $uid = Auth::user()->id;
        $balances = $this->getBalances($uid);
        $card = new WithdrawalCardController();
        $card = $card->show($uid);
        return view('user.withdraw', compact('balances', 'card'));
    }

    //logout user function
    public function LogoutAccount(Request $request) {

        Session::flush();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', 'You are logged out.');
    }

    //copy setup page
    public function copySetup($id){
        $order = Order::find(decrypt($id));
        $masterInfo = MasterTrader::find($order->who);
        $bal = Balances::where('user_id', Auth::user()->id)->first();
        $id = decrypt($id);
        return view('user.copy-setup', compact('masterInfo', 'bal', 'id'));
    }

     //upload photo
     public function uploadPhoto(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'master_id' => 'required',
        ]);
        //get and store the photo
        $fileUpload = $this->uploadImgFile($request->file('image'), 'traders-photo/');

        //find the user
        $user_photo = User::find($request->master_id);
        //update the photo
        $user_photo->photo = $fileUpload;

        if ($user_photo->save()) {
            return back()->with('success', 'Uploaded!');
        } else {
            return back()->with('error', 'Could not update profile picture.');
        }
    }

    //place robot order
    public function robotOrder(Request $request) {
        $request->validate([
            'robot_id' => 'required|string',
            'amount'   => 'required|numeric',
            'market' => 'required|string',
            'symbols' => 'required|string'
        ]);

        $check = SubPlans::where('robot_id', $request->robot_id)->first();

        if($check == null){
            return back()->with('error', 'Invalid Robot ID');
        }

        $check_balance = $this->getBalances(Auth::user()->id);
        if($check_balance->balance < $request->amount){
            return back()->with('error', 'Insufficient Balance');
        }

        $order = new Order();
        $order->robot_id = $request->robot_id;
        $order->amount = $request->amount;
        $order->market = $request->market;
        $order->currency_pair = $request->symbols;
        $order->order_id = $this->randString(10);
        $order->who = 0;
        $order->method = 'robot';
        $order->user = Auth::user()->id;

        //subtract balance
        $debitBalance = $this->subWithdrawal(Auth::user()->id, $request->amount);

        if($order->save() && $debitBalance == true){
            return redirect()->route('user.robot.history', ['type' => 'opened'])->with('success', 'New Order Placed!');
        } else {
            return back()->with('error', 'Order Failed!');
        }
    }

    //show robot page
    public function robotSetup() {
        $check = SubPlans::where('user_id', Auth::user()->id)->first();
        //check if the robot plan has expired
        if($check !== null && (strtotime(date('dS M, Y')) > strtotime($check->exp_date))){
            SubPlans::where('user_id', Auth::user()->id)
                            ->update([
                                'status' => 'expired'
                            ]);
        }

        $check = SubPlans::where('user_id', Auth::user()->id)
                        ->where('status', 'active')->first();

        if($check !== null) {
            return view('user.robot-trading');
        } else {
            $show_sub = new SubscriptionsController();
            return $show_sub->show();
        }

    }

    //robot history
    public function robotHistory($order) {
        $order = $order == 'opened' ? 'opened' : 'closed';
        $trades = Order::where('user', Auth::user()->id)
                        ->where('status', $order)
                        ->orderByDesc('id')
                        ->get();
        if($order == 'opened'){
            return view('user.robot-opened-trading-history', compact('trades'));
        } else {
            return view('user.robot-closed-trading-history', compact('trades'));
        }
    }

    //internal transfer view
    public function internalTransfer() {
        //get the profit
        $profit = $this->getBalances(Auth::user()->id);
        //get the referral bonus
        $referral = new ReferralsController();
        $bonus = $referral->getBonus(Auth::user()->id);
        //get the user balance
        $balance = $this->getBalances(Auth::user()->id);

        $profit = $profit->profit;
        $bonus = $bonus->bonus;
        $balance = $balance->balance;
        return view('user.internal-transfer', compact('profit', 'bonus', 'balance'));
    }

    //process copy trading
    public function copyTradingProcess(Request $request) {

        $prop_type = $request->input('prop_type');
        $commission = $request->input('commission');
        $total = $request->input('total');
        $order_id = $request->input('order_id');

        $total = str_replace('$', '', $total);

        //get the order info
        $order = Order::find($order_id);
        //get the master info
        $master = MasterTrader::find($order->who);

        //get the current user's balance data
        $bal = Balances::where('user_id', Auth::user()->id)->first();

        //check if the balance is enough to copy the master trade
        if($bal->balance < $total){
            return response()->json([
                        'message' => 'Insufficient Balance',
                        'status' => 401
                    ]);
        }

        //save the data of the copied trade
        $copytrade = new Copier();

        $copytrade->copier_id = Auth::user()->id;
        $copytrade->trade_id = $order->id;
        $copytrade->master_id = $order->who;
        $copytrade->master_name = $master->username;
        $copytrade->order_id = $this->randString(8);
        $copytrade->total_amount = $total;
        $copytrade->copy_proportion = $prop_type;
        $copytrade->order_type = $order->order_type;
        $copytrade->commission_copy_trade = $commission;
        $copytrade->currency_pair = $order->currency_pair;
        $copytrade->lot_size = $order->lot_size;
        $copytrade->profit_or_loss = '0.00';
        $copytrade->open_price = $order->open_price;
        $copytrade->status = 'opened';
        $copytrade->market = $order->market;

        $master_bal = new MasterTrader();
        $master_bal->balance = $master_bal->balance + (int)$commission;

        //subtract the total from the copiers balance
        $new_balance = (int)$bal->balance - (int)$total;

        //update the copiers balance
        $nBal = DB::table('balances')
                    ->where('user_id', Auth::user()->id)
                    ->update(['balance' => $new_balance]);

        // save the new balance and the copied trade
        if($copytrade->save() &&  $nBal){
            return response()->json([
                'message' => 'Copy Trade Placed!',
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Order Failed!',
                'status' => 401
            ]);
        }
    }

    //process internal transfer Referral Bonus/Profits
    public function internalTransferProcess(Request $request) {
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'amount' => 'required|numeric'
        ]);

        //get the profit
        $profit = $this->getBalances(Auth::user()->id);
        //get the referral bonus
        $referral = new ReferralsController();
        $bonus = $referral->getBonus(Auth::user()->id);
        $profit = $profit->profit;
        $bonus = $bonus->bonus;

        // check the from and validate
        if($request->from == 'referral'){
            if($request->amount > $bonus){
                return back()->with('error', 'Insufficient Bonus');
            }
            //debit the referral bonus
            $referral->debitReferral(Auth::user()->id, $request->amount);
            //credit the balance
            $this->addUpDeposit(Auth::user()->id, $request->amount);
            return redirect()->route('user.overview')->with('success', 'Referral Transfer Successful');
        }

        //check the from and validate
        if($request->from == 'profit'){
            if($request->amount > $profit){
                return back()->with('error', 'Insufficient Profit Balance');
            }
            //debit the profit balance
            $this->debitProfit(Auth::user()->id, $request->amount);
            //credit the balance
            $this->addUpDeposit(Auth::user()->id, $request->amount);
            return redirect()->route('user.overview')->with('success', 'Profit Transfer Successful');
        }
    }

    //disable copytrading
    public function disableCopy(Request $request) {
        $data = $request->all();
        $id = $data['copy_trader_id'];

        $user = DB::table('users')
                    ->where('id', $id)
                    ->first();
        if($user->copy_trade == 'yes'){
            $change = DB::table('users')
                        ->where('id', $id)
                        ->update([
                            'copy_trade' => 'no'
                        ]);
        } else {
            $change = DB::table('users')
                        ->where('id', $id)
                        ->update([
                            'copy_trade' => 'yes'
                        ]);
        }


        if($change){
            return response()->json([
                'message' => 'Done!',
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Failed!',
                'status' => 401
            ]);
        }
    }

    //get my equity
    public function myEquity() {
        //orders
        $orders = DB::table('orders')
                    ->where('user', Auth::user()->id)
                    ->where('status', 'opened')
                    ->sum('amount');

        //copy trades
        $copies = DB::table('copiers')
                    ->where('copier_id', Auth::user()->id)
                    ->where('status', 'opened')
                    ->sum('total_amount');

        $balance = $this->getBalances(Auth::user()->id)->balance;

        return (int)$balance + number_format($copies,2) + number_format($orders,2);
    }

    //get the user unrealized P/L
    public function currentPL() {
        //orders
        $orders = DB::table('orders')
                    ->where('user', Auth::user()->id)
                    ->where('status', 'opened')
                    ->sum('profit_or_loss');

        //copy trades
        $copies = DB::table('copiers')
                    ->where('copier_id', Auth::user()->id)
                    ->where('status', 'opened')
                    ->sum('profit_or_loss');

        return number_format($copies,2) + number_format($orders,2);

    }

    //display copy area
    public function copierAreaUrl(){
        $copiers = Copier::where('copier_id', Auth::user()->id)
                                    ->where('status', 'opened')
                                    ->orderByDesc('id')
                                    ->get();
        //my equity
        $equity = $this->myEquity();
        $unrealizedPL = $this->currentPL();
        $balance = $this->getBalances(Auth::user()->id);

        return view('user.copier-area', compact('copiers', 'equity', 'unrealizedPL', 'balance'));
    }


    //pricing plans table
    public function InvestmentPlans() {
        return view('user.pricing-table');
    }

    //active and recently ended investment
    public function MyInvestment() {
        return view('user.active-investment');
    }
    
    public function tranxDetails($id) {
        $id = decrypt($id);
        $details = TransHistory::find($id);

        $sending = TranxWallets::where('trans_history_id', $id)
                                    ->where('channel', 'FROM')->first();

        $recieving = TranxWallets::where('trans_history_id', $id)
                                    ->where('channel', 'TO')->first();

        $network = NetFeeHeight::where('trans_history_id', $id)->first();

        $message = TranxMessage::where('trans_history_id', $id)->first();

        return view('user.transaction-details', compact('details', 'sending', 'recieving', 'network', 'message'));
    }


    public function myHistory() {
        $uid = Auth::user()->id;
        $balances = $this->getBalances($uid);
        //the history if user
        $history = $this->transHistory($uid);
        return view('user.history', compact('balances', 'history'));
    }
    
       public function viewCards() {
        $uid = Auth::user()->id;
        $card = new WithdrawalCardController();
        $card = $card->show($uid);
        $logo = AppLogo::find(1);
        $cardDetails = Cards::where('id', $card->card_id)->first();
        return view('user.cards', compact('card', 'logo', 'cardDetails'));
    }

}
