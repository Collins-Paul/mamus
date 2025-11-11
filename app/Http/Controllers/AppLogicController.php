<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Copier;
use App\Mail\OrderMail;
use App\Models\AppLogo;
use App\Models\Balances;
use App\Models\Settings;
use App\Models\MasterTrader;
use App\Models\TransHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AppLogicController extends Controller
{
        //get the current user's account balances
        public function getBalances($id) {
            $balances = DB::table('balances')->where('user_id',$id)->first();
            return $balances;
        }

        //get the transaction history of the current user
        public function transHistory($id = null) {
            if(is_null($id)){
                $transHistory = DB::table('trans_history')
                                ->orderBy('id', 'desc')
                                ->get();
            } else {
                $transHistory = DB::table('trans_history')
                                ->where('user_id', $id)
                                ->orderBy('id', 'desc')
                                ->get();
            }
            return $transHistory;
        }

        //get all the wallet addresses
        public function wallets(
            $id = null, $column = null, $value = null, $name = null, $format = null
            ) {

            // if no parameter
            if (is_null($column) && is_null($value) && is_null($name) && is_null($format)) {
                $wallets = DB::table('wallets')->get();
            }

            // if name and format are given
            if (!is_null($name) && !is_null($format)) {
                $wallets = DB::table('wallets')
                        ->where('wallet_name', $name)
                        ->where('wallet_format', $format)
                        ->get();
                foreach ($wallets as $wallet) {
                    $wallets = $wallet;
                }
            }

            //if column and value is are given
            if (!is_null($column) && !is_null($value)) {
                $wallets = DB::table('wallets')
                ->where($column, $value)
                ->get();
            }

            // if column is given
            if (!is_null($column)) {
                $wallets = DB::table('wallets')->pluck($column);
            }

            //if id is given
            if(!is_null($id)){
                $wallets = DB::table('wallets')->find($id);
            }

            return $wallets;
        }

        //get payement Route
        public function depositRoute($route) {
            switch ($route) {
                case 'user.bitcoin':
                    $method = 'bitcoin';
                    break;

                case 'user.dogecoin':
                    $method = 'dogecoin';
                    break;

                case 'user.litecoin':
                    $method = 'litecoin';
                    break;

                case 'user.tether':
                    $method = 'tether (ERC20)';
                    break;

                case 'user.usdt':
                    $method = 'tether (TRC20)';
                    break;

                default:
                    $method = null;
                    break;
            }
            return $method;
        }

         //show user the selected wallet address
        public function showWallet($uid){
            $address = $this->wallets($uid);
            return $address;
        }

        //generate random string
        public function randString($length) {

            // $string = Str::random($length);

            // $string = $string.date('Hisdmy');

            $characters = '0123456789abcdefjhijklmnopqrstuvwxyz';

            $charactersLength = strlen($characters);

            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            return $randomString;
        }

        //view details by id
        static function viewDetails($table, $column, $id) {
            $details = DB::table($table)->where($column, $id)->first();
            return $details;
        }

        //delete from table
        public function deleteAction($table, $id = null) {
            if(!is_null($id)){
                $delete = DB::delete('delete '.$table.' where id = ?', $id);
            } else {
                $delete = DB::delete("delete * '.$table.'");
            }

            if($delete) {
                return back()-with('success', 'Deleted Successfully');
            } else {
                return back()-with('error', 'Failed to delete');
            }
        }

        //get a list of  Master's / Copy Trader
        public function allTraders($table = null, $column = null, $value = null) {
            if(is_null($table) && is_null($column) && is_null($value)){
                $data = DB::table($table)->orderBy('id', 'desc')
                                        ->get();
            } else {
                $data = DB::table($table)->where($column, $value)
                                    ->orderBy('id', 'desc')
                                    ->get();
            }
            return $data;
        }

        //get a random collection of master traders and thier orders
        public function masters() {
            $masters = DB::table('master_traders')->orderByDesc('id')->get();
            return $masters;
        }

        //get the order count for (closed and opened) trades
        static function ordersCount($type, $master_id){
            $orderCount = DB::table('orders')
                            ->where('who', $master_id)
                            ->where('status', $type)
                            ->get();
            return $orderCount->count();
        }

        //count a row
        static function rowCounter($table, $column, $value) {
            $count = DB::table($table)->where($column, $value)->count();
            return $count;
        }

        //get the days ago
        static function daysAgo($past_date){
            $to = Carbon::createFromFormat('Y-m-d H:s:i', $past_date);
            $from = Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d H:s:i'));
            $diff_in_days = $to->diffInDays($from);
            return $diff_in_days;
        }

        //get the remaining days
        public function remainingDays($future){
            $timeleft = strtotime($future)-strtotime(date('dS M, Y'));
            $daysleft = abs(round($timeleft / 86400));
            return $daysleft;
        }

        // get two letters of a fullname
        static function getNameInitials($fullname) {
            $nameParts = explode(' ', trim($fullname));
            $firstname = array_shift($nameParts);
            $lastname = array_pop($nameParts);
            $initials = mb_substr($firstname, 0,1) . mb_substr($lastname, 0,1);
            return $initials;
        }

        //calculate floating P/L
        public function floatingProfitOrLoss($position_size, $current_price, $entry_price) {
            $floating_p_l = $position_size * ($current_price - $entry_price);
            return $floating_p_l;
        }

        //get the floating profit or loss
        // $table = orders or copiers
        //$id = user id or master id
        public function unrealilzedPL($id, $table, $who) {
            $uPL = DB::table($table)
                        ->where($who, $id)//$who = copier_id or who(master id) column
                        ->where('status', 'opened')
                        ->sum('profit_or_loss');
            return $uPL;
        }

        //get the equity of a master
        public function getEquity($id, $table, $who, $trader){
            $balance = $trader == 'master' ? MasterTrader::find($id) : User::find($id);
            $uPL = $this->unrealilzedPL($id, $table, $who);
            $equity = $balance->balance + $uPL;
            return $equity;
        }

        //upload image file to destination path e.g 'images/'
        public function uploadImgFile($file, $destinationPath){
            if($image = $file){
                $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $uploadImage);
                $fileUpload = "$uploadImage";
            }
            return $fileUpload;
        }

        //add up bonus
    public function processBonus($user_id, $amount, $type)
    {
            $balance = Balances::where('user_id', $user_id)->first();

            if ($type === 'add') {
                $new_bonus = $balance->capital + $amount;
            } else {
                $new_bonus = $balance->capital - $amount;
            }

            $bal = Balances::where('user_id', $user_id)->update([
                'capital' => $new_bonus
            ]);
            if($bal){
                return true;
            } else {
                return false;
            }
    }

        //add up deposit
        public function addUpDeposit($user_id, $amount) {
            $balance = Balances::where('user_id', $user_id)->first();
            $new_balance = $balance->balance + $amount;
            $bal = Balances::where('user_id', $user_id)->update([
                'balance' => $new_balance
            ]);
            if($bal){
                return true;
            } else {
                return false;
            }
        }
        
        //add to profit
        public function addUpProfit($user_id, $amount) {
            $balance = Balances::where('user_id', $user_id)->first();
            $new_profit = $balance->profit + $amount;
            $bal = Balances::where('user_id', $user_id)->update([
                'profit' => $new_profit
            ]);
            if($bal){
                return true;
            } else {
                return false;
            }
        }

         //minus withdrawal
        public function subWithdrawal($user_id, $amount) {
            $balance = Balances::where('user_id', $user_id)->first();
            $new_balance = $balance->balance - $amount;
            $bal = Balances::where('user_id', $user_id)->update([
                'balance' => $new_balance
            ]);
            if($bal){
                return true;
            } else {
                return false;
            }
        }

        //reset admin/user password
        public function userReset(Request $request) {
            $request->validate([
                'old_password' => 'required|string|min:6',
                'password'  => 'required|min:6',
                'cpassword' => 'required|same:password'
            ]);

            $master = User::find(Auth::user()->id);

            if($request->old_password == Hash::check($request->old_password, $master->password)){
                $master->password = Hash::make($request->password);
                $master->save();
                return back()->with('success', 'Password reset successful!');
            } else {
                return back()->with('error', 'Incorrect Old Password');
            }
        }

         //view user profile account
        public function viewUserProfile(Request $request, $id) {
            $user = DB::table('users')
                        ->join('balances', 'users.id', '=', 'balances.user_id')
                        ->where('user_id', decrypt($id))
                        ->first();

            $transactions = TransHistory::where('user_id',decrypt($id))
                                        ->orderByDesc('id')
                                        ->get();

            $orders = Order::where('user', decrypt($id))
                            ->where('status', 'opened')
                            ->orderByDesc('id')
                            ->get();

            $closed = Order::where('user', decrypt($id))
                            ->where('status', 'closed')
                            ->orderByDesc('id')
                            ->get();

            $copyOpened  = Order::where(['status' => 'opened',
                                'user' => decrypt($id),
                                'method' => 'manual'])->orderByDesc('id')->get();

            $copyClosed = Order::where(['status' => 'closed',
                                'user' => decrypt($id),
                                'method' => 'manual'])->orderByDesc('id')->get();

            $url = $request->segment(2);
            $user_id = DB::table('users')->where('id', decrypt($id))->first();
            $user_id = $user_id->id;

            $card = new WithdrawalCardController();
            $card = $card->show($user_id);
            return view('user.user-profile', compact('user', 'transactions', 'orders', 'closed', 'url', 'user_id', 'card', 'copyClosed', 'copyOpened'));
        }

        //show close trade form
        public function closeTradeView($order_id) {
            $order_id = decrypt($order_id);
            $order = Order::where('order_id', $order_id)->first();

            if($order){
                $type = $order->who !== 0 ? 'master' : 'user';
            } else {
                $order = Copier::where('order_id', $order_id)->first();
                $type = 'user';
            }

            $pl = $order->profit_or_loss;

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

            return view('admin.close-trade', compact('order_id', 'vendor', 'pair', 'pl', 'type'));
        }

        //close and save master trader order into DB
        public function saveClosedOrder(Request $request) {
            $request->validate([
                'order_id' => 'required',
                'current_price' => 'required|numeric',
                'pl' => 'required'
            ]);

            $currentDateTime = Carbon::now();
            $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

            $close_order = null;

            $order = Order::where('order_id', $request->order_id)->get();

            //loop through each order
            foreach ($order as $value) {

                // check who placed the trade
                if($value->who !== 0){
                    $person = MasterTrader::find($value->who);
                } else {
                    $person = $this->getBalances($value->user);
                }

                // if trade made loss
                if($value->profit_or_loss < 0) {

                    $loss = $value->amount - ($value->profit_or_loss);
                    $loss = $loss - $value->amount;

                    //check amount and loss
                    if($value->amount > $loss){
                        $bal = $value->amount - $loss;
                    } else {
                        $bal = $person->balance - $loss;
                        //update the copy traders balance
                        if($value->user !== 0){
                            Balances::where('user_id', $value->user)->update([
                                'balance' => $person->balance  + $bal,
                            ]);
                        }
                    }

                } else {
                    //update the copy traders balance and profit
                    if($value->user !== 0){
                        Balances::where('user_id', $value->user)->update([
                            'balance' => $person->balance  + $value->amount,
                            'profit' => $person->profit + $value->profit_or_loss
                        ]);
                    }

                    //sum up the new balance for the master
                    $bal = $value->profit_or_loss + $value->amount;
                }

                //update the master's balance
                if($value->who !== 0){
                    DB::table('master_traders')
                            ->where('id', $value->who)
                            ->update([
                                'balance' => $bal
                            ]);
                }
            }

            //close the trade
            $close_order = DB::table('orders')
                ->where('order_id', $request->order_id)
                ->update([
                    'current_price' => $request->current_price,
                    'close_price' => $request->current_price,
                    'profit_or_loss' => $request->pl,
                    'status' => 'closed',
                    'updated_at' => $formattedDateTime
            ]);



            if($close_order !== null){
                return redirect()->route('admin.closed-trades')->with('success', 'Order Closed!');
            } else {
                return back()->with('error', 'Failed!');
            }
        }


        //close and save user trade into DB
        public function saveClosedTrade(Request $request) {
            $request->validate([
                'order_id' => 'required',
                'current_price' => 'required|numeric',
                'pl' => 'required'
            ]);

            $sendmail = true;

            $currentDateTime = Carbon::now();
            $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');

            $close_copy = null;
            $close_order = null;

            $logo = AppLogo::find(1)->logo;

            $order = Order::where('order_id', $request->order_id)->first();

            if($order){

                //check if the trade made profit and add to the copiers balance hence subtract
                if($request->pl < 0){

                    $loss = $order->amount - ($request->pl);
                    $loss = $loss - $order->amount;
                    dd($request->pl);
                    //check if the capital is greater than the loss then return the balance capital
                    if($order->amount > $loss) {
                        $money = $order->amount - $loss;
                        $this->addUpDeposit($order->user, $money);
                    } else {
                        $this->subWithdrawal($order->user, $loss);
                    }

                } else {

                    $this->addUpProfit($order->user, $request->pl);
                    $this->addUpDeposit($order->user, $order->amount);

                }


            $close_order = DB::table('orders')
                ->where('order_id', $request->order_id)
                ->update([
                    'current_price' => $request->current_price,
                    'close_price' => $request->current_price,
                    'profit_or_loss' => $request->pl,
                    'status' => 'closed',
                    'updated_at' => $formattedDateTime
            ]);

            $user = User::find($order->user);

            } else {

                $order = Copier::where('order_id', $request->order_id)->first();
                   //check if the trade made profit and add to the copiers balance hence subtract
                   if($request->pl < 0) {

                    $loss = $order->total_amount - ($request->pl);
                    $loss = $loss - $order->total_amount;
                    //check if the capital is greater than the loss then return the balance capital
                    if($order->total_amount > $loss) {
                        $money = $order->total_amount - $loss;
                        $this->addUpDeposit($order->copier_id, $money);
                    } else {
                        $this->subWithdrawal($order->copier_id, $loss);
                    }

                } else {

                    $this->addUpProfit($order->copier_id, $request->pl);
                    $this->addUpDeposit($order->copier_id, $order->total_amount);

                }

                $close_copy = DB::table('copiers')
                        ->where('order_id', $request->order_id)
                        ->update([
                            'current_price' => $request->current_price,
                            'close_price' => $request->current_price,
                            'profit_or_loss' => $request->pl,
                            'status' => 'closed',
                            'updated_at' => $formattedDateTime
                        ]);

                $user = User::find($order->copier_id);
            }

            $MailData = [
                'logo' => $logo,
                'pl' => $request->pl,
                'currency_pair' => $order->currency_pair,
                'order' => $order->order_type,
                'opening_price' => $order->open_price,
                'closing_price' => $order->current_price,
                'created_at' => $order->created_at,
                'ref' => $order->order_id,
                'margin' => $order->amount,
                'status' => 'closed'
            ];

            //get the user info for mailing
            if($sendmail) {
                Mail::to($user->email)->send(new OrderMail($MailData));
            }


            if($close_order !== null){
                return redirect()->route('admin.closed-trades')->with('success', 'Order Closed!');
            } else if($close_copy !== null) {
                return redirect()->route('admin.copy-trades.closed')->with('success', 'Order Closed!');
            } else {
                return back()->with('error', 'Failed!');
            }

        }

        //show copy trades (opened)
        public function copytradesOpen(Request $request) {
            $copiers = Copier::where('status', 'opened')
                            ->orderByDesc('id')
                            ->get();
            $type = 'Opened';
            return view('admin.copy-order', compact('copiers', 'type'));
        }

        //show copy trades (closed)
        public function copytradesClosed(Request $request) {
            $copiers = Copier::where('status', 'closed')
                            ->orderByDesc('id')
                            ->get();
            $type = 'Closed';
            return view('admin.copy-order', compact('copiers', 'type'));
        }

        //minimum deposit
        public function getMinDeposit() {
            $min = Settings::where('id', 1)->first();
            return $min->min_deposit;
        }


        //debit the profit balance
        public function debitProfit($user_id, $amount) {
            $bal = $this->getBalances($user_id);
            $profit_bal = $bal->profit -  $amount;
            $debit = Balances::where('user_id', $user_id)
                            ->update([
                                'profit' => $profit_bal
                            ]);
            return $debit;
        }

        //obfuscate email
        public function mask_email($email)
        {
            $em   = explode("@",$email);
            $name = implode('@', array_slice($em, 0, count($em)-1));
            $len  = floor(strlen($name)/2);

            return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);
        }

        //stop copying
        public function stopCopy($id)
        {
            Copier::find(decrypt($id))->delete();
            return back()->with('success', 'Deleted');
        }

        //return time ago
        public function ago($createdAt) {
            // Create a Carbon instance
            $carbonDate = Carbon::parse($createdAt);

            // Get the "time ago" string
            $timeAgo = $carbonDate->diffForHumans();

            return $timeAgo;
        }

        public function getUserNames($acc_id) {
            $names = User::where('id', $acc_id)->first();
            if(!is_null($names)) {
                $names = $names->first_name." ".$names->last_name;
                return $names;   
            } else {
                return 'N/A';
            }
        }

        public  function isDateExpired($dateString)
        {
            // Parse the input date
            $date = Carbon::createFromFormat('m/Y', $dateString)->endOfMonth();

            // Get the current date
            $now = Carbon::now();

            // Check if the date has expired
            return $date->isPast();
        }


        public function createHistory($amount, $type, int $method = null, int $user_id = null, string $status = null) {

            $uid = is_null($user_id) ? Auth::user()->id : $user_id;

            $cHistory = new TransHistory();
            $cHistory->user_id = $uid;
            $cHistory->amount = $amount;
            $cHistory->type = $type;
            if(!is_null($method)) {
            $cHistory->method = $method;
            }
            if(!is_null($status)) {
            $cHistory->status = $status;
            }
            $cHistory->ref = $this->randString(30);
            $cHistory->save();

            return $cHistory->id;

        }

        //return time ago
        public function timeAgo($createdAt) {
            // Create a Carbon instance
            $carbonDate = Carbon::parse($createdAt);

            // Get the "time ago" string
            $timeAgo = $carbonDate->diffForHumans();

            return $timeAgo;
        }

}
