@php
    $title = 'Payment Checkout';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('banner')

    {{-- Banner Area --}}
    @include('customer.layouts.partials._banner', [
        "banner_content" => "<h2>" .$title. "</h2>
            <div class='page_link'>
                <a href=" .route('home').">Home</a>
                <a href=" .route('cart').">Cart</a>
                <a href=" .route('payment.checkout.address_details'). ">" .$title. "</a>
            </div>
        "
    ])

@endsection

@section('content')
@include('flash::message')
    {{-- Checkout Area --}}
	<section class="checkout_area section_gap">
		<div class="container">
            <div class="checkout_info row ml-0 mr-0 justify-content-center align-items-center mb-2 bg-dark text-white">
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <i class="fas fa-phone-volume h4 mb-0 mr-2"></i>
                    <span> Need help? Call us! <a href="tel:+237655191890">+237 655 191 890</a></span>
                </div>
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <i class="fas fa-shield-alt h4 mb-0 mr-2"></i>
                    <span> Secure Payment.</span>
                </div>
                <div class="col-12 col-md-4">
                    <i class="fas fa-undo-alt h4 mb-0 mr-2"></i>
                    <span> Easy Returns.</span>
                </div>
            </div>

            <div class="processing row ml-0 mr-0 bg-dark mb-5">
                <a href="#" class="col-12 col-md-4 bg-primary">
                    <i class="fas fa-address-card h4 mb-0 mr-2"></i> Address Details
                </a>
                <a class="col-12 col-md-4">
                    <i class="fas fa-money-bill-alt h4 mb-0 mr-2"></i> Payment Mode
                </a>
                <a class="col-12 col-md-4">
                    <i class="fas fa-phone-volume h4 mb-0 mr-2"></i> Address Details
                </a>
            </div>

            <div class="row">
                <div class="col-12 col-md-8">
                    @if (!$addresses->isEmpty())
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 col-xl-6">
                                <div class="card text-white bg-primary">
                                    <div class="card-body">
                                        <h3 class="card-title mb-0">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            You have not set an address book yet!
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <form class="row ml-0 mr-0 contact_form choose-address-details-form" action="{{ route('payment.checkout.address_details.store') }}" method="post">
                            @csrf

                            <div class="address_choice mt-3 mb-4">
                                <div class="row">
                                    <h3 class="col-12">Choose one of your addresses.</h3>

                                    <div class="col-12 form-group d-flex flex-column flex-sm-row">
                                        <div class="radion_btn">
                                            <input type="radio" id="addr-1" name="address" value="1" checked>
                                            <label for="addr-1">
                                                hjfhfdhfdfgdfg <br>
                                                National
                                            </label>
                                            <div class="check"></div>
                                        </div>
                                        <div class="radion_btn">
                                            <input type="radio" id="addr-2" name="address" value="2">
                                            <label for="addr-2">International </label>
                                            <div class="check"></div>
                                        </div>

                                        @error('zone')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif

                    <div class="or-separator">
                        <span>OR</span>
                    </div>

                    <h3>Defines a new address.</h3>

                    <form class="row ml-0 mr-0 contact_form address-details-form" action="{{ route('payment.checkout.address_details.store') }}" method="post">
                        @csrf

                        <div class="ordering_zone col-12 mt-3 mb-4">
                            <div class="row">
                                <h3 class="col-12">Ordering Zone</h3>

                                <div class="col-12 form-group d-flex flex-column flex-sm-row">
                                    <div class="radion_btn">
                                        <input type="radio" id="national" name="zone" class="zone" value="national" checked>
                                        <label for="national">National </label>
                                        <div class="check"></div>
                                    </div>
                                    <div class="radion_btn">
                                        <input type="radio" id="international" name="zone" class="zone" value="international">
                                        <label for="international">International </label>
                                        <div class="check"></div>
                                    </div>

                                    @error('zone')
                                        <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="billing_details col-12" id="address_details">
                            @include('customer.layouts.partials._national_details')
                        </div>
                    </form>
                </div>

                <div class="col-12 col-md-4">
                    @include('customer.layouts.partials._order_inner')
                </div>
            </div>
		</div>
	</section>

@endsection
