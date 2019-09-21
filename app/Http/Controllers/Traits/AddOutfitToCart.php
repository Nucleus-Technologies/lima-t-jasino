<?php

namespace App\Http\Controllers\Traits;

use App\Models\Cart;
use App\Models\Session;
use App\Http\Requests\CartRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

/**
 * Returns outfits after searching options
 */
trait AddOutfitToCart
{
    /**
     * Add an outfit to the cart.
     *
     * @param  \App\Http\Requests\CartRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        $outfit = decrypt_id($request->outfit);

        if(Auth::check()) {
            $verif = Auth::user()->cart()->where('outfit_id', $outfit)->where('source', 'in')->first();
        } else {
            $user = Cookie::get('user');

            if (isset($user)) {
                $verif = Session::find($user)->cart()->where('outfit_id', $outfit)->where('source', 'out')->first();
            } else {
                $user = make_cookie_session();

                $verif = Session::find($user)->cart()->where('outfit_id', $outfit)->where('source', 'out')->first();
            }
        }

        if (isset($verif)) {
            if(Auth::check()) {
                $cart = Auth::user()->cart()
                    ->where('outfit_id', $outfit)
                    ->where('source', 'in')
                    ->increment('quantity', $request->quantity);
            } else {
                $user = Cookie::get('user');

                $cart = Session::find($user)->cart()
                    ->where('outfit_id', $outfit)
                    ->where('source', 'out')
                    ->increment('quantity', $request->quantity);
            }
        } else {
            $cart = Cart::create([
                'user_id' => (Auth::check()) ? Auth::user()->id : Cookie::get('user'),
                'outfit_id' => $outfit,
                'quantity' => $request->quantity,
                'source' => (Auth::check()) ? 'in' : 'out'
            ]);
        }

        $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

        if ($cart) {
            $response = ['msg' => 'Well added!', 'status' => true];
        }

        return response()->json($response);
    }

}
