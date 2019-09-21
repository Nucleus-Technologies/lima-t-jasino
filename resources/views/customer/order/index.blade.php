@php
    $title = 'My Orders';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('banner')

    {{-- Banner Area --}}
    @include('customer.layouts.partials._banner', [
        "banner_content" => "<h2>" .$title. "</h2>
            <div class='page_link'>
                <a href=" .route('home').">Home</a>
                <a href=" .route('order'). ">" .$title. "</a>
            </div>
        "
    ])

@endsection

@section('content')

    {{-- Tracking Box Area --}}
    <section class="tracking_box_area p_120">
        <div class="container">
            <h2 class="text-center mb-2">
                Here are all the orders you've done on our site.
            </h2>

            <div class="tracking_box_inner d-flex flex-column align-items-center">
                <p>The most recent are at the top of the list.</p>

                <div class="row mt-5 w-100 justify-content-center align-items-center">
                    @if ($orders->isEmpty())
                        <div class="col-12">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-xl-6">
                                    <div class="card text-white bg-primary">
                                        <div class="card-body">
                                            <h3 class="card-title">You have not yet placed an order!</h3>
                                            <p class="card-text mb-3 text-white">It's possible for you to do it now.</p>
                                            <a href="{{ route('outfit.shop') }}" class="btn btn-light text-uppercase">Let's go to the shop</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach ($orders as $order)
                            <div class="col-sm-4 mb-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">
                                            Order Number/Ref. <span class="text-primary">{{ $order->ref }}</span>

                                            @isset($order->payment)
                                                <span class="badge badge-pill badge-success badge-lg text-uppercase pull-right">Paid</span>
                                            @else
                                                <span class="badge badge-pill badge-danger badge-lg text-uppercase pull-right">Not Paid</span>
                                            @endisset
                                        </h5>

                                        <hr>

                                        <p class="card-text mb-2">
                                            On the <span class="badge badge-pill badge-dark badge-lg ml-1">{{ format_date($order->created_at) }}</span>
                                        </p>
                                        <p class="card-text mb-2">
                                            At <span class="badge badge-pill badge-dark badge-lg text-uppercase ml-1">{{ format_time($order->created_at) }}</span>
                                        </p>

                                        <hr>

                                        <p class="card-text mb-2">
                                            Subtotal <span class="badge badge-pill badge-dark badge-lg text-uppercase ml-1">@convert(subtotal_o($order->id))</span>
                                        </p>
                                        <p class="card-text mb-2">
                                            Shipping <span class="badge badge-pill badge-dark badge-lg text-uppercase ml-1">@convert(shipping_cost($order->relaypoint->id))</span>
                                        </p>
                                        <p class="card-text mb-2">
                                            Total <span class="badge badge-pill badge-dark badge-lg text-uppercase ml-1">@convert(total_o($order->id))</span>
                                        </p>

                                        <hr>

                                        <a href="{{ route('order.show', $order) }}" class="main_btn btn-sm">Show more about this</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
