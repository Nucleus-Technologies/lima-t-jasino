<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset(Auth::user()->username)) {
            $orders = Order::orderBy('created_at', 'desc')->get();

            return view('admin.order.index', compact('orders'));
        } else {
            $orders = Auth::user()->orders()->orderBy('created_at', 'desc')->get();

            return view('customer.order.index', compact('orders'));
        }
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|integer',
            'relaypoint' => 'required|integer'
        ]);

        $exists = Auth::user()->orders()->where('current', 1)->first();
        $order_ = null;

        if (isset($exists)) {
            Auth::user()->orders()->where('current', 1)->update([
                'address_id' => $request->address,
                'relaypoint_id' => $request->relaypoint,
            ]);

            $order_ = Auth::user()->orders()->where('current', 1)->first();
        } else {
            $ref = mt_rand(0000000, 9999999);
            $ref_exists = Order::where('ref', $ref)->get();

            if (isset($ref_exists)) {
                $ref_ = mt_rand(0000000, 9999999);
            }

            $order_ = Order::create([
                'ref' => $ref_,
                'user_id' => Auth::user()->id,
                'address_id' => $request->address,
                'relaypoint_id' => $request->relaypoint,
                'current' => true
            ]);

            $cart = Auth::user()->cart()->where('source', 'in')->get();

            foreach ($cart as $line) {
                OrderLine::create([
                    'order_id' => $order_->id,
                    'outfit_id' => $line->outfit_id,
                    'quantity' => $line->quantity
                ]);
            }
        }

        if ($order_) {
            $response = ['msg' => 'Order successfully registered!', 'status' => true];

            flash($response['msg'])->success()->important();
        } else {
            $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

            flash($response['msg'])->error()->important();
        }

        return redirect()->route('payment.checkout.payment_mode');
    }

    /**
     * Display the specified order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if(isset(Auth::user()->username)) {
            return view('admin.order.show', compact('order'));
        } else {
            return view('customer.order.show', compact('order'));
        }
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
