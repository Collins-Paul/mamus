<?php

namespace App\Http\Controllers;

use App\Models\NetworkFee;
use Illuminate\Http\Request;

class NetworkFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fees = NetworkFee::get();
        return view('admin.network-fees.all', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.network-fees.index');
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
            'label' => 'required|string',
            'percentage' => 'required|numeric',
            'type' => 'required|string',
        ]);

        $fees = new NetworkFee();
        $fees->type = $request->label;
        $fees->percentage = $request->percentage;
        $fees->network = $request->type;
        $fees->save();

        return redirect()->route('admin.admin.fees.all')->with('success', 'Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NetworkFee  $networkFee
     * @return \Illuminate\Http\Response
     */
    public function show(NetworkFee $networkFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NetworkFee  $networkFee
     * @return \Illuminate\Http\Response
     */
    public function edit(NetworkFee $networkFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NetworkFee  $networkFee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NetworkFee $networkFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NetworkFee  $networkFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(NetworkFee $networkFee, $id)
    {
        //
        $networkFee->destroy(decrypt($id));
        return back()->with('success', 'Deleted');
    }
}
