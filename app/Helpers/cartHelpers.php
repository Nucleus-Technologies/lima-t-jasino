<?php

use App\Models\Cart;
use App\Models\Outfit;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

if (!function_exists('number_outfit_cart')) {
    function number_outfit_cart() {
        return (Auth::check()) ? Auth::user()->cart()->where('source', 'in')->sum('quantity')
            : Session::find(Cookie::get('user'))->cart()->where('source', 'out')->sum('quantity');
    }
}

if (!function_exists('cart_outfit')) {
    function cart_outfit($outfit) {
        return Outfit::find($outfit);
    }
}

if (!function_exists('total_price')) {
    function total_price($outfit, $quantity) {
        return cart_outfit($outfit)->price * $quantity;
    }
}

if (!function_exists('subtotal')) {
    function subtotal() {
        $lines = (Auth::check()) ? Cart::where('user', Auth::user()->id)->where('source', 'in')->get()
            : Cart::where('user', Session::find(Cookie::get('user'))->id)->where('source', 'out')->get();
        $st = 0;

        foreach ($lines as $line) {
            $st = $st + total_price($line->outfit, $line->quantity);
        }

        return $st;
    }
}
