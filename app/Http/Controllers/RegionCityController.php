<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RegionCityController extends Controller
{
    /**
     * Display a listing of the regions and their cities.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all()->sortBy('label');
        $cities = City::all()->sortBy('label');

        return view('admin.region_city.index', compact('regions', 'cities'));
    }

    /**
     * Store a newly created regions and their cities in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'region' => 'nullable|integer',
            'label_r' => 'nullable|string',
            'label_c' => 'required|string'
        ]);

        $c_exists = City::where('label', $request->label_c)->first();

        if (isset($request->region) && !isset($request->label_r)) {

            if (isset($c_exists)) {
                $response = ['msg' => 'This city already exists!', 'status' => false];
            } else {
                City::create([
                    'region_id' => $request->region,
                    'label' => $request->label_c
                ]);

                $response = ['msg' => 'City successfully recorded!', 'status' => true];
            }

        } elseif (!isset($request->region) && isset($request->label_r)) {

            $r_exists = Region::where('label', $request->label_r)->first();

            if ($r_exists) {
                $response = ['msg' => 'This region already exists!', 'status' => false];
            } else {
                $region = Region::create([
                    'label' => $request->label_r
                ]);

                City::create([
                    'region_id' => $region->id,
                    'label' => $request->label_c
                ]);

                $response = ['msg' => 'Region and city successfully recorded!', 'status' => true];
            }

        } else {
            $response = ['msg' => 'Selected region and defined region at once!', 'status' => false];
        }

        return response()->json($response);
    }

    /**
     * Display a listing of the regions.
     *
     * @return \Illuminate\Http\Response
     */
    public function regions()
    {
        $regions = Region::orderBy('label')->get();

        return response()->json($regions);
    }

    /**
     * Display a listing of the cities af a region.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function cities(Region $region)
    {
        if (isset(Auth::user()->username)) {
            $ids = DB::table('relay_points')->pluck('city_id')->toArray();

            $cities = $region->cities()->whereNotIn('id', $ids)->orderBy('label')->get();
        }
        else {
            $ids = DB::table('relay_points')->pluck('city_id')->toArray();

            $cities = $region->cities()->whereIn('id', $ids)->orderBy('label')->get();
        }

        return response()->json($cities);
    }

    /**
     * Show the form for editing the specified regions and their cities.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified regions and their cities in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        //
    }

    /**
     * Remove the specified regions and their cities from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        //
    }
}
