@php
    $title = 'Appointment View'
@endphp

@extends('admin.layouts.app', ['title' => $title])

@section('content')

    @include('admin.layouts.partials._nav_content', ['title' => $title])

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <h1 class="display-2 text-white">{{ $appointment->user->full_name }}</h1>
                <p class="text-white mt-0 mb-5">{!! $appointment->location !!}</p>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">

        <div class="row mt-5">

            <div class="col-lg-12 mb-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Appointment Informations</h3>
                            </div>
                            <div class="col mt-3 mt-sm-0">
                                <span class="badge badge-pill badge-dark float-lg-right">
                                    Added on {{ format_date($appointment->created_at) }} at {{ format_time($appointment->created_at) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-4">
                                <div class="card card-stats bg-default mr-3 mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-white-50 mb-0">Date of appointment</h5>
                                                <span class="h2 font-weight-bold mb-0 text-white">{{ format_date($appointment->takes_place_the) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-stats bg-default mr-3 mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-white-50 mb-0">Starts at</h5>
                                                <span class="h2 font-weight-bold mb-0 text-white">{{ format_time($appointment->starts_at) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-stats bg-default mr-3 mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-white-50 mb-0">Ends at</h5>
                                                <span class="h2 font-weight-bold mb-0 text-white">{{ format_time($appointment->ends_at) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-stats bg-{{ ($appointment->done == 1) ? 'success' : 'danger' }} mr-3 mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-white mb-0">Status</h5>
                                                <span class="h2 font-weight-bold mb-0 text-white">{!! format_done($appointment->done) !!}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-8 mt-3">
                                <h1>Specified Message</h1>
                                <p class="lead text-justify">
                                    {!! back_to_line($appointment->specified_message) !!}
                                </p>
                            </div>

                            <hr class="col-12">

                            @if (!$messages->isEmpty())
                                <div class="col-12 row mt-2 mb-3 justify-content-center">
                                    <div class="col-12 col-md-8">
                                        <h1 class="mb-5">Conversation</h1>

                                        @foreach ($messages as $message)
                                            <div class="message w-100 mt-4" id="{{ _('msg') . $message->id }}">
                                                <h1 class="message-from mb-3">
                                                    <span @if ($message->origin == 'admin') class="text-primary text-bold" @endif()>
                                                        {{ id_to_author_msg($message->from, $message->origin) }}
                                                    </span>,
                                                    <small>{{ format_date($message->created_at) }} at {{ format_time($message->created_at) }}</small>
                                                </h1>
                                                <p class="message-content lead mb-0">
                                                    {!! back_to_line($message->answered_message) !!}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <hr class="col-12 mt-5">
                            @endif

                            <div class="col-12 mt-4 mb-5">
                                <h1 class="text-center mb-5">
                                    Answer this appointment <br>
                                    <small>The customer will be notified and will receive a mail about this answer</small>
                                </h1>

                                <form method="POST" action="javascript:void(0)" class="answer-appointment-form">
                                    @csrf

                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <input type="hidden" id="id" value="{{ crypt_id($appointment->id) }}">
                                            <div class="form-group @error('answered-message') has-danger @enderror">
                                                <label class="form-control-label" for="input-answered-message">Leave a message to this customer</label><br>
                                                <textarea name="answered_message" class="form-control form-control-alternative @error('answered-message') is-invalid @enderror" rows="9" id="input-answered-message" placeholder="Write a large text here..." required>{{ old('answered-message') }}</textarea>

                                                @error('answered-message')
                                                    <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-lg float-right text-uppercase" id="btn-appointment-reply"><i class="fas fa-reply"></i> Reply</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('admin.layouts.partials._footer')

    </div>

@endsection
