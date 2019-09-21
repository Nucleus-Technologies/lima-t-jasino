<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelayPointRequest;
use App\Models\City;
use App\Models\Region;
use App\Models\RelayPoint;
use Illuminate\Http\Request;

class RelayPointController extends Controller
{
    /**
     * Display a listing of the relay points.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relayPoints = RelayPoint::all()->sortBy('label');

        $regions = Region::all()->sortBy('label');

        return view('admin.relaypoint.index', compact('relayPoints', 'regions'));
    }

    /**
     * Show the form for creating a new relay point.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created relay point in storage.
     *
     * @param  \App\Http\Requests\RelayPointRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RelayPointRequest $request)
    {
        $exists = RelayPoint::where('region_id', $request->region)->where('city_id', $request->city)->first();

        if ($exists) {
            $response = ['msg' => 'The relay point for this region & city already exists!', 'status' => false];
        } else {
            $relayPoint = RelayPoint::create([
                'region_id' => $request->region,
                'city_id' => $request->city,
                'label' => $request->label,
                'near' => $request->near,
                'address' => $request->address,
                'contact' => $request->contact,
                'opening_hours' => $request->opening_hours,
                'shipping_cost' => $request->shipping_cost
            ]);

            $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

            if ($relayPoint) {
                $response = ['msg' => 'Relay Point successfully saved!', 'status' => true];
            }
        }

        return response()->json($response);
    }

    /**
     * Display the specified relay point.
     *
     * @param  \App\Models\RelayPoint  $relayPoint
     * @return \Illuminate\Http\Response
     */
    public function show(RelayPoint $relayPoint)
    {
        return view('admin.relaypoint.show', compact('relayPoint'));
    }

    /**
     * Display a specified relay point by region and city.
     *
     * @param  \App\Models\RelayPoint  $relayPoint
     * @return \Illuminate\Http\Response
     */
    public function load($region, $city)
    {
        $relayPoint = RelayPoint::where('region_id', $region)->where('city_id', $city)->first();

        if (isset($relayPoint)) {
            $relayPoint->shipping_cost = convert($relayPoint->shipping_cost);

            return response()->json($relayPoint);
        } else {
            return response()->json(0);
        }

    }

    /**
     * Show the form for editing the specified relay point.
     *
     * @param  \App\Models\RelayPoint  $relayPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(RelayPoint $relayPoint)
    {
        //
    }

    /**
     * Update the specified relay point in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RelayPoint  $relayPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RelayPoint $relayPoint)
    {
        //
    }

    /**
     * Remove the specified relay point from storage.
     *
     * @param  \App\Models\RelayPoint  $relayPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(RelayPoint $relayPoint)
    {
        //
    }
}
