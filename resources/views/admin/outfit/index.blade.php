@php
    $title = 'Outfits'
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
                                        <h5 class="card-title text-uppercase text-muted mb-0">Men</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ show2digits($men_outfits->count()) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-male"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    @if (stat_month('outfit', 'men') < 0)
                                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> {{ stat_month('outfit', 'men') }}</span>
                                    @else
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ stat_month('outfit', 'men') }}</span>
                                    @endif
                                    <span class="text-nowrap">During this month</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Women</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ show2digits($women_outfits->count()) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-female"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                        @if (stat_month('outfit', 'women') < 0)
                                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> {{ stat_month('outfit', 'women') }}</span>
                                    @else
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ stat_month('outfit', 'women') }}</span>
                                    @endif
                                    <span class="text-nowrap">During this month</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{--  <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Children</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ show2digits($children_outfits->count()) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-child"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fas fa-plus"></i> {{ show2digits(stat_month('outfit', 'children')) }}</span>
                                    <span class="text-nowrap">During this month</span>
                                </p>
                            </div>
                        </div>
                    </div>  --}}

                    <div class="col-xl-3 col-lg-6">
                        <a href="{{ route('admin.outfit.create') }}" class="btn btn-warning btn-lg btn-block text-uppercase"><i class="fas fa-plus-circle mr-1"></i> Add New Outfit</a>
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
                                <h3 class="mb-0">Men Outfits</h3>
                            </div>
                            @if (!$men_outfits->isEmpty())
                                <div class="col">
                                    <div class="form-group w-75 m-0 float-right">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                            </div>
                                            <input class="form-control" id="men-outfit-search" placeholder="Search by name, by price, by type, ..." type="text">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($men_outfits->isEmpty())
                        <div class="alert alert-primary mb-0" role="alert">
                            <strong>Info!</strong> No outfits of this category have already been registered!
                        </div>
                    @else
                        <div class="table-responsive table-outfits">
                            <div>
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Availibility</th>
                                            <th scope="col">Pictures</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody class="list" id="men-list">
                                        @foreach ($men_outfits as $outfit)
                                            <tr>
                                                <th scope="row" class="name">
                                                    <div class="media align-items-center">
                                                        <a href="{{ route('admin.outfit.show', $outfit) }}" class="avatar rounded-circle mr-3">
                                                            <img alt="Image placeholder" src="{{ asset('admin/img/theme/outfit-avatar.png') }}">
                                                        </a>
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">{{ format_message($outfit->name, 30) }}</span>
                                                            <span class="badge badge-pill badge-primary">
                                                                <i class="fas fa-tag text-success mr-1"></i>{{ number_sales($outfit->id) }}
                                                            </span>
                                                            <span class="badge badge-pill badge-primary">
                                                                <i class="fas fa-heart text-danger mr-1"></i>{{ number_wishes($outfit->id) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </th>

                                                <td class="price">
                                                    <span class="badge badge-pill badge-primary">@convert($outfit->price)</span>
                                                </td>

                                                <td class="type">
                                                    {{ $outfit->type->label }}
                                                </td>

                                                <td class="availibility">
                                                    {!! format_availibility($outfit->availibility) !!}
                                                </td>

                                                <td class="pictures">
                                                    <div class="avatar-group">
                                                        @foreach ($outfit->outfitphotos as $img)
                                                            @php
                                                                $path = $outfit->category .'/'. $outfit->type->label .'/'. $img->filename;
                                                            @endphp
                                                            <a href="{{ show_photo($path) }}" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Click to see more" target="_blank">
                                                                <img alt="Image placeholder" src="{{ show_photo($path) }}" class="rounded-circle">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </td>

                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Edit</a>
                                                            <a class="dropdown-item bg-danger text-white" href="#"><i class="fas fa-trash"></i> Delete</a>
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

            <div class="col-lg-12 mb-5 mb-xl-0 mt-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Women Outfits</h3>
                            </div>
                            @if (!$women_outfits->isEmpty())
                                <div class="col text-right">
                                    <div class="form-group w-75 m-0 float-right">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                            </div>
                                            <input class="form-control" id="women-outfit-search" placeholder="Search by type, by name, by availibility, ..." type="text">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($women_outfits->isEmpty())
                        <div class="alert alert-primary m-0" role="alert">
                            <strong>Info!</strong> No outfits of this category have already been registered!
                        </div>
                    @else
                        <div class="table-responsive table-outfits">
                            <div>
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Availibility</th>
                                            <th scope="col">Pictures</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody class="list" id="women-list">
                                        @foreach ($women_outfits as $outfit)
                                            <tr>
                                                <th scope="row" class="name">
                                                    <div class="media align-items-center">
                                                        <a href="{{ route('admin.outfit.show', $outfit) }}" class="avatar rounded-circle mr-3">
                                                            <img alt="Image placeholder" src="{{ asset('admin/img/theme/outfit-avatar.png') }}">
                                                        </a>
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">{{ format_message($outfit->name, 30) }}</span>
                                                            <span class="badge badge-pill badge-primary">
                                                                <i class="fas fa-tag text-success mr-1"></i>{{ number_sales($outfit->id) }}
                                                            </span>
                                                            <span class="badge badge-pill badge-primary">
                                                                <i class="fas fa-heart text-danger mr-1"></i>{{ number_wishes($outfit->id) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </th>

                                                <td class="price">
                                                    <span class="badge badge-pill badge-primary">@convert($outfit->price)</span>
                                                </td>

                                                <td class="type">
                                                    {{ $outfit->type->label }}
                                                </td>

                                                <td class="availibility">
                                                    {!! format_availibility($outfit->availibility) !!}
                                                </td>

                                                <td class="pictures">
                                                    <div class="avatar-group">
                                                        @foreach ($outfit->outfitphotos as $img)
                                                            @php
                                                                $path = $outfit->category .'/'. $outfit->type->label .'/'. $img->filename;
                                                            @endphp
                                                            <a href="{{ show_photo($path) }}" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Click to see more" target="_blank">
                                                                <img alt="Image placeholder" src="{{ show_photo($path) }}" class="rounded-circle">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </td>

                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Edit</a>
                                                            <a class="dropdown-item bg-danger text-white" href="#"><i class="fas fa-trash"></i> Delete</a>
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
