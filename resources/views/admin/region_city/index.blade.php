@php
    $title = 'Regions & Cities'
@endphp

@extends('admin.layouts.app', ['title' => $title])

@section('content')

    @include('admin.layouts.partials._nav_content', ['title' => $title])

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Regions</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ show2digits($regions->count()) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Cities</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ show2digits($cities->count()) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 offset-xl-3 col-lg-4">
                        <button class="btn btn-warning btn-lg btn-block text-uppercase" data-toggle="modal" data-target="#modal-region-city-form" data-backdrop="static">
                            <i class="fas fa-plus-circle mr-1"></i> New Region/City
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-region-city-form" tabindex="-1" role="dialog" aria-labelledby="modal-region-city-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header bg-transparent">
                            <h3 class="mb-0">
                                Record a new region and/or its city(ies).
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </h3>
                        </div>

                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" class="row region-city-record-form" method="POST" action="javascript:void(0)" novalidate>
                                <div class="col-12 col-md-6">
                                    <div class="text-muted mb-1">
                                        <small>Choose a region.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <select class="form-control" name="region" id="region">
                                                <option value="">---</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}">{{ $region->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="text-right text-muted mb-1">
                                        <small>Or define a new region.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control @error('label_r') is-invalid @enderror" name="label_r" value="{{ old('label_r') }}" placeholder="ex. Centre">
                                        </div>

                                        @error('label_r')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-muted mb-1">
                                        <small>Define the name of the city.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control @error('label_c') is-invalid @enderror" name="label_c" value="{{ old('label_c') }}" placeholder="ex: Yaoundé - Avenue Kenedy - Marché Central" required>
                                        </div>

                                        @error('label_c')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4 text-uppercase" id="btn-region-city-record">
                                        <i class="fas fa-check-circle mr-1"></i>Record the region/city
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">

        <div class="row">
            @if ($regions->isEmpty())
                <div class="col-lg-12 mb-5 mb-xl-0 mt-5">
                    <div class="alert alert-primary mb-0" role="alert">
                        <strong>Info!</strong> There's are no regions and cities recorded for the moment!
                    </div>
                </div>
            @else
            <div class="col-12 accordion row" id="accordionRegionsCities">
                @foreach ($regions as $region)
                    <div class="col-lg-4 mb-5 mb-xl-0 mt-5">
                        <div class="card shadow">
                            <div class="card-header bg-transparent" id="heading-{{ $region->id }}">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="text-uppercase text-muted ls-1 mb-1">Region</h6>
                                        <h2 class="mb-0">{{ $region->label }}</h2>
                                    </div>
                                    <div class="col text-right">
                                        <button class="btn btn-outline-default btn-sm btn-collapse rounded-circle @if ($loop->index != 0) collapsed @endif" type="button" data-toggle="collapse" data-target="#collapse-{{ $region->id }}" aria-expanded="false" aria-controls="collapse-{{ $region->id }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="collapse-{{ $region->id }}" class="collapse" aria-labelledby="heading-{{ $region->id }}" data-parent="#accordionRegionsCities">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($region->cities as $city)
                                            <li class="list-group-item">{{ $city->label }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        </div>

        @include('admin.layouts.partials._footer')

    </div>

@endsection
