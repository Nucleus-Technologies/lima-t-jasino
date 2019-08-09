<?php

if (!function_exists('showTitle')) {
    function showTitle($title) {
        return $title . ' | ' . config('app.name');
    }
}

if (!function_exists('showTitleAdmin')) {
    function showTitleAdmin($title) {
        return $title . ' | Admin | ' . config('app.name');
    }
}

if (! function_exists('set_active_route')) {
    function set_active_route($route)
    {
        return Route::is($route) ? 'active' : '';
    }
}
