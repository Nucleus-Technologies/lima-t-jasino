<?php
use Carbon\Carbon;
use App\Models\User;
use App\Models\Session;
use Illuminate\Support\Facades\Cookie;

if (!function_exists('show_title')) {
    function show_title($title) {
        return $title . ' | ' . config('app.name');
    }
}

if (!function_exists('show_title_admin')) {
    function show_title_admin($title) {
        return $title . ' | Admin | ' . config('app.name');
    }
}

if (! function_exists('set_active_route')) {
    function set_active_route($route)
    {
        return Route::is($route) ? 'active' : '';
    }
}

if (!function_exists('id_to_full_name')) {
    function id_to_full_name($id) {
        return User::find($id);
    }
}

if (!function_exists('id_to_author_msg')) {
    function id_to_author_msg($id, $origin) {
        return ($origin == 'user') ? User::find($id)->full_name : 'Tailors';
    }
}

if (!function_exists('format_message')) {
    function format_message($message, $length) {
        $suffx = '';

        if (strlen($message) >= $length) {
            $suffx = '...';
        }

        return substr(str_replace('<br />', '', $message), 0, $length) . $suffx;
    }
}

if (!function_exists('format_date')) {
    function format_date($date) {
        return Carbon::parse($date)->format('jS F Y');
    }
}

if (!function_exists('format_time')) {
    function format_time($time) {
        return Carbon::parse($time)->format('g:i a');
    }
}

if (!function_exists('format_done')) {
    function format_done($done) {
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

if (!function_exists('make_cookie_session')) {
    function make_cookie_session() {
        $session = Session::create();

        Cookie::queue(Cookie::forever('user', $session->id));

        return Cookie::get('user');
    }
}
