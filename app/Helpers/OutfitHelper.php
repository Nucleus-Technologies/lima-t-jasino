<?php

use App\Models\Session;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

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
    function show_photo($filename) {
        return Storage::url($filename);
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
            $user = Cookie::get('user');

            $check = Session::find($user)->wishlist()->where('outfit_id', $outfit)->where('source', 'out')->first();
        }

        return isset($check) ? true : false;
    }
}
