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
        $men_outfits = Outfit::orderBy('created_at', 'desc')
            ->where('category', 'men')
            ->offset(0)->limit(10)
            ->get();
        $women_outfits = Outfit::orderBy('created_at', 'desc')
            ->where('category', 'women')
            ->offset(0)->limit(10)
            ->get();

        return view('customer.home', compact('men_outfits', 'women_outfits'));
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
