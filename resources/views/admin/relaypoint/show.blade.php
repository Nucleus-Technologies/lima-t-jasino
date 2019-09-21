@php
    $title = 'Relay Point View'
@endphp

@extends('admin.layouts.app', ['title' => $title])

@section('content')

    @include('admin.layouts.partials._nav_content', ['title' => $title])

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <h1 class="display-2 text-white">{{ $relayPoint->label }}</h1>
                <h1 class="text-white mt-0 mb-5">
                    {{ $relayPoint->region->label }}
                    <small> --- {{ $relayPoint->city->label }}</small>
                </h1>
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
                                <h3 class="mb-0">Relay Point Informations</h3>
                            </div>
                            <div class="col mt-3 mt-sm-0">
                                <span class="badge badge-pill badge-dark float-lg-right">
                                    Added on {{ format_date($relayPoint->created_at) }} at {{ format_time($relayPoint->created_at) }}
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
                                                <h5 class="card-title text-uppercase text-white-50 mb-0">Near</h5>
                                                <span class="h2 font-weight-bold mb-0 text-white">{{ $relayPoint->near }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="card card-stats bg-default mr-3 mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-white-50 mb-0">Address</h5>
                                                <span class="h2 font-weight-bold mb-0 text-white">{{ $relayPoint->address }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="card card-stats bg-default mr-3 mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-white-50 mb-0">Relay Point Contact</h5>
                                                <span class="h2 font-weight-bold mb-0 text-white">{{ $relayPoint->contact }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-8">
                                <div class="card card-stats bg-default mr-3 mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-white-50 mb-0">Opening Hours</h5>
                                                <span class="h2 font-weight-bold mb-0 text-white">{{ $relayPoint->opening_hours }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="card card-stats bg-default mr-3 mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-white-50 mb-0">Shipping Cost</h5>
                                                <span class="h2 font-weight-bold mb-0 text-white">@convert($relayPoint->shipping_cost)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('admin.layouts.partials._footer')

    </div>

@endsection
