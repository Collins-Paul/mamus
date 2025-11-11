<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceOrderController extends AppLogicController
{
    public function placeOrder() {
        return view('user.placeOrder');
    }

    //create buy order
    public function buyOrder(Request $request) {

        $lot_size = $request->input('lot_size');
        $last_price = $request->input('last_price');
        $market = $request->input('market');
        $symbols = $request->input('symbols');

        $amount = ($lot_size / $last_price) * 100;

        $order =  new Order();
        $order->lot_size = $lot_size;
        $order->open_price = $last_price;
        $order->market = $market;
        $order->currency_pair = $symbols;
        $order->order_type = 'buy';
        $order->order_id = $this->randString(5);
        $order->amount = $amount;
        $order->who = 0;
        $order->user = Auth::user()->id;

        $user_bal = $this->getBalances(Auth::user()->id)->balance;

        if($order->amount > $user_bal){
            return response()->json([
                'message' => 'Insufficient Balance',
                'status' => 401
            ]);
        } else {
            if($order->save()){
                $this->subWithdrawal(Auth::user()->id, $amount);
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

        $amount = ($lot_size / $last_price) * 100;

        $order =  new Order();
        $order->lot_size = $lot_size;
        $order->open_price = $last_price;
        $order->market = $market;
        $order->currency_pair = $symbols;
        $order->order_type = 'sell';
        $order->order_id = $this->randString(5);
        $order->amount = $amount;
        $order->who = 0;
        $order->user = Auth::user()->id;

        $user_bal = $this->getBalances(Auth::user()->id)->balance;

        if($order->amount > $user_bal){
            return response()->json([
                'message' => 'Insufficient Balance',
                'status' => 401
            ]);
        } else {
            if($order->save()){
                $this->subWithdrawal(Auth::user()->id, $amount);
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

        //show all opened trades
        public function showOpenTrades(Request $request) {
            $orders = Order::where('status', 'opened')
                            ->where('user', Auth::user()->id)
                            ->orderByDesc('id')
                            ->get();
            return view('user.opened-trades', compact('orders'));
        }

        //show all closed trades
        public function showClosedTrades() {
            $closed = Order::where('status', 'closed')
                            ->where('user', Auth::user()->id)
                            ->orderByDesc('id')
                            ->get();
            return view('user.closed-trades', compact('closed'));
        }

}
