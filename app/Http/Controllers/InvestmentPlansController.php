<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\InvestmentPlans;
use App\Models\UserInvestments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InvestmentPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plans = InvestmentPlans::get();

        if (Auth::user()->who == 2) {
            return view('admin.packages-list', compact('plans'));
        } else {
            return view('user.pricing-table', compact('plans'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.create-investment');
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
            'name'        => 'required|string',
            'return'      => 'required|string',
            'interest'    => 'required|numeric',
            'weeks'    => 'required|numeric',
            'min_deposit' => 'required|numeric',
            'max_deposit' => 'required|numeric'
        ]);

        $plan = new InvestmentPlans();
        $plan->plan_title = $request->name;
        $plan->interest_percent = $request->interest;
        $plan->duration = $request->weeks;
        $plan->min_deposit = $request->min_deposit;
        $plan->max_deposit = $request->max_deposit;
        $plan->deposit_return = $request->return;

        if($plan->save()){
            return redirect()
                        ->route('admin.packages.index')
                        ->with('success', 'New Package Created!');
        } else {
            return back()->with('error', 'Failed! Try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvestmentPlans  $investmentPlans
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $data = UserInvestments::where('user_id', Auth::user()->id)
                                ->where('status', 1)
                                ->orderBy('id', 'desc')
                                ->get();
        $expired = UserInvestments::where('user_id', Auth::user()->id)
                                ->where('status', 0)
                                ->orderBy('id', 'desc')
                                ->limit(2)
                                ->get();
        return view('user.active-investment', compact('data', 'expired'));
    }

    //show a user investments using id
    public function userInvestment($id) {
        $data = UserInvestments::where('user_id', decrypt($id))
                                ->where('status', 1)
                                ->orderBy('id', 'desc')
                                ->get();
        $expired = UserInvestments::where('user_id', decrypt($id))
                                ->where('status', 0)
                                ->orderBy('id', 'desc')
                                ->limit(2)
                                ->get();

        return view('user.active-investment', compact('data', 'expired'));
    }

    //show the form to enter investment amount
    public function form($id) {
        $plan = InvestmentPlans::find(decrypt($id));
        return view('user.choose-investment', compact('plan'));
    }

    //save the chosen package by an investor
    public function save(Request $request) {
        $request->validate([
            'plan_id' => 'required|string',
            'amount'  => 'required|numeric'
        ]);

        $planInfo = InvestmentPlans::find(decrypt($request->plan_id));

        $app = new AppLogicController();
        $bal = $app->getBalances(Auth::user()->id);

        if($bal->balance < $request->amount){
            return back()->with('error', 'Insufficient Balance');
        }

        //check if the user entered below min deposit
        if($planInfo->min_deposit > $request->amount) {
            return back()->with('error', 'Insufficient investment amount');
        }

        //check if the user entered above max deposit
        if($request->amount > $planInfo->max_deposit) {
            return back()->with('error', 'Amount required is $'. $planInfo->min_deposit . " - $" . $planInfo->max_deposit);
        }

        $endDate = date('dS M, Y', strtotime('+'.$planInfo->duration.' weeks'));

        $new = new UserInvestments();
        $new->user_id = Auth::user()->id;
        $new->plan = $planInfo->plan_title;
        $new->duration = $planInfo->duration;
        $new->amount = $request->amount;
        $new->percentage = $planInfo->interest_percent;
        $new->start_date = date('dS M, Y');
        $new->end_date = $endDate;
        $new->capital_return = $planInfo->deposit_return;

        if($new->save()){
            $app->subWithdrawal(Auth::user()->id, $request->amount);
            return Redirect()->route('user.my.active.investment')->with('success', 'New Investment Created!');
        } else {
            return back()->with('error', 'Failed! Try again.');
        }
    }

    //update user plan to cancel
    public function update($id) {
        $data = UserInvestments::find(decrypt($id));
        if($data){

            //check if the user capital has to be returned
            if($data->capital_return == 'Yes'){
                $app = new AppLogicController();
                $app->addUpDeposit(Auth::user()->id, $data->amount);
            }

            UserInvestments::where('id', decrypt($id))
                            ->update([
                                'status' => 0
                            ]);

            return back()->with('success', 'Investment Cancelled!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvestmentPlans  $investmentPlans
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvestmentPlans $investmentPlans, $id)
    {
        //
        $investmentPlans->where('id', decrypt($id))->delete();
        return back()->with('success', 'Package Deleted!');
    }
}
