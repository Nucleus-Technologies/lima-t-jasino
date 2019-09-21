@php
    $title = 'Delivery Method | Payment Checkout';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('content')
    {{-- Checkout Area --}}
	<section class="checkout_area section_gap">
		<div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <h4 class="text-uppercase mb-3">Payment Checkout</h4>

                    <div class="card mb-3">
                        <h5 class="card-header d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-address-card mr-2"></i>Address Details
                                <i class="fas fa-check-circle done"></i>
                            </span>

                            <a href="{{ route('payment.checkout.address_details') }}" class="main_btn btn-sm text-uppercase">
                                <i class="fas fa-pencil-alt mr-1"></i> Change the address
                            </a>
                        </h5>

                        <div class="card-body">
                            <p>
                                <strong><i class="fas fa-user mr-2"></i>{{ $address->full_name . ', ' . $address->email }}</strong> <br>
                                <i class="fas fa-map-marker-alt mr-2"></i>{{ $address->country . ', ' . $address->region->label . ', ' . $address->city->label }} <br>
                                <i class="fas fa-phone mr-2"></i>{{ $address->phone1 }} {{ isset($address->phone2) ? ' / ' . $address->phone2 : '' }} <br>
                                <i class="fas fa-street-view mr-2"></i>{{ $address->addressline1 }} {{ isset($address->addressline2) ? ' | ' . $address->addressline2 : '' }} <br>
                            </p>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <h5 class="card-header"><i class="fas fa-truck-loading mr-2 active"></i>Delivery Method</h5>

                        <div class="card-body">
                            <h4 class="text-uppercase">How do you want your order to be delivered?</h4> <hr>

                            <form action="{{ route('payment.checkout.delivery_method.store') }}" method="POST" class="save-order-form">
                                @csrf
                                <input type="hidden" name="address" value="{{ $address->id }}">

                                <div class="mb-3 row">
                                    <h4 class="col-12 col-md-2 mb-3">
                                        <span><i class="fas fa-map-pin mr-2"></i> Your relay point:</span>
                                    </h4>

                                    <div class="col-12 col-md-4 form-group p_star">
                                        <label for="region">Region </label>
                                        <select name="region" class="custom-select" required>
                                            <option value="{{ $relayPoint->region->id }}" selected>{{ $relayPoint->region->label }}</option>
                                        </select>
                                        @error('region')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-6 form-group p_star">
                                        <label for="city">Town/City </label>
                                        <select name="city" class="custom-select" id="city" required>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" @if ($city->id == $address->city->id) selected @endif>{{ $city->label }}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="px-4 py-3 bg-light row ml-0 mr-0" id="relaypoint_details">
                                    <div class="col-12 radion_btn">
                                        <input type="radio" id="relaypoint" name="relaypoint" value="{{ $relayPoint->id }}" class="relaypoint-item">
                                        <label for="relaypoint">
                                            <strong class="h6 active rp-label">
                                                {{ $relayPoint->label }}
                                            </strong>
                                        </label>
                                        <div class="check ml-3"></div>
                                    </div>
                                    <p class="col-12 col-md-6">
                                        Near <br>
                                        <span class="text-dark rp-near">{{ $relayPoint->near }}</span>
                                    </p>
                                    <p class="col-12 col-md-6">
                                        Address <br>
                                        <span class="text-dark rp-address">{{ $relayPoint->address }}</span>
                                    </p>
                                    <p class="col-12 col-md-6">
                                        Relay point Contact <br>
                                        <span class="text-dark rp-contact">{{ $relayPoint->contact }}</span>
                                    </p>
                                    <p class="col-12 col-md-6">
                                        Opening Hours <br>
                                        <span class="text-dark rp-opening-hours">{{ $relayPoint->opening_hours }}</span>
                                    </p>
                                    <p class="col-12 col-md-6 mb-0 text-bold">
                                        <span class="text-warning">Shipping Cost</span> <br>
                                        <span class="text-dark rp-shipping-cost">@convert($relayPoint->shipping_cost)</span>
                                    </p>
                                </div>

                                <div class="mt-5 text-center">
                                    <button type="submit" class="main_btn text-uppercase w-100" id="btn-save-order" disabled>
                                        Let's go ahead
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <h5 class="card-header"><i class="fas fa-money-bill-alt mr-2"></i> Payment Mode</h5>
                    </div>
                </div>

                <div class="col-12 col-md-4" id="order_inner">
                    @include('customer.layouts.partials.checkout._order_inner')
                </div>
            </div>
		</div>
	</section>
@endsection
