@php
    $title = 'Product Checkout';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('banner')

    {{-- Banner Area --}}
    @include('customer.layouts.partials._banner', [
        "banner_content" => "<h2>" .$title. "</h2>
            <div class='page_link'>
                <a href=" .route('home').">Home</a>
                <a href=" .route('checkout'). ">" .$title. "</a>
            </div>
        "
    ])

@endsection

@section('content')

    {{-- Checkout Area --}}
	<section class="checkout_area section_gap">
		<div class="container">
            <div class="checkout_info row justify-content-center align-items-center mb-5 bg-dark text-white">
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

            <div class="ordering_zone mb-4">
                <div class="row">
                    <h3 class="col-12">Ordering Zone</h3>

                    <div class="col-12 form-group d-flex flex-column flex-sm-row">
                        <div class="radion_btn">
                            <input type="radio" id="national-zone" name="zone" value="national-zone" checked>
                            <label for="national-zone">National </label>
                            <div class="check"></div>
                        </div>
                        <div class="radion_btn">
                            <input type="radio" id="international-zone" name="zone" value="international-zone">
                            <label for="international-zone">International </label>
                            <div class="check"></div>
                        </div>
                    </div>
                </div>
            </div>

			<div class="billing_details" id="billing_details">
				@include('customer.layouts.partials._national_details')
			</div>
		</div>
	</section>

@endsection
