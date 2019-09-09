<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Traits\AddOutfitToCart;
use App\Http\Controllers\Traits\RemoveOutfitFromCart;

class CartController extends Controller
{
    use AddOutfitToCart;
    use RemoveOutfitFromCart;

    /**
     * Display a customer cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {
            $cart = Auth::user()->cart()->where('source', 'in')->get();
        } else {
            $user = Cookie::get('user');

            if (isset($user)) {
                $cart = Session::find($user)->cart()->where('source', 'out')->get();
            } else {
                $user = make_cookie_session();

                $cart = Session::find($user)->cart()->where('source', 'out')->get();
            }
        }

        return view('customer.cart.index', compact('cart'));
    }

    /**
     * Update the quantity of an outfit of the cart.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update_quantity(Request $request)
    {
        $request->validate([
            'cart' => 'required|integer',
            'quantity' => 'required|integer'
        ]);

        if(Auth::check()) {
            $cart = Auth::user()->cart()
                ->find(decrypt_id($request->cart))
                ->update(['quantity' => $request->quantity]);
        } else {
            $user = Cookie::get('user');

            $cart = Session::find($user)->cart()
                ->find(decrypt_id($request->cart))
                ->update(['quantity' => $request->quantity]);
        }

        $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

        if ($cart) {
            $response = ['msg' => 'Well updated!', 'status' => true];
        }

        return response()->json($response);
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

    /**
     * Refresh the cart inner.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        if(Auth::check()) {
            $cart = Auth::user()->cart()->where('source', 'in')->get();
        } else {
            $user = Cookie::get('user');

            $cart = Session::find($user)->cart()->where('source', 'out')->get();
        }

        return view('customer.layouts.partials._cart_inner', compact('cart'));
    }

    /**
     * Refresh the icon cart inner.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh_icon()
    {
        return view('customer.layouts.partials._cart_icon');
    }
}
