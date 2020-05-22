<?php

use App\Models\Session;
use Illuminate\Support\Facades\Auth;

if (!function_exists('format_availibility')) {
    function format_availibility($availibility) {
        return ($availibility == 'in') ?
            '<span class="badge badge-pill badge-success">In Stock</span>'
            : '<span class="badge badge-pill badge-danger">Temporarily Out of Stock</span>';
    }
}

if (!function_exists('show2digits')) {
    function show2digits($total) {
        return ($total < 10) ? '0' .$total : $total;
    }
}

if (!function_exists('show_photo')) {
    function show_photo($path) {
        return asset('uploads/' . $path);
    }
}

if (!function_exists('back_to_line')) {
    function back_to_line($text) {
        return str_replace('\\r\\n', '<br>', $text);
    }
}

if (!function_exists('is_wished')) {
    function is_wished($outfit) {
        if (Auth::check()) {
            $user = Auth::user()->id;

            $check = Auth::user()->wishlist()->where('outfit_id', $outfit)->where('source', 'in')->first();
        } else {
            $user_cookie = get_cookie_session();

            if ($user_cookie == null) return redirect()->route('home');

            $check = Session::find($user_cookie)->wishlist()->where('outfit_id', $outfit)->where('source', 'out')->first();
        }

        return isset($check) ? true : false;
    }
}
