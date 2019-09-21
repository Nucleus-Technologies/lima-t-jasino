@php
    $title = 'Customer Orders'
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
                                        <h5 class="card-title text-uppercase text-muted mb-0">Orders</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ show2digits($orders->count()) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-user-tag"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-primary mr-2"><i class="fas fa-plus"></i> {{ total_week('order', 1) }}</span>
                                    <span class="text-nowrap">Last week</span> <br>

                                    <span class="text-primary mr-2"><i class="fas fa-plus"></i> {{ total_week('order', 0) }}</span>
                                    <span class="text-nowrap">This week</span> <br>

                                    @if (stat_week_pcent('order', 0) < stat_week_pcent('order', 1))
                                        <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> {{ stat_week_pcent('order', 0) }}%</span>
                                    @else
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ stat_week_pcent('order', 0) }}%</span>
                                    @endif
                                    <span class="text-nowrap">This week</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">

        <div class="row">

            <div class="col-lg-12 mb-5 mb-xl-0 mt-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">All customer orders.</h3>
                            </div>
                            @if (!$orders->isEmpty())
                                <div class="col">
                                    <div class="form-group w-75 m-0 float-right">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                            </div>
                                            <input class="form-control" id="order-search" placeholder="Search by customer, by ref., by mode, ..." type="text">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($orders->isEmpty())
                        <div class="alert alert-primary mb-0" role="alert">
                            <strong>Info!</strong> There's no customer order for the moment!
                        </div>
                    @else
                        <div class="table-responsive table-appointments">
                            <div>
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Order Number/Ref.</th>
                                            <th scope="col">Payment Mode</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Date</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody class="list" id="order-list">
                                        @foreach ($orders as $order)
                                            <tr>
                                                <th scope="row" class="full_name">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <strong class="mb-0 text-sm">
                                                                {{ $order->address->full_name }}
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </th>

                                                <th scope="row" class="ref">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <strong class="mb-0 text-sm">
                                                                {{ $order->ref }}
                                                            </strong>

                                                            @isset($order->payment)
                                                                <label class="badge badge-pill badge-success ml-3">
                                                                    <i class="fas fa-check-circle mr-1"></i> Paid
                                                                </label>
                                                            @else
                                                                <label class="badge badge-pill badge-success ml-3">
                                                                    <i class="fas fa-times-circle mr-1"></i> Not Paid
                                                                </label>
                                                            @endisset
                                                        </div>
                                                    </div>
                                                </th>

                                                <th scope="row" class="payment_mode">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">
                                                                {{ format_payment_mode($order->payment->payment_mode) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </th>

                                                <td class="total_o">
                                                    <span class="badge badge-pill badge-primary">
                                                        @convert(total_o($order->id))
                                                    </span>
                                                </td>

                                                <td class="created_at">
                                                    <span class="badge badge-pill badge-primary">
                                                        {{ format_date($order->payment->created_at) }}
                                                    </span>
                                                </td>

                                                <td class="text-right">
                                                    <a class="btn btn-sm btn-icon-only" href="{{ route('admin.order.show', $order->id) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>

        @include('admin.layouts.partials._footer')

    </div>

@endsection
