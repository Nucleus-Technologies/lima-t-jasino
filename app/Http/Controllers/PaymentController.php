<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of all payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created payment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_mode' => 'required|string'
        ]);

        $order = Auth::user()->orders()->where('current', 1)->first();

        $exists = Payment::where('order_id', $order->id)->first();

        $payment = null;

        if ($exists) {
            $payment = Payment::where('order_id', $order->id)->update([
                'payment_mode' => $request->payment_mode
            ]);
        } else {
            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_mode' => $request->payment_mode
            ]);
        }

        if ($payment) {
            $response = ['msg' => 'Payment successfully registered!', 'status' => true];

            Auth::user()->orders()->where('current', 1)->update([
                'current' => 0
            ]);

            Auth::user()->addresses()->where('current', 1)->update([
                'current' => 0
            ]);

            $notification = new NotificationController;
            $notification->store([
                'type' => 'admin',
                'about' => 'order_payment',
                'to' => 1,
                'item' => $payment->id,
                'read' => 0
            ]);

            Auth::user()->cart()->where('source', 'in')->delete();

            flash($response['msg'])->success()->important();
        } else {
            $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

            flash($response['msg'])->error()->important();
        }

        return redirect()->route('payment.checkout.confirmation', ['order' => $order->id, 'payment' => $payment->id]);
    }

    /**
     * Display the specified payment.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Remove the specified payment from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
