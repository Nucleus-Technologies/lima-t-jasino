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

    {{-- Checkout Area --}}
	<section class="checkout_area section_gap">
		<div class="container">
            <div class="checkout_info row justify-content-center align-items-center mb-2 bg-dark text-white">
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

            <div class="processing row bg-dark mb-5">
                <a href="{{ route('payment.checkout.address_details') }}" class="col-12 col-md-4">
                    <i class="fas fa-address-card h4 mb-0 mr-2"></i> Address Details
                </a>
                <a href="#" class="col-12 col-md-4 bg-primary">
                    <i class="fas fa-money-bill-alt h4 mb-0 mr-2"></i> Payment Mode
                </a>
                <a class="col-12 col-md-4">
                    <i class="fas fa-phone-volume h4 mb-0 mr-2"></i> Address Details
                </a>
            </div>

			<div class="payment_modz" id="payment_modz">
                    <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="cash-on-delivery" name="payment_mode" value="cash-on-delivery">
                                <label for="cash-on-delivery">Cash on delivery</label>
                                <img src="{{ asset('customer/img/product/payment-mode/cash-on-delivery.jpg') }}" alt="">
                                <div class="check"></div>
                            </div>
                            <p>You will pay all the costs related to your order and delivery when receiving it on delivery.</p>
                        </div>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="orange-money" name="payment_mode" value="orange-money">
                                <label for="orange-money">Orange Money </label>
                                <img src="{{ asset('customer/img/product/payment-mode/orange-money.png') }}" alt="">
                                <div class="check"></div>
                            </div>
                        </div>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="momo" name="payment_mode" value="momo">
                                <label for="momo">MTN Mobile Money </label>
                                <img src="{{ asset('customer/img/product/payment-mode/mtn-mobile-money.jpg') }}" alt="">
                                <div class="check"></div>
                            </div>
                        </div>
                <div class="payment_item">
                    <div class="radion_btn">
                        <input type="radio" id="f-option5" name="selector">
                        <label for="f-option5">Check payments</label>
                        <div class="check"></div>
                    </div>
                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                </div>

                <div class="payment_item active">
                    <div class="radion_btn">
                        <input type="radio" id="f-option6" name="selector">
                        <label for="f-option6">Paypal </label>
                        <img src="img/product/single-product/card.jpg" alt="">
                        <div class="check"></div>
                    </div>
                    <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                </div>

                <div class="d-flex mt-5 mb-3">
                    <div class="primary-checkbox mr-2">
                        <input type="checkbox" id="primary-checkbox">
                        <label for="primary-checkbox"></label>
                    </div>
                    <label for="primary-checkbox">
                        I have read and accept the <a href="#">conditions</a> and <a href="#">terms</a> of use.
                    </label>
                </div>
                <a class="main_btn" href="#">Proceed to Paypal</a>
			</div>
		</div>
	</section>

@endsection
