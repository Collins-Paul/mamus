<?php

namespace App\Http\Controllers;

use App\Models\Testimonies;
use Illuminate\Http\Request;

class TestimoniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $testimonies = Testimonies::orderBy('id', 'desc')->get();
        return view('admin.testimonies', compact('testimonies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.testimonies-create');
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
            'name' => 'required|string',
            'testimony' => 'required|string|max:350',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $create = new Testimonies();

        if($image = $request->file('image')){
            $destinationPath = 'testifiers/';
            $uploadImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $uploadImage);
            $create->photo = "$uploadImage";
        }

        $create->investor = $data['name'];
        $create->testimony = $data['testimony'];

        if ($create->save()) {
            return back()->with('success', 'New testimony created!');
        } else {
            return back()-with('error', 'Failed! Try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonies  $testimonies
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonies $testimonies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonies  $testimonies
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonies $testimonies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonies  $testimonies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonies $testimonies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonies  $testimonies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonies $testimonies, $id)
    {
        $testimonies->where('id', decrypt($id))->delete();
        return back()->with('success', 'Deleted Successfully');
    }
}
