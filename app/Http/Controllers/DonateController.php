<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use Illuminate\Http\Request;

class DonateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.donate.donate');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
           'name' => 'required',
            'phone' => 'required',
            'donation_type' => 'required',
            'amount' => 'nullable',
            'item_name' => 'nullable',
            'item_qty' => 'nullable',
            'expired_date' => 'nullable',
            'message' => 'nullable',
            'awb' => 'required',
            'courier_id' => 'required',
        ]);
        Donate::create($validateData);
        return redirect(route('donate.index'))->with('success','Anda telah melakukan donasi!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
