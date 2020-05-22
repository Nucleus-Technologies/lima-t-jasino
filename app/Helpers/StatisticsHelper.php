<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Outfit;
use App\Models\Wishlist;
use App\Models\OrderLine;

if (!function_exists('number_customers')) {
    function number_customers() {
        return show2digits(number_format(User::count()));
    }
}

if (!function_exists('number_orders')) {
    function number_orders() {
        return show2digits(number_format(Order::count()));
    }
}

if (!function_exists('total_week')) {
    function total_week($elt, $i) {
        $monday = ($i == 0) ? date("Y-m-d", strtotime("this week monday")) : date("Y-m-d", strtotime("last week monday"));
        $sunday = ($i == 0) ? date("Y-m-d", strtotime("this week sunday")) : date("Y-m-d", strtotime("last week sunday"));

        if ($elt == 'user') {
            $total = User::whereBetween('created_at', [$monday, $sunday])->count();
        } elseif ($elt == 'order') {
            $total = Order::whereBetween('created_at', [$monday, $sunday])->count();
        }

        return $total;
    }
}

if (!function_exists('stat_week_pcent')) {
    function stat_week_pcent($elt, $i) {
        if ($elt == 'user') {
            $total = User::count();
        } elseif ($elt == 'order') {
            $total = Order::count();
        }

        return ($total == 0) ? 0 : round_number((total_week($elt, $i) / $total) * 100);
    }
}

if (!function_exists('total_month')) {
    function total_month($elt, $i) {
        if ($elt == 'outfit') {
            $total = ($i == 0)
                ? Outfit::whereRaw('MONTH(created_at) = ?', [date('m')])->count()
                : Outfit::whereRaw('MONTH(created_at) = ?', [date('m', strtotime('last month'))])->count();
        } elseif ($elt == 'user') {
            $total = ($i == 0)
                ? User::whereRaw('MONTH(created_at) = ?', [date('m')])->count()
                : User::whereRaw('MONTH(created_at) = ?', [date('m', strtotime('last month'))])->count();
        } elseif ($elt == 'order') {
            $total = ($i == 0)
                ? Order::whereRaw('MONTH(created_at) = ?', [date('m')])->count()
                : Order::whereRaw('MONTH(created_at) = ?', [date('m', strtotime('last month'))])->count();
        }

        return $total;
    }
}

if (!function_exists('stat_month')) {
    function stat_month($elt, $item) {
        if ($elt == 'outfit') {
            $total_curr = Outfit::where('category', $item)
                ->whereRaw('MONTH(created_at) = ?', [date('m')])
                ->count();
            $total_prev = Outfit::where('category', $item)
                ->whereRaw('MONTH(created_at) = ?', [date('m', strtotime('last month'))])
                ->count();
        } elseif ($elt == 'user') {
            # code...
        }

        return $total_curr - $total_prev;
    }
}

if (!function_exists('stat_month_pcent')) {
    function stat_month_pcent($elt, $i) {
        if ($elt == 'user') {
            $total = User::count();
        } elseif ($elt == 'order') {
            $total = Order::count();
        }

        return ($total == 0) ? 0 : round_number((total_month($elt, $i) / $total) * 100);
    }
}

if (!function_exists('number_wishes')) {
    function number_wishes($outfit) {
        return Wishlist::where('outfit_id', $outfit)->count();
    }
}

if (!function_exists('number_sales')) {
    function number_sales($outfit) {
        return OrderLine::where('outfit_id', $outfit)->count();
    }
}

