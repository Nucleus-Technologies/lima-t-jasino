@php
    $title = 'Order Confirmation | Payment Checkout';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('content')
    {{-- Order Details Area --}}
	<section class="order_details checkout_confirmation mt-5 p_120">
        <div class="container">
            <h3 class="title_confirmation bg-success">
                <i class="fas fa-check-circle mr-2"></i>
                Thank you. Your order has been received.
            </h3>
            <div class="row order_d_inner">
                <div class="col-lg-4">
                    <div class="details_item">
                        <h4>Order Info</h4>
                        <ul class="list">
                            <li>
                                <span class="first">Order Number/Ref.</span> <strong>{{ $order->ref }}</strong>
                            </li>
                            <li>
                                <span class="first">Date:</span> <strong>{{ format_date($payment->created_at) }}</strong>
                            </li>
                            <li>
                                <span class="first">Total:</span> <strong>@convert(total_o($order->id))</strong>
                            </li>
                            <li>
                                <span class="first">Payment method:</span> <strong>{{ format_payment_mode($payment->payment_mode) }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="details_item">
                        <h4>Billing Address</h4>
                        <ul class="list">
                            <li>
                                <strong class="text-success">{{ $order->address->full_name }}</strong>
                                <span class="first">{{ $order->address->email }}</span>
                            </li>
                            <li>
                                <span class="first">Zone: <strong>{{ ucfirst($order->address->zone) }}</strong></span>
                                <span class="first">Country: <strong>{{ $order->address->country }}</strong></span>
                            </li>
                            <li>
                                <span class="first">Phone Number(s):</span>
                                <strong>
                                    {{ $order->address->phone1 }} @isset($order->address->phone2) / {{ $order->address->phone2 }} @endisset
                                </strong>
                            </li>
                            <li>
                                <span class="first">Address Line(s):</span>
                                <strong>
                                    {{ $order->address->addressline1 }} @isset($order->address->addressline2) | {{ $order->address->addressline2 }} @endisset
                                </strong>
                            </li>
                            <li>
                                <span class="first">Region & City:</span>
                                <strong>{{ $order->address->region->label . ', ' . $order->address->city->label }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="details_item">
                        <h4>Shipping Address</h4>
                        <ul class="list">
                            <li>
                                <span class="first">Region & City:</span>
                                <strong>{{ $order->relaypoint->region->label . ', ' . $order->relaypoint->city->label }}</strong>
                            </li>
                            <li>
                                <span class="first">Relay Point:</span>
                                <strong>{{ $order->relaypoint->label }}</strong>
                            </li>
                            <li>
                                <span class="first">Near:</span>
                                <strong>{{ $order->relaypoint->near }}</strong>
                            </li>
                            <li>
                                <span class="first">Address:</span>
                                <strong>{{ $order->relaypoint->address }}</strong>
                            </li>
                            <li>
                                <span class="first">Relay Point Contact:</span>
                                <strong>{{ $order->relaypoint->contact }}</strong>
                            </li>
                            <li>
                                <span class="first">Opening Hours:</span>
                                <strong>{{ $order->relaypoint->opening_hours }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="order_details_table">
                <h2>Order Details</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-bold" scope="col">Product</th>
                                <th class="text-bold" scope="col">Quantity</th>
                                <th class="text-bold" scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderlines as $orderline)
                                <tr>
                                    <td>
                                        <p class="w-75">{{ $orderline->outfit->name }}</p>
                                    </td>
                                    <td>
                                        <h5>x {{ show2digits($orderline->quantity) }}</h5>
                                    </td>
                                    <td>
                                        <p>@convert($orderline->total_price)</p>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td> <h4>Subtotal</h4> </td>
                                <td> <h5></h5> </td>
                                <td>
                                    <p class="h6">@convert(subtotal_o($order->id))</p>
                                </td>
                            </tr>
                            <tr>
                                <td> <h4>Shipping</h4> </td>
                                <td> <h5></h5> </td>
                                <td>
                                    <p class="h6">@convert(shipping_cost($order->relaypoint->id))</p>
                                </td>
                            </tr>
                            <tr>
                                <td> <h4>Total</h4> </td>
                                <td> <h5></h5> </td>
                                <td>
                                    <p class="text-bold h5">@convert(total_o($order->id))</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
