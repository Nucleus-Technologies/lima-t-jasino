<?php

if (!function_exists('showTitle')) {
    function showTitle($title) {
        return $title . ' | ' . config('app.name');
    }
}
