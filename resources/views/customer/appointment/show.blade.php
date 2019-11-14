@php
    $title = 'My appointment of the ' .format_date($appointment->takes_place_the);
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('banner')

    {{-- Banner Area --}}
    @include('customer.layouts.partials._banner', [
        "banner_content" => "<h2>" .$title. "</h2>
            <div class='page_link'>
                <a href=" .route('home').">Home</a>
                <a href=" .route('appointment'). ">My appointments</a>
                <a href=" .route('appointment.show', $appointment). ">" .format_date($appointment->takes_place_the). "</a>
            </div>
        "
    ])

@endsection

@section('content')

    {{-- Tracking Box Area --}}
    <section class="tracking_box_area p_120">
        <div class="container">
            <h2 class="text-center mb-2">
                Your appointment and conversations with our managers about this appointment.
            </h2>

            <div class="tracking_box_inner d-flex flex-column align-items-center mb-5">
                <p class="text-center">Your answer will no longer be allowed if your appointment has been marked as done by our administrators.</p>

                <div class="row mt-5 w-100">
                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="card bg-dark">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-icon text-white-50 text-center">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="card-content">
                                    <p class="card-text mb-2">
                                        <span class="text-warning text-uppercase">Take place at</span>
                                    </p>

                                    <h3 class="card-title mb-0 text-white">{{ $appointment->location }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="card bg-dark">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-icon text-white-50 text-center">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                                <div class="card-content">
                                    <p class="card-text mb-2">
                                        <span class="text-warning text-uppercase">On the</span>
                                    </p>

                                    <h3 class="card-title mb-0 text-white">{{ format_date($appointment->takes_place_the) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 mb-4 mb-md-0">
                        <div class="card bg-dark">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-icon text-white-50 text-center">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="card-content">
                                    <p class="card-text mb-2">
                                        <span class="text-warning text-uppercase">Time</span>
                                    </p>

                                    <h3 class="card-title mb-0 text-white">
                                        From <span class="text-uppercase">{{ format_time($appointment->starts_at) }}</span>
                                        To <span class="text-uppercase">{{ format_time($appointment->ends_at) }}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 offset-md-4 mb-4 mb-md-0">
                        <div class="card bg-{{ ($appointment->done) ? 'success' : 'danger' }}">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-icon text-white-50 text-center">
                                    <i class="fas fa-{{ ($appointment->done) ? 'check' : 'times' }}-circle"></i>
                                </div>
                                <div class="card-content">
                                    <p class="card-text mb-2">
                                        <span class="text-white-50 text-bold text-uppercase">State</span>
                                    </p>

                                    <h3 class="card-title mb-0 text-white">
                                        <span class="text-uppercase">{{ format_done($appointment->done) }}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row mt-5 justify-content-center">
                <div class="col-12 col-md-8">
                    <h2>You've left a message:</h2>
                    <p class="lead mt-3">
                        {!! back_to_line($appointment->specified_message) !!}
                    </p>
                </div>
            </div>

            <div class="row mt-5 justify-content-center">
                <div class="col-12 col-md-8">
                    @if ($messages->isEmpty())
                        <h2>No replies from the managers for the moment.</h2>
                    @else
                        <h2 class="mb-4">Conversation</h2>

                        @foreach ($messages as $message)
                            <div class="message w-100 mt-4" id="{{ _('msg') . $message->id }}">
                                <h3 class="message-from mb-3">
                                    <span @if ($message->origin == 'admin') class="text-primary" @endif()>
                                        {{ id_to_author_msg($message->from, $message->origin) }}
                                    </span>,
                                    <small>{{ format_date($message->created_at) }} at {{ format_time($message->created_at) }}</small>
                                </h3>
                                <p class="message-content lead mb-0">
                                    {!! back_to_line($message->answered_message) !!}
                                </p>
                            </div>
                        @endforeach

                        @if (!$appointment->done)
                            <h2 class="mb-4 mt-5">Leave a message to the managers</h2>

                            <form method="POST" action="javascript:void(0)" class="answer-appointment-form mt-5">
                                @csrf

                                <input type="hidden" id="id" value="{{ crypt_id($appointment->id) }}">
                                <div class="form-group @error('answered-message') has-danger @enderror">
                                    <textarea name="answered_message" class="single-textarea @error('answered-message') is-invalid @enderror" rows="9" id="input-answered-message" placeholder="Write a large text here...">{{ old('answered-message') }}</textarea>

                                    @error('answered-message')
                                        <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn submit_btn float-right" id="btn-appointment-reply"><i class="fas fa-reply"></i> REPLY</button>
                                </div>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
