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
                <p class="text-white mt-0 mb-5">{!! backToLine($outfit->context) !!}</p>
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
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="card card-stats bg-default col-12 col-md-6 mr-3 mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-white-50 mb-0">Price</h5>
                                            <span class="h2 font-weight-bold mb-0 text-white">@convert($outfit->price)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-stats bg-default col-12 col-md-5 mr-3 mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-white-50 mb-0">Category</h5>
                                            <span class="h2 font-weight-bold mb-0 text-white">{{ ucfirst($outfit->category) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-stats bg-default col-12 col-md-5 mr-3 mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-white-50 mb-0">Type</h5>
                                            <span class="h2 font-weight-bold mb-0 text-white">{{ idToWording($outfit->type)->wording }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-stats bg-{{ ($outfit->availibility == 'in') ? 'success' : 'danger' }} col-12 col-md-6 mr-3 mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-white mb-0">Availibility</h5>
                                            <span class="h2 font-weight-bold mb-0 text-white">{!! showAvailibility($outfit->availibility) !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4 mb-5">
                                <p class="lead text-justify">
                                    {!! backToLine($outfit->description) !!}
                                </p>
                            </div>

                            <div class="col-12">
                                <h1>Photos</h1>
                                <div id="carouselOutfitPhotos" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @for ($i = 0; $i < count(getOutfitPhotos($outfit->id)); $i++)
                                            <li data-target="#carouselOutfitPhotos" data-slide-to="0" @if ($i == 0) class="active" @endif></li>
                                        @endfor
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach (getOutfitPhotos($outfit->id) as $img)
                                            <div class="carousel-item @if ($loop->first) active @endif">
                                                <img alt="Image placeholder" src="{{ showPhoto($img->filename) }}" class="d-block w-100">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselOutfitPhotos" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselOutfitPhotos" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
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
