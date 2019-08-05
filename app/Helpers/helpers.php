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
