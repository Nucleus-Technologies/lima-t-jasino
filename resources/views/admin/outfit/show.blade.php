@php
    $title = 'Outfit View'
@endphp

@extends('admin.layouts.app', ['title' => $title])

@section('content')

    @include('admin.layouts.partials._nav_content', ['title' => $title])

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <h1 class="display-2 text-white">{{ $outfit->name }}</h1>
                <p class="text-white mt-0 mb-4">{!! back_to_line($outfit->context) !!}</p>
                <p class="mb-5 stats">
                    <span class="badge badge-pill badge-default">
                        <i class="fas fa-tag text-success mr-1"></i>{{ number_sales($outfit->id) }}
                    </span>
                    <span class="badge badge-pill badge-default">
                        <i class="fas fa-heart text-danger mr-1"></i>{{ number_wishes($outfit->id) }}
                    </span>
                </p>
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
                                <h3 class="mb-0">Outfit Informations</h3>
                            </div>
                            <div class="col mt-3 mt-sm-0">
                                <span class="badge badge-pill badge-dark float-lg-right">
                                    Added on {{ format_date($outfit->created_at) }} at {{ format_time($outfit->created_at) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 mb-5">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-6 mb-5 mb-md-0">
                                        <h1>Photos</h1>
                                        <div id="carouselOutfitPhotos" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                @for ($i = 0; $i < count($outfit->outfitphotos); $i++)
                                                    <li data-target="#carouselOutfitPhotos" data-slide-to="0" @if ($i == 0) class="active" @endif></li>
                                                @endfor
                                            </ol>
                                            <div class="carousel-inner">
                                                @foreach ($outfit->outfitphotos as $img)
                                                    @php
                                                        $path = $outfit->category .'/'. $outfit->type->label .'/'. $img->filename;
                                                    @endphp
                                                    <div class="carousel-item @if ($loop->first) active @endif">
                                                        <img alt="Image placeholder" src="{{ show_photo($path) }}" class="d-block m-auto">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselOutfitPhotos" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon text-darker" aria-hidden="true">
                                                    <i class="fas fa-arrow-circle-left"></i>
                                                </span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselOutfitPhotos" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon text-darker" aria-hidden="true">
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="card card-stats bg-default w-75 mr-3 mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-white-50 mb-0">Price</h5>
                                                        <span class="h2 font-weight-bold mb-0 text-white">@convert($outfit->price)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-stats bg-default w-75 mr-3 mb-4 float-lg-right">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-white-50 mb-0">Category</h5>
                                                        <span class="h2 font-weight-bold mb-0 text-white">{{ ucfirst($outfit->category) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-stats bg-default w-75 mr-3 mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-white-50 mb-0">Type</h5>
                                                        <span class="h2 font-weight-bold mb-0 text-white">{{ $outfit->type->label }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-stats bg-{{ ($outfit->availibility == 'in') ? 'success' : 'danger' }} w-75 mr-3 mb-4 float-lg-right">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="card-title text-uppercase text-white mb-0">Availibility</h5>
                                                        <span class="h2 font-weight-bold mb-0 text-white">{!! format_availibility($outfit->availibility) !!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="col-12">

                            <div class="col-12 mt-3">
                                <h1>Description</h1>
                                <p class="lead text-justify">
                                    {!! $outfit->description !!}
                                </p>
                            </div>

                            <hr class="col-12">

                            <div class="col-12 mt-3 mb-5">
                                <h1>Specification</h1>
                                <p class="lead text-justify">
                                    {!! $outfit->specification !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('admin.layouts.partials._footer')

    </div>

@endsection
