<?php
use App\Models\User;
use Carbon\Carbon;

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

if (!function_exists('idToFullname')) {
    function idToFullname($id) {
        return User::where('id', $id)->first();
    }
}

if (!function_exists('idToAuthorMsg')) {
    function idToAuthorMsg($id, $origin) {
        return ($origin == 'user') ? User::where('id', $id)->first()->full_name : 'Tailors';
    }
}

if (!function_exists('formatMessage')) {
    function formatMessage($message, $length) {
        return isset($message) ? substr($message, 0, $length) .'...'
            : '<span class="badge badge-pill badge-info">No comment</span>';
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date) {
        return Carbon::parse($date)->format('jS F Y');
    }
}

if (!function_exists('formatTime')) {
    function formatTime($time) {
        return Carbon::parse($time)->format('g:i a');
    }
}

if (!function_exists('formatDone')) {
    function formatDone($done) {
        return ($done == 0) ? 'Not yet Done' : 'Already Done';
    }
}

if (!function_exists('crypt_id')) {
    function crypt_id($id) {
        return ($id + 7) - (94 / 2);
    }
}

if (!function_exists('decrypt_id')) {
    function decrypt_id($id) {
        return ($id - 7) + (94 / 2);
    }
}
