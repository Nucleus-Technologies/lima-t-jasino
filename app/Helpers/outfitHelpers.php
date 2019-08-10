<?php

use Carbon\Carbon;
use App\Models\Outfit;
use App\Models\OutfitPhoto;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;

if (!function_exists('showAvailibility')) {
    function showAvailibility($availibility) {
        return ($availibility == 'in') ?
            '<span class="badge badge-pill badge-success">In Stock</span>'
            : '<span class="badge badge-pill badge-danger">Out of Stock</span>';
    }
}

if (!function_exists('showSpecification')) {
    function showSpecification($specification) {
        $tab = explode('|', $specification);

        $html = '<ul class="list-group">';
        foreach ($tab as $elt) {
            $html .= '<li class="list-group-item">' .str_replace(':', ': ', $elt). '</li>';
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

if (!function_exists('showPhoto')) {
    function showPhoto($filename) {
        return Storage::url($filename);
    }
}

if (!function_exists('getOutfitPhotos')) {
    function getOutfitPhotos($outfit) {
        return OutfitPhoto::where('outfit', $outfit)->get();
    }
}

if (!function_exists('totalThisMonth')) {
    function totalThisMonth($category) {
        return Outfit::where('category', $category)
            ->where('created_at', 'like', '%'.Carbon::now()->month.'%')
            ->count();
    }
}

if (!function_exists('idTowording')) {
    function idToWording($id) {
        return Type::where('id', $id)->first();
    }
}

if (!function_exists('backToLine')) {
    function backToLine($text) {
        return str_replace('\\r\\n', '<br>', $text);
    }
}
