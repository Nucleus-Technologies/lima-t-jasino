@extends('customer.layouts.app', ['title' => 'Register'])

@section('banner')

    {{-- Home Banner Area --}}
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Login/Register</h2>
                    <div class="page_link">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('register') }}">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('content')

    <!-- ================Login Box Area ================= -->
    <section class="login_box_area p_120">

        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="{{ asset('customer/img/login.jpg') }}" alt="">
                        <div class="hover">
                            <h4>Already a customer?</h4>
                            <p>Just access your account and the many options that go with it.</p>
                            <a class="main_btn" href="{{ route('login') }}">Log In</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="login_form_inner reg_form">
                        <h3>Create an Account</h3>

                        <form class="row login_form" action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" id="first_name" placeholder="First Name" required autocomplete="first_name">

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" id="last_name" placeholder="Last Name" required autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" placeholder="Email Address" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" id="password" placeholder="Password" autocomplete="new-password" minlength="8" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" name="password_confirmation" id="password-confirm" placeholder="Confirm Password" autocomplete="new-password" minlength="8" required>
                            </div>

                            <div class="col-md-12 form-group input-group-icon">
                                <div class="icon">+</div>

                                <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" id="code" placeholder="Code" autocomplete="code" pattern="[0-9+]{}">
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" id="phone" placeholder="Phone Number (optional)" autocomplete="phone" pattern="[0-9+]{}">

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="switch-wrap d-flex align-items-center mt-4">
                                <div class="primary-checkbox mr-2">
                                    <input type="checkbox" id="primary-checkbox">
                                    <label for="primary-checkbox"></label>
                                </div>
                                <label for="primary-checkbox">
                                    I have read and accept the <a href="#">conditions</a> and <a href="#">terms</a> of use.
                                </label>
                            </div>

                            <div class="col-md-12 form-group mt-5">
                                <button type="submit" class="btn submit_btn">Register</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>

@endsection
