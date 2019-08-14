@php
    $title = 'Notifications'
@endphp

@extends('admin.layouts.app', ['title' => $title])

@section('content')

    @include('admin.layouts.partials._nav_content', ['title' => $title])

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="display-2 text-white">Notifications</h1>
                        <p class="text-white mt-0 mb-5">Here are the notifications concerning all the operations that have been done on the site.</p>

                        <div class="alert alert-info" role="alert">
                            <strong>NOTIFCATIONS ARE SO HELPFUL!</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">

        <div class="row">

            <div class="col-lg-12 mb-5 mb-xl-0 mt-5">
                @if ($notifications->isEmpty())
                    <div class="alert alert-primary mb-0" role="alert">
                        <strong>Info!</strong> You have no notification yet!
                    </div>
                @else
                    <div class="list-group list-notification w-100">
                        @foreach ($notifications as $notification)
                            <a href="{{ route('admin.notification.read', $notification->id) }}" class="list-group-item list-group-item-action w-100 {{ (!$notification->read) ? 'list-group-item-light' : '' }}">
                                <div class="d-flex w-100 justify-content-between">
                                    <h4 class="mb-1">{{ format_about($notification->about) }}</h4>
                                    <small>{{ format_created_at($notification->created_at) }}</small>
                                </div>

                                <p class="mb-1">
                                    {{ format_item($notification->about, $notification->item) }}
                                </p>

                                <small class="text-primary text-bold">
                                    {{ format_sender($notification->type, $notification->about, $notification->item) }}
                                </small>

                                <form action="{{ route('admin.notification.read', $notification->id) }}" method="post" class="d-none notif-form">
                                    @csrf
                                </form>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        @include('admin.layouts.partials._footer')

    </div>

@endsection
