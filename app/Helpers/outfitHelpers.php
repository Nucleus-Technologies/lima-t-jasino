<?php

use Carbon\Carbon;
use App\Models\Type;
use App\Models\Outfit;
use App\Models\Session;
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

if (!function_exists('format_specification')) {
    function format_specification($specification) {
        $tab = explode('|', $specification);

        $html = '<ul class="list-group text-center">';
        foreach ($tab as $elt) {
            $html .= '<li class="list-group-item">' .str_replace(':', ' | ', $elt). '</li>';
        }
        $html .= '</ul>';

        return $html;
    }
}

if (!function_exists('cformat_specification')) {
    function cformat_specification($specification) {
        $tab = explode('|', $specification);

        $html = '
            <table class="table">
                <tbody>';
        foreach ($tab as $elt) {
            $html .= '<tr>';

            $tab_s = explode(':', $elt);
            foreach ($tab_s as $elt_s) {
                $html .= '<td><h5>' .$elt_s. '</h5></td>';
            }

            $html .= '</tr>';
        }
        $html .= '
                </tbody>
            </table>';

        return $html;
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

if (!function_exists('get_outfit_photos')) {
    function get_outfit_photos($outfit) {
        return Outfit::find($outfit)->outfitphotos()->get();
    }
}

if (!function_exists('get_outfit_cover')) {
    function get_outfit_cover($outfit) {
        return Outfit::find($outfit)->outfitphotos()->first();
    }
}

if (!function_exists('total_this_month')) {
    function total_this_month($category) {
        return Outfit::where('category', $category)
            ->where('created_at', 'like', '%'.Carbon::now()->month.'%')
            ->count();
    }
}

if (!function_exists('id_to_label')) {
    function id_to_label($id) {
        return Type::find($id)->label;
    }
}

if (!function_exists('id_to_slug')) {
    function id_to_slug($id) {
        return Outfit::find($id)->slug;
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

            $check = Auth::user()->wishlist()->where('outfit', $outfit)->where('source', 'in')->first();
        } else {
            $user = Cookie::get('user');

            $check = Session::find($user)->wishlist()->where('outfit', $outfit)->where('source', 'out')->first();
        }

        return isset($check) ? 'active' : '';
    }
}
