<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\CartRequest;

class CartController extends Controller
{
    /**
     * Display a customer cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.cart.index');
    }

    /**
     * Add an outfit to the cart.
     *
     * @param  \App\Http\Requests\CartRequest $request
     * @return \Illuminate\Http\Response
     */
    public function add_to_cart(CartRequest $request)
    {
        //
    }

    /**
     * Remove an outfit from the cart.
     *
     * @param  \App\Http\Requests\CartRequest $request
     * @return \Illuminate\Http\Response
     */
    public function remove_from_cart(CartRequest $request)
    {
        //
    }

    /**
     * Empty the cart after payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function empty()
    {
        //
    }
}
