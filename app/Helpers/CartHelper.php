<?php

use App\Models\Cart;
use App\Models\Order;
use App\Models\RelayPoint;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

if (!function_exists('number_outfit_cart')) {
    function number_outfit_cart() {
        if (Auth::check()) {
            return Auth::user()->cart()->where('source', 'in')->sum('quantity');
        } else {
            if (Cookie::has('user')) {
                $user = Cookie::get('user');

                return Session::find($user)->cart()->where('source', 'out')->sum('quantity');
            } else {
                $user = make_cookie_session();

                if ($user == null) return redirect()->route('home');

                return Session::find($user)->cart()->where('source', 'out')->sum('quantity');
            }
        }
    }
}

if (!function_exists('subtotal')) {
    function subtotal() {
        if (Auth::check()) {
            $lines = Cart::where('user_id', Auth::user()->id)->where('source', 'in')->get();
        } else {
            if (Cookie::has('user')) {
                $user = Cookie::get('user');

                $lines = Cart::where('user_id', Session::find($user)->id)->where('source', 'out')->get();;
            } else {
                $user = make_cookie_session();

                if ($user == null) return redirect()->route('home');

                $lines = Cart::where('user_id', Session::find($user)->id)->where('source', 'out')->get();;
            }
        }

        $st = 0;

        foreach ($lines as $line) {
            $st = $st + $line->total_price;
        }

        return $st;
    }
}

if (!function_exists('subtotal_o')) {
    function subtotal_o($order) {
        $lines = null;

        if(isset(Auth::user()->username)) {
            $lines = Order::find($order)->orderlines()->get();
        } else {
            $lines = Auth::user()->orders()->find($order)->orderlines()->get();
        }

        $st = 0;

        foreach ($lines as $line) {
            $st = $st + $line->total_price;
        }

        return $st;
    }
}

if (!function_exists('shipping_cost')) {
    function shipping_cost($relayPoint = null) {
        if (isset($relayPoint)) {
            return RelayPoint::find($relayPoint)->shipping_cost;
        } else {
            return 0;
        }
    }
}

if (!function_exists('total')) {
    function total($relayPoint = null) {
        return subtotal() + shipping_cost($relayPoint);
    }
}

if (!function_exists('total_o')) {
    function total_o($order) {
        if(isset(Auth::user()->username)) {
            return subtotal_o($order) + Order::find($order)->relaypoint()->first()->shipping_cost;
        } else {
            return subtotal_o($order) + Auth::user()->orders()->find($order)->relaypoint()->first()->shipping_cost;
        }
    }
}

