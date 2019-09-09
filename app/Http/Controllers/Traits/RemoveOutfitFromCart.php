<?php

namespace App\Http\Controllers\Traits;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

/**
 * Returns outfits after searching options
 */
trait RemoveOutfitFromCart
{
    /**
     * Remove an outfit from the cart.
     *
     * @param  \App\Http\Requests\CartRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'cart' => 'required|integer'
        ]);

        $cart = decrypt_id($request->cart);

        if(Auth::check()) {
            $cart = Auth::user()->cart()
                ->find($cart)
                ->delete();
        } else {
            $user = Cookie::get('user');

            $cart = Session::find($user)->cart()
                ->find($cart)
                ->delete();
        }

        $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

        if ($cart) {
            $response = ['msg' => 'Well removed!', 'status' => true];
        }

        return response()->json($response);
    }

}
