@php
    $title = 'My appointments';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('banner')

    {{-- Banner Area --}}
    @include('customer.layouts.partials._banner', [
        "banner_content" => "<h2>" .$title. "</h2>
            <div class='page_link'>
                <a href=" .route('home').">Home</a>
                <a href=" .route('appointment'). ">My appointments</a>
            </div>
        "
    ])

@endsection

@section('content')

    {{-- Tracking Box Area --}}
    <section class="tracking_box_area p_120">
        <div class="container">
            <h2 class="text-center mb-2">
                Here are all the appointments you've booked to our office.
            </h2>

            <div class="tracking_box_inner d-flex flex-column align-items-center">
                <p>The most recent are at the top of the list.</p>

                <div class="row mt-5">
                    @foreach ($appointments as $appointment)
                        <div class="col-sm-6 mb-5">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">
                                        Take place at
                                        <span class="text-primary">{{ $appointment->location }}</span>
                                        @if ($appointment->done)
                                            <span class="float-right badge badge-success">DONE</span>
                                        @else
                                            <span class="float-right badge badge-danger">NOT DONE</span>
                                        @endif
                                    </h5>

                                    <hr>

                                    <p class="card-text mb-2">
                                        On the
                                        <span class="badge badge-pill badge-dark badge-lg">{{ formatDate($appointment->takes_place_the) }}</span>
                                    </p>

                                    <p>
                                        From <span class="badge badge-pill badge-dark badge-lg text-uppercase">
                                            {{ formatTime($appointment->starts_at) }}</span>
                                        To <span class="badge badge-pill badge-dark badge-lg text-uppercase">
                                            {{ formatTime($appointment->ends_at) }}</span>
                                    </p>
                                    <hr>
                                    <p>
                                        {!! backToLine(formatMessage($appointment->specified_message, 150)) !!}
                                    </p>
                                    <a href="{{ route('appointment.show', $appointment) }}" class="main_btn btn-sm">Show more about this</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection
