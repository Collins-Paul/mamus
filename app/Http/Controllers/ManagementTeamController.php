<?php

namespace App\Http\Controllers;

use App\Models\ManagementTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $members = ManagementTeam::orderBy('id', 'desc')->get();
        return view('admin.team', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.create-team');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'description' => 'nullable|string|max:350',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $create = new ManagementTeam();

        if($image = $request->file('image')){
            $destinationPath = 'teams/';
            $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $uploadImage);
            $create->photo = "$uploadImage";
        }

        $create->staff_name = $data['name'];
        $create->staff_position = $data['position'];
        $create->description = $data['description'];

        $newTeam = $create->save();

        if ($newTeam) {
            return back()->with('success', 'New member added successfully!');
        } else {
            return back()-with('error', 'Could not add member, try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManagementTeam  $managementTeam
     * @return \Illuminate\Http\Response
     */
    public function show(ManagementTeam $managementTeam, $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManagementTeam  $managementTeam
     * @return \Illuminate\Http\Response
     */
    public function edit(ManagementTeam $managementTeam, $id)
    {
        //
        $data = $managementTeam::where('id', decrypt($id))->first();
        return view('admin.edit-team', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManagementTeam  $managementTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $data = $request->validate([
            'id' => 'required',
            'name' => 'nullable|string',
            'position' => 'nullable|string',
            'description' => 'nullable|string|max:350',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($image = $request->file('image')){
            $destinationPath = 'teams/';
            $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $uploadImage);
        }

        $editTeam = DB::table('management_teams')
                        ->where('id', $data['id'])
                        ->update([
                            'photo' => "$uploadImage",
                            'staff_name' => $data['name'],
                            'staff_position' => $data['position'],
                            'description' => $data['description'],
                        ]);

        if ($editTeam) {
            return back()->with('success', 'Edited successfully!');
        }
        else {
            return back()->with('error', 'Could not save.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManagementTeam  $managementTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManagementTeam $managementTeam, $id)
    {
        //
        $managementTeam->where('id', decrypt($id))->delete();
        return back()->with('success', 'Deleted Successfully');
    }
}
