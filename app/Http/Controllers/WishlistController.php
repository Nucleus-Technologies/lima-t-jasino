<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class WishlistController extends Controller
{
    /**
     * Display the wishlist of a customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {
            $wishlist = Auth::user()->wishlist()->where('source', 'in')->get();
        } else {
            $user = Cookie::get('user');

            if (isset($user)) {
                $wishlist = Session::find($user)->wishlist()->where('source', 'out')->get();
            } else {
                $user = make_cookie_session();

                $wishlist = Session::find($user)->wishlist()->where('source', 'out')->get();
            }
        }

        return view('customer.wishlist.index', compact('wishlist'));
    }

    /**
     * Store an outfit to the wishlist of a customer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $outfit = decrypt_id($request->outfit);

        if(Auth::check()) {
            $user = Auth::user()->id;

            $verif = Auth::user()->wishlist()->where('outfit', $outfit)->where('source', 'in')->first();
        } else {
            $user = Cookie::get('user');

            if (isset($user)) {
                $verif = Session::find($user)->wishlist()->where('outfit', $outfit)->where('source', 'out')->first();
            } else {
                $user = make_cookie_session();

                $verif = Session::find($user)->wishlist()->where('outfit', $outfit)->where('source', 'out')->first();
            }
        }

        if (isset($verif)) {
            $response = ['msg' => 'This outfit is already in your wishlist!', 'status' => true];
        } else {
            $wishlist = Wishlist::create([
                'user' => $user,
                'outfit' => $outfit,
                'source' => (Auth::check()) ? 'in' : 'out'
            ]);

            $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

            if ($wishlist) {
                $response = ['msg' => 'Outfit well added in your wishlist!', 'status' => true];
            }
        }

        return response()->json($response);
    }

    /**
     * Remove an specified outfit from the wishlist of a customer.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'wishlist' => 'required|integer'
        ]);

        $wl = decrypt_id($request->wishlist);

        if(Auth::check()) {
            $wishlist = Auth::user()->wishlist()->find($wl)->delete();
        } else {
            $user = Cookie::get('user');

            $wishlist = Session::find($user)->wishlist()->find($wl)->delete();
        }

        $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

        if ($wishlist) {
            $response = ['msg' => 'Well removed!', 'status' => true];
        }

        return response()->json($response);
    }


    /**
     * Refresh the wishlist inner.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        if(Auth::check()) {
            $wishlist = Auth::user()->wishlist()->where('source', 'in')->get();
        } else {
            $user = Cookie::get('user');

            $wishlist = Session::find($user)->wishlist()->where('source', 'out')->get();
        }

        return view('customer.layouts.partials._wishlist_inner', compact('wishlist'));
    }
}
