@php
    $title = 'Notifications';
@endphp

@extends('customer.layouts.app', ['title' => $title])

@section('banner')

    {{-- Banner Area --}}
    @include('customer.layouts.partials._banner', [
        "banner_content" => "<h2>" .$title. "</h2>
            <div class='page_link'>
                <a href=" .route('home').">Home</a>
                <a href=" .route('notification'). ">" .$title. "</a>
            </div>
        "
    ])

@endsection

@section('content')

    {{-- Tracking Box Area --}}
    <section class="tracking_box_area p_120">
        <div class="container">
            <h2 class="text-center mb-2">
                Here are the notifications concerning all the operations you've done on our site.
            </h2>

            <div class="tracking_box_inner d-flex flex-column align-items-center">
                <p>The most recent are at the top of the list.</p>

                <div class="row mt-5 justify-content-center">
                    <div class="col-12">
                        @if ($notifications->isEmpty())
                            <div class="alert alert-primary mb-0" role="alert">
                                <strong>Info!</strong> You have no notification yet!
                            </div>
                        @else
                            <div class="list-group list-notification w-100">
                                @foreach ($notifications as $notification)
                                    <a href="{{ route('notification.read', $notification->id) }}" class="list-group-item list-group-item-action w-100 {{ (!$notification->read) ? 'list-group-item-secondary' : '' }}">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{ format_about($notification->about) }}</h5>
                                            <small>{{ format_created_at($notification->created_at) }}</small>
                                        </div>

                                        <p class="mb-1">
                                            {{ format_item($notification->about, $notification->item) }}
                                        </p>

                                        <small class="text-primary">
                                            {{ format_sender($notification->type, $notification->about, $notification->item) }}
                                        </small>

                                        <form action="{{ route('notification.read', $notification->id) }}" method="post" class="d-none notif-form">
                                            @csrf
                                        </form>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
