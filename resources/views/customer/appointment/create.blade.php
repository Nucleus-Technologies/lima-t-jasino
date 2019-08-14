@php
    $title = 'Book an appointment';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('banner')

    {{-- Banner Area --}}
    @include('customer.layouts.partials._banner', [
        "banner_content" => "<h2>" .$title. "</h2>
            <div class='page_link'>
                <a href=" .route('home').">Home</a>
                <a href=" .route('appointment.create'). ">" .$title. "</a>
            </div>
        "
    ])

@endsection

@section('content')

    {{-- Tracking Box Area --}}
    <section class="tracking_box_area p_120">
        <div class="container">
            <h2 class="text-center mb-2">
                {!! _('<span class="text-primary">') .Auth::user()->full_name. _('</span>, you\'re booking an appointment.') !!}
            </h2>

            <div class="tracking_box_inner d-flex flex-column align-items-center">
                <p>You must indicate information about your appointment to allow our tailors to better program you and respond to you in the shortest time.</p>

                <form class="row book-appointment-form tracking_form mt-5" action="javascript:void(0)" method="POST" novalidate>
                    @csrf

                    <h6>Location</h6>
                    <div class="col-md-12 input-group-icon form-group mb-4">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                        </div>
                        <div class="form-select" id="default-select">
                            <select name="location" style="display: none;" required>
                                <option value="Yaoundé, Cameroon (In our Office)" selected>Yaoundé, Cameroon (In our Office)</option>
                            </select>
                            <div class="nice-select" tabindex="0">
                                <span class="current">Yaoundé, Cameroon (In our Office)</span>
                                <ul class="list">
                                    <li data-value="Yaoundé, Cameroon (In our Office)" class="option selected focus">Yaoundé, Cameroon (In our Office)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <h6>Day of appointment</h6>
                    <div class="col-md-12 input-group-icon form-group mb-4">
                        <div class="icon">
                            <i class="fas fa-calendar-day" aria-hidden="true"></i>
                        </div>
                        <input type="date" name="takes_place_the" placeholder="Choose a day..." class="single-input" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <h6>Starts at <small>--Office hours are from 8AM to 6PM</small></h6>
                    <div class="col-md-12 input-group-icon form-group mb-4">
                        <div class="icon">
                            <i class="fas fa-calendar-day" aria-hidden="true"></i>
                        </div>
                        <input type="time" name="starts_at" placeholder="Define a time..." class="single-input starts_at" min="{{ env('OPEN_TIME') }}" max="{{ env('CLOSE_TIME') }}" value="{{ env('OPEN_TIME') }}" required>
                    </div>

                    <h6>Ends at <small>--Office hours are from 8AM to 6PM</small></h6>
                    <div class="col-md-12 input-group-icon form-group mb-4">
                        <div class="icon">
                            <i class="fas fa-calendar-day" aria-hidden="true"></i>
                        </div>
                        <input type="time" name="ends_at" placeholder="Define a time..." class="single-input" min="{{ env('OPEN_TIME') }}" max="{{ env('CLOSE_TIME') }}" value="{{ env('CLOSE_TIME') }}" required>
                    </div>

                    <h6>Specifies a message to our tailors
                        <small class="badge badge-warning ml-1">--Important</small>
                    </h6>
                    <div class="col-md-12 form-group mb-4">
                        <textarea class="single-textarea" name="specified_message" placeholder="Write a large text here..." required></textarea>
                    </div>

                    <div class="col-md-12 form-group">
                        <button type="submit" class="btn submit_btn" id="btn-book-appointment">Book this appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
