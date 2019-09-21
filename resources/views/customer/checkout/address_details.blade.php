@php
    $title = 'Address Details | Payment Checkout';
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
                        <h5 class="card-header"><i class="fas fa-address-card mr-2 active"></i>Address Details</h5>

                        <div class="card-body">
                            @if ($addresses->isEmpty())
                                @include('customer.layouts.partials.checkout._new_address')
                            @else
                                <form class="row ml-0 mr-0 contact_form choose-address-details-form" action="{{ route('payment.checkout.address_details.chosen') }}" method="POST">
                                    @csrf

                                    <div class="address_choice">
                                        <div class="row">
                                            <div class="col-12 mb-2 d-flex justify-content-lg-between align-items-center">
                                                <h3>Choose one of your addresses.</h3>
                                                <button type="button" class="main_btn btn-sm text-uppercase" data-toggle="modal" data-target="#new-address-modal" data-backdrop="static">
                                                    <i class="fas fa-plus-circle mr-1"></i> Add a new address
                                                </button>
                                            </div>

                                            <div class="col-12 ml-4 mb-0 form-group row">
                                                @foreach ($addresses as $address)
                                                    <div class="radion_btn col-12 col-md-6">
                                                        <input type="radio" id="addr-{{ $address->id }}" name="address" value="{{ $address->id }}" class="address-item">
                                                        <label for="addr-{{ $address->id }}">
                                                            <p>
                                                                <strong>{{ $address->full_name . ', ' . $address->email }}</strong> <br>
                                                                {{ $address->country . ', ' . $address->region->label . ', ' . $address->city->label }} <br>
                                                                {{ $address->phone1 }} {{ isset($address->phone2) ? ' / ' . $address->phone2 : '' }} <br>
                                                                {{ $address->addressline1 }} {{ isset($address->addressline2) ? ' | ' . $address->addressline2 : '' }} <br>
                                                                {{ $address->zip }}
                                                            </p>
                                                        </label>
                                                        <div class="check"></div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="modal fade" id="new-address-modal" tabindex="-1" role="dialog" aria-labelledby="new-address-modal-title" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="new-address-modal-title">New address to my address book.</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @include('customer.layouts.partials.checkout._new_address')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card mb-3">
                        <h5 class="card-header"><i class="fas fa-truck-loading mr-2"></i>Delivery Method</h5>
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
