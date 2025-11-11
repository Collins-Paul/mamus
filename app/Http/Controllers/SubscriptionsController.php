<?php

namespace App\Http\Controllers;

use App\Models\SubPlans;
use App\Models\Subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    // show the payment form for subscription
    public function payment($id) {
        $wallet = DB::table('wallets')->first();
        $plan = Subscriptions::where('id', decrypt($id))->first();
        return view('user.subscription-form', compact('wallet', 'plan'));
    }

    //create and store newly created plan
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'weeks' => 'required|numeric',
            'percentage' => 'required|numeric'
        ]);

        $create = new Subscriptions();

        $create->heading = $request->title;
        $create->price = $request->price;
        $create->weeks = $request->weeks;
        $create->percentage = $request->percentage;

        if ($create->save()) {
            return redirect()->route('admin.sub.plans')->with('success', 'New plan created!');
        } else {
            return back()->with('error', 'Failed');
        }

    }

    //show subscription plans
    public function show() {
        $app = new AppLogicController();
        $data = Subscriptions::orderByDesc('id')->get();
        $robot_sub = SubPlans::where('user_id', Auth::user()->id)->first();
        // $daysRemaining = $app->remainingDays($robot_sub->exp_date);
        return view('user.robot-subscription', compact('data', 'robot_sub'));
    }

    //delete subscription plan
    public function delete($id){
        $delete = subscriptions::where('id', decrypt($id))->delete();
        if($delete){
            return back()->with('success', 'Deleted!');
        } else {
            return back()->with('error', 'Failed!');
        }
    }

    //show a list of subscriptions
    public function showList() {
        $user = new UserController();
        $sub = DB::table('sub_plans')->orderByDesc('id')->get();
        return view('admin.subscription-list', compact('sub', 'user'));
    }

    //process user subscription plans
    public function processSub(Request $request){
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'plan_title' => 'required|string',
            'price' => 'required|numeric',
            'exp_date' => 'required|string',
        ]);

        $app = new AppLogicController();
        //get and store the receipt
        $fileUpload = $app->uploadImgFile($request->file('file'), 'receipt/');

        $card = new WithdrawalCardController();

        $robot_id = $card->cardPIN(10);

        $check = SubPlans::where('user_id', Auth::user()->id)->first();

        if($check !== null){
            $check->update([
                'plan_title' => $request->plan_title,
                'price' => $request->price,
                'purchase_date' => date('dS M, Y'),
                'exp_date' => $request->exp_date,
                'status' => 'processing',
                'reciept' => $fileUpload,
                'robot_id' => $robot_id
            ]);
            return Redirect()->route('user.robot.subscription')->with('success', 'Subscription Successful!');
        } else {

            $data = new SubPlans();
            $data->user_id = Auth::user()->id;
            $data->plan_title = $request->plan_title;
            $data->price = $request->price;
            $data->purchase_date = date('dS M, Y');
            $data->exp_date = $request->exp_date;
            $data->status = 'processing';
            $data->reciept = $fileUpload;
            $data->robot_id = $robot_id;

            if($data->save()){
                return Redirect()->route('user.robot.subscription')->with('success', 'Subscription Successful!');
            } else {
                return back()->with('error', 'Something went wrong! Try again...');
            }
        }

    }

    //activate robot subscription
    public function activate($id){
        // get the user id
        $getInfo = SubPlans::where('id', decrypt($id))->first();

        //update the user balance with the robot subscription amount
        $deposit = new AppLogicController();
        $deposit->addUpDeposit($getInfo->user_id, $getInfo->price);

        $activate = SubPlans::where('id', decrypt($id))
                            ->update([
                                'status' => 'active'
                            ]);

        if($activate){
            return back()->with('success', 'Robot Activated!');
        } else {
            return back()->with('error', 'Activation Failed!');
        }
    }

    //delete robot subscription
    public function deletePLan($id){
        $delete = SubPlans::where('id', decrypt($id))->delete();
        if($delete){
            return back()->with('success', 'Deleted!');
        } else {
            return back()->with('error', 'Could not delete!');
        }
    }

      //give a client free 1wk subscription plan
      public function freePlan($user_id) {
        $card = new WithdrawalCardController();
        $data = new SubPlans();
        $data->user_id = $user_id;
        $data->plan_title = '1 Week Free';
        $data->price = 1000;
        $data->purchase_date = date('dS M, Y');
        $data->exp_date = date('dS M, Y', strtotime('+1 week'));
        $data->status = 'active';
        $data->reciept = '';
        $data->robot_id = $card->cardPIN(10);
        $data->save();
    }
}
