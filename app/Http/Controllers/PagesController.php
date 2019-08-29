<?php

namespace App\Http\Controllers;

use App\Models\Outfit;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $outfits = Outfit::orderBy('created_at', 'desc')
            ->paginate(9);

        return view('customer.home', compact('outfits'));
    }
}
