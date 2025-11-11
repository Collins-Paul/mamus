<?php

namespace App\Http\Controllers;

use App\Models\Followers;
use App\Models\User;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $data = Followers::where('master_id', decrypt($id))->get();
        return view('admin.followers', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data = $request->validate([
            'id'        => 'required|string',
            'action'    => 'required|string',
            'master_id' => 'required|string'
        ]);

        $id = decrypt($data['id']);
        $master_id = decrypt($data['master_id']);

        $user = User::find($id);

        // check action value
        if($data['action'] == "Follow"){
            //follow the master trader
            $follow =  new Followers();
            $follow->master_id = $master_id;
            $follow->copier_id = $id;
            $follow->copier_name = $user->first_name." ".$user->last_name;
            $follow->email = $user->email;
            $follow->save();

            return back()->with('success', 'Following now!');

        } else {
            //unfollow the master trader
            Followers::where('copier_id', $id)
                        ->where('master_id', $master_id)
                        ->delete();

            return back()->with('success', 'Unfollowed!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Followers  $followers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $num = Followers::where('master_id', $id)->count();
        return $num;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Followers  $followers
     * @return \Illuminate\Http\Response
     */
    public function edit(Followers $followers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Followers  $followers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Followers $followers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Followers  $followers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            //unfollow the master trader
            Followers::where('id', decrypt($id))->delete();
            return back()->with('success', 'Unfollowed!');
    }
}
