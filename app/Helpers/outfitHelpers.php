<?php

use Carbon\Carbon;
use App\Models\Outfit;
use App\Models\OutfitPhoto;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;

if (!function_exists('show_availibility')) {
    function show_availibility($availibility) {
        return ($availibility == 'in') ?
            '<span class="badge badge-pill badge-success">In Stock</span>'
            : '<span class="badge badge-pill badge-danger">Out of Stock</span>';
    }
}

if (!function_exists('show_specification')) {
    function show_specification($specification) {
        $tab = explode('|', $specification);

        $html = '<ul class="list-group text-center">';
        foreach ($tab as $elt) {
            $html .= '<li class="list-group-item">' .str_replace(':', ' | ', $elt). '</li>';
        }
        $html .= '</ul>';

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
        return OutfitPhoto::where('outfit', $outfit)->get();
    }
}

if (!function_exists('total_this_month')) {
    function total_this_month($category) {
        return Outfit::where('category', $category)
            ->where('created_at', 'like', '%'.Carbon::now()->month.'%')
            ->count();
    }
}

if (!function_exists('id_to_wording')) {
    function id_to_wording($id) {
        return Type::where('id', $id)->first()->wording;
    }
}

if (!function_exists('back_to_line')) {
    function back_to_line($text) {
        return str_replace('\\r\\n', '<br>', $text);
    }
}
