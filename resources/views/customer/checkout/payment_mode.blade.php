@php
    $title = 'Payment Mode | Payment Checkout';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('content')
    {{-- Checkout Area --}}
	<section class="checkout_area section_gap">
		<div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <h4 class="text-uppercase mb-3">Payment Mode</h4>

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
                        <h5 class="card-header d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-truck-loading mr-2"></i>Delivery Method
                                <i class="fas fa-check-circle done"></i>
                            </span>

                            <a href="{{ route('payment.checkout.delivery_method') }}" class="main_btn btn-sm text-uppercase">
                                <i class="fas fa-pencil-alt mr-1"></i> Change the relay point
                            </a>
                        </h5>

                        <div class="card-body">
                            <div class="mb-3 row">
                                <h4 class="col-12 mb-0 text-uppercase">
                                    <span><i class="fas fa-map-pin mr-2"></i> Your relay point:</span>
                                </h4>
                            </div>

                            <div class="px-4 py-3 bg-light row ml-0 mr-0">
                                <div class="col-12">
                                    <strong class="h6 active rp-label">
                                        {{ $relayPoint->label }}
                                    </strong>
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
                        </div>
                    </div>

                    <div class="card mb-3">
                        <h5 class="card-header"><i class="fas fa-money-bill-alt mr-2"></i> Payment Mode</h5>
                        <div class="card-body">
                            <form action="{{ route('payment.checkout.payment_mode.store') }}" method="POST" class="payment-mode-form">
                                @csrf

                                <h3>Choose a payment mode for your order ({{ ucfirst($address->zone) }}).</h3>

                                @if ($address->zone == 'national')
                                    <div class="payment_item">
                                        <div class="radion_btn">
                                            <input type="radio" id="cash-on-delivery" name="payment_mode" value="cash-on-delivery" checked>
                                            <label for="cash-on-delivery">Cash on delivery</label>
                                            <img src="{{ asset('customer/img/product/payment-mode/cash-on-delivery.jpg') }}" alt="">
                                            <div class="check"></div>

                                            <div class="radion_text cod">
                                                <p>You will pay all the costs related to your order and delivery when receiving it on delivery.</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="payment_item">
                                        <div class="radion_btn">
                                            <input type="radio" id="orange-money" name="payment_mode" value="orange-money">
                                            <label for="orange-money">Orange Money </label>
                                            <img src="{{ asset('customer/img/product/payment-mode/orange-money.png') }}" alt="">
                                            <div class="check"></div>

                                            <div class="radion_text om">
                                                <p>
                                                    <strong>Simply pay for your purchases with Orange Money.</strong> You must obtain a payment code for this:
                                                    <ol>
                                                        <li>Dial the #150*4*4#</li>
                                                        <li>Enter your Orange Money PIN.</li>
                                                        <li>You will then receive an SMS with a payment code that can be used for 15 minutes.</li>
                                                        <li>Keep this code. You will be asked to pay for your order later.</li>
                                                    </ol>
                                                </p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="payment_item">
                                        <div class="radion_btn">
                                            <input type="radio" id="momo" name="payment_mode" value="momo">
                                            <label for="momo">MTN Mobile Money </label>
                                            <img src="{{ asset('customer/img/product/payment-mode/mtn-mobile-money.jpg') }}" alt="">
                                            <div class="check"></div>

                                            <div class="radion_text momo">
                                                <p><strong>Mobile Money.</strong> Thank you for choosing MTN Mobile Money as your payment mode.</p>

                                                <div class="alert alert-warning w-75">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Check that your MTN Money mobile account is credited with the total amount of the desired order.
                                                    <hr>
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Do not close this page or interrupt your internet connection until the end of the transaction.
                                                </div>

                                                <p>Please follow the following steps to proceed with the payment:</p>
                                                <ol>
                                                    <li>Enter your MTN phone number as in the example. (Example: +237677890867)</li>
                                                    <li>Confirm your order by clicking "Proceed to Payment" (You will receive a request on your mobile).</li>
                                                    <li>Dial *126# and enter your Secret MTN Mobile Money code to confirm the payment.</li>
                                                    <li>If your payment is validated you will receive a confirmation message containing the number of your order.</li>
                                                </ol>

                                                <div class="form-group p_star">
                                                    <label for="momo_phone">Is this one, your MTN MoMo number phone? </label>
                                                    <input type="phone" class="form-control" id="momo_phone" name="momo_phone" value="{{ old('momo_phone') ?: $address->phone1 }}" pattern="[\+](2376)[0-9]{8}" required>
                                                    @error('momo_phone')
                                                        <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @else
                                    <div class="payment_item">
                                        <div class="radion_btn">
                                            <input type="radio" id="f-option5" name="payment_mode" value="paypal">
                                            <label for="f-option5">Check payments</label>
                                            <div class="check"></div>
                                        </div>
                                        <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                    </div>

                                    <div class="payment_item active">
                                        <div class="radion_btn">
                                            <input type="radio" id="f-option6" name="payment_mode" value="credit-card">
                                            <label for="f-option6">Paypal </label>
                                            <img src="img/product/single-product/card.jpg" alt="">
                                            <div class="check"></div>
                                        </div>
                                        <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                    </div>
                                @endif

                                <div class="text-center">
                                    <button type="submit" class="main_btn text-uppercase w-100" id="btn-proceed-payment">
                                        Proceed to Payment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4" id="order_inner">
                    @include('customer.layouts.partials.checkout._order_inner')
                </div>
            </div>
		</div>
	</section>
@endsection
