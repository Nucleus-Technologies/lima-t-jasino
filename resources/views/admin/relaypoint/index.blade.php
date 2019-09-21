@php
    $title = 'Relay Points'
@endphp

@extends('admin.layouts.app', ['title' => $title])

@section('content')

    @include('admin.layouts.partials._nav_content', ['title' => $title])

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Relay Points</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ show2digits($relayPoints->count()) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-map-pin"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <strong class="text-success mr-2">Required for delivery.</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 offset-xl-6 col-lg-6">
                        <button class="btn btn-warning btn-lg btn-block text-uppercase" data-toggle="modal" data-target="#modal-relaypoint-form" data-backdrop="static">
                            <i class="fas fa-plus-circle mr-1"></i> New Relay Point
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-relaypoint-form" tabindex="-1" role="dialog" aria-labelledby="modal-relaypoint-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-header bg-transparent">
                            <h3 class="mb-0">
                                Save a new relay point linked to a region and a city.
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </h3>
                        </div>

                        <div class="card-body px-lg-5 py-lg-4">
                            <form role="form" class="row relaypoint-save-form" method="POST" action="javascript:void(0)" novalidate>
                                <div class="col-12 alert alert-default" role="alert">
                                    <span class="alert-inner--icon"><i class="fas fa-exclamation-circle"></i></span>
                                    <span class="alert-inner--text"><strong>Info!</strong> For a region and its given city, only one relay point is assigned!</span>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="text-muted mb-1">
                                        <small>Choose a region.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <select class="form-control" name="region" id="region" required>
                                                <option value="" selected>---</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id }}">{{ $region->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="text-muted mb-1">
                                        <small>Choose a city.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                            </div>
                                            <select class="form-control" name="city" id="city" required>
                                                <option value="" selected>---</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-muted mb-1">
                                        <small>Define the name of the relay point.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                            </div>
                                            <input type="text" class="form-control @error('label') is-invalid @enderror" name="label" value="{{ old('label') }}" placeholder="ex: Relay Point Express Union - Yaoundé Central Post" required>
                                        </div>

                                        @error('label')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-muted mb-1">
                                        <small>Specifies the nearest popular building or company.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marked"></i></span>
                                            </div>
                                            <input type="text" class="form-control @error('near') is-invalid @enderror" name="near" value="{{ old('near') }}" placeholder="ex: near the Pharmacie de la Moisson" required>
                                        </div>

                                        @error('near')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-muted mb-1">
                                        <small>Specifies the address of the relay point.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-directions"></i></span>
                                            </div>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="ex: Yaoundé Central Post" required>
                                        </div>

                                        @error('address')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-muted mb-1">
                                        <small>Specifies the relay point contact (Person + Phone number).</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            </div>
                                            <input type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" placeholder="ex: M. NGNOULAYE 655191890" required>
                                        </div>

                                        @error('contact')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-muted mb-1">
                                        <small>Specifies the opening hours of the relay point.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            </div>
                                            <input type="text" class="form-control @error('opening_hours') is-invalid @enderror" name="opening_hours" value="{{ old('opening_hours') }}" placeholder="ex: 8AM to 18PM on Weekdays - 9AM to 2PM on Saturdays" required>
                                        </div>

                                        @error('opening_hours')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-muted mb-1">
                                        <small>Specifies the shipping cost at this relay point.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
                                            </div>
                                            <input type="number" class="form-control @error('shipping_cost') is-invalid @enderror" name="shipping_cost" value="{{ old('shipping_cost') }}" min="0" placeholder="ex: 2500" required>
                                        </div>

                                        @error('shipping_cost')
                                            <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4 text-uppercase" id="btn-relaypoint-save">
                                        <i class="fas fa-check-circle mr-1"></i>Save the relay point
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

            <div class="col-lg-12 mb-5 mb-xl-0 mt-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">All relay points by Region/City</h3>
                            </div>
                            @if (!$relayPoints->isEmpty())
                                <div class="col">
                                    <div class="form-group w-75 m-0 float-right">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                            </div>
                                            <input class="form-control" id="relaypoint-search" placeholder="Search by region, by city, by name, by cost, ..." type="text">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($relayPoints->isEmpty())
                        <div class="alert alert-primary mb-0" role="alert">
                            <strong>Info!</strong> No relay points available for the moment!
                        </div>
                    @else
                        <div class="table-responsive table-appointments">
                            <div>
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Region</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Shipping Cost</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody class="list" id="relaypoint-list">
                                        @foreach ($relayPoints as $relayPoint)
                                            <tr>
                                                <th scope="row" class="customer">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <strong class="mb-0 text-sm">
                                                                {{ $relayPoint->region->label }}
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </th>

                                                <th scope="row" class="takes_place_the">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">
                                                                {{ format_message($relayPoint->city->label, 30) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </th>

                                                <td class="starts_at">
                                                    <span class="badge badge-pill badge-primary">
                                                        {{ format_message($relayPoint->label, 30) }}
                                                    </span>
                                                </td>

                                                <td class="ends_at">
                                                    <span class="badge badge-pill badge-primary">@convert($relayPoint->shipping_cost)</span>
                                                </td>

                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="{{ route('admin.relaypoint.show', $relayPoint->id) }}">
                                                                <i class="fas fa-eye"></i> More...
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>

        @include('admin.layouts.partials._footer')

    </div>

@endsection
