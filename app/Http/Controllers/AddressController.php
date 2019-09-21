<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    /**
     * Display the address of a customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        Auth::user()->addresses()->update(['current' => false]);

        Address::create([
            'user_id' => Auth::user()->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'zone' => $request->zone,
            'country' => $request->country,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'addressline1' => $request->addressline1,
            'addressline2' => $request->addressline2,
            'region_id' => $request->region,
            'city_id' => $request->city,
            'zip' => $request->zip,
            'current' => true
        ]);

        return redirect()->route('payment.checkout.delivery_method');

        // $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

        // if ($addr) {
        //     $response = ['msg' => 'Address successfully saved!', 'status' => true];
        // }

        // return response()->json($response);
    }

    /**
     * Continue to payment mode with an already stored address.
     *
     * @param  \Illuminate\Http\Request  $address
     * @return \Illuminate\Http\Response
     */
    public function chosen(Request $request)
    {
        $request->validate([
            'address' => 'required|integer'
        ]);

        Auth::user()->addresses()->update(['current' => false]);

        Auth::user()->addresses()->find($request->address)->update(['current' => true]);

        return redirect()->route('payment.checkout.delivery_method');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AddressRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
