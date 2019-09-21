<?php

use App\Models\RelayPoint;

if (!function_exists('relaypoint')) {
    function relaypoint($region, $city) {
        return RelayPoint::where('region_id', $region)->where('city_id', $city)->first();
    }
}
