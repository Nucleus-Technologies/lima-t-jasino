<?php

namespace App\Http\Controllers;

use App\Models\Outfit;

class PagesController extends Controller
{
    /**
     * Display the Website Home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outfits = Outfit::orderBy('created_at', 'desc')
            ->paginate(9);

        return view('customer.home', compact('outfits'));
    }

    /**
     * Display the Collection page.
     *
     * @return \Illuminate\Http\Response
     */
    public function collection()
    {
        return view('customer.collection.index');
    }

    /**
     * Display the Men Collection page.
     *
     * @return \Illuminate\Http\Response
     */
    public function men_collection()
    {
        return view('customer.collection.men');
    }

    /**
     * Display the Women Collection page.
     *
     * @return \Illuminate\Http\Response
     */
    public function women_collection()
    {
        return view('customer.collection.women');
    }

    /**
     * Display the Weddings Collection page.
     *
     * @return \Illuminate\Http\Response
     */
    public function weddings_collection()
    {
        return view('customer.collection.weddings');
    }
}
