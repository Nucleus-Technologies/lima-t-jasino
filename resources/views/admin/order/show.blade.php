@php
    $title = 'Order Number/Ref.' . $order->ref
@endphp

@extends('admin.layouts.app', ['title' => $title])

@section('content')

    @include('admin.layouts.partials._nav_content', ['title' => $title])

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Order Number/Ref.</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $order->ref }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-tag"></i>
                                        </div>
                                    </div>

                                    <p class="mt-2 mb-0 pl-3">
                                        @isset($order->payment)
                                            <span class="badge badge-pill badge-success text-uppercase">
                                                <i class="fas fa-check-circle mr-1"></i> Paid
                                            </span>
                                        @else
                                            <span class="badge badge-pill badge-danger text-uppercase">
                                                <i class="fas fa-times-circle mr-1"></i> Not Paid
                                            </span>
                                        @endisset
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Date</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ format_date($order->payment->created_at) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total</h5>
                                        <span class="h2 font-weight-bold mb-0">@convert(total_o($order->id))</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Payment method</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ format_payment_mode($order->payment->payment_mode) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">

        <div class="row mt-5">

            <div class="col-lg-12 mb-5 order-infos">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Order Informations</h3>
                            </div>
                            <div class="col mt-3 mt-sm-0">
                                <span class="badge badge-pill badge-dark float-lg-right">
                                    Added on {{ format_date($order->created_at) }} at {{ format_time($order->created_at) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-6">
                                <div class="card card-stats bg-default mr-3 mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-white-50 mb-0">Billing Address</h5>

                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <strong class="text-success">{{ $order->address->full_name }}</strong>
                                                        <span class="first">{{ $order->address->email }}</span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="first">Zone: <strong>{{ ucfirst($order->address->zone) }}</strong></span>
                                                        <span class="first">Country: <strong>{{ $order->address->country }}</strong></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="first">Phone Number(s):</span>
                                                        <strong>
                                                            {{ $order->address->phone1 }} @isset($order->address->phone2) / {{ $order->address->phone2 }} @endisset
                                                        </strong>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="first">Address Line(s):</span>
                                                        <strong>
                                                            {{ $order->address->addressline1 }} @isset($order->address->addressline2) | {{ $order->address->addressline2 }} @endisset
                                                        </strong>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="first">Region & City:</span>
                                                        <strong>{{ $order->address->region->label . ', ' . $order->address->city->label }}</strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mt-3">
                                <div class="card card-stats bg-default mr-3 mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-white-50 mb-0">Shipping Address</h5>

                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <span class="first">Region & City:</span>
                                                        <strong>{{ $order->relaypoint->region->label . ', ' . $order->relaypoint->city->label }}</strong>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="first">Relay Point:</span>
                                                        <strong>{{ $order->relaypoint->label }}</strong>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="first">Near:</span>
                                                        <strong>{{ $order->relaypoint->near }}</strong>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="first">Address:</span>
                                                        <strong>{{ $order->relaypoint->address }}</strong>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="first">Relay Point Contact:</span>
                                                        <strong>{{ $order->relaypoint->contact }}</strong>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <span class="first">Opening Hours:</span>
                                                        <strong>{{ $order->relaypoint->opening_hours }}</strong>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="card shadow">
                                    <div class="card-header border-0">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="mb-0">Order Details</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive table-order-details">
                                        <div>
                                            <table class="table align-items-center">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Product</th>
                                                        <th scope="col" class="text-center">Quantity</th>
                                                        <th scope="col" class="text-right">Total</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($order->orderlines as $orderline)
                                                        <tr>
                                                            <td>
                                                                <p>{{ $orderline->outfit->name }}</p>
                                                            </td>
                                                            <td>
                                                                <h5 class="text-center">x {{ show2digits($orderline->quantity) }}</h5>
                                                            </td>
                                                            <td>
                                                                <p class="text-right">@convert($orderline->total_price)</p>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td> <h4>Subtotal</h4> </td>
                                                        <td> <h5></h5> </td>
                                                        <td>
                                                            <p class="h2 text-right">@convert(subtotal_o($order->id))</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <h4>Shipping</h4> </td>
                                                        <td> <h5></h5> </td>
                                                        <td>
                                                            <p class="h2 text-right">@convert(shipping_cost($order->relaypoint->id))</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> <h4>TOTAL</h4> </td>
                                                        <td> <h5></h5> </td>
                                                        <td>
                                                            <p class="h1 text-bold text-right">@convert(total_o($order->id))</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('admin.layouts.partials._footer')

    </div>

@endsection
