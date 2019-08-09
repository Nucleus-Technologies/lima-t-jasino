@php
    $title = 'Profile'
@endphp

@extends('admin.layouts.app', ['title' => $title])

@section('content')

    @include('admin.layouts.partials._nav_content', ['title' => $title])

    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Hello {{ Auth::user()->username }}</h1>
                    <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>

                    <div class="alert alert-info" role="alert">
                        <strong>PROFILE EDITION</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">

        <div class="row">

            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ asset('admin/img/theme/avatar.svg') }}" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                            <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                        </div>
                    </div>

                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        <span class="heading">22</span>
                                        <span class="description">Friends</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">Photos</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">Comments</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <h3>{{ Auth::user()->username }}<span class="font-weight-light">, Admin</span></h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>Buéa, Cameroon
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>CEO - Chief Executive Officer
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>Lima T Jasino
                            </div>
                            <hr class="my-4" />
                            <p>Fashion Entrepreneur — Electrical Engineer — Wardrobe Consultant — Personal Stylist.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">My account</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="javascript:void(0)" class="admin-data-form">
                            @csrf
                            @method('PUT')

                            <h6 class="heading-small text-muted mb-4">Admin information</h6>

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group @error('username') has-danger @enderror">
                                            <label class="form-control-label" for="input-username">Username</label>
                                            <input type="text" name="username" id="input-username" class="form-control form-control-alternative @error('username') is-invalid @enderror" placeholder="Username" value="{{ Auth::user()->username ?: old('username') }}">

                                            @error('username')
                                                <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group @error('password') has-danger @enderror">
                                            <label class="form-control-label" for="input-password">Password</label>
                                            <input type="password" name="password" id="input-password" class="form-control form-control-alternative @error('password') is-invalid @enderror" placeholder="New password">

                                            @error('password')
                                                <div class="alert alert-danger mb-0 mr-0 w-100" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4" />

                            <div class="d-flex justify-content-between align-items-center">
                                <p class="m-0">DAMN!</p>
                                <button class="btn btn-icon btn-3 btn-primary" type="submit" id="btn-admin-edit">
                                    <span class="btn-inner--text">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit Profile
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        @include('admin.layouts.partials._footer')

    </div>

@endsection
