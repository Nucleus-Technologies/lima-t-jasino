@extends('customer.layouts.app', ['title' => 'Login'])

@section('banner')

    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Login/Register</h2>
                    <div class="page_link">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('login') }}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('content')

    {{-- Login Box Area --}}
    <section class="login_box_area p_120">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="login_box_img">
                        <img class="img-fluid" src="{{ asset('customer/img/login.jpg') }}" alt="">
                        <div class="hover">
                            <h4>New to our website?</h4>
                            <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                            <a class="main_btn" href="{{ route('register') }}">Create an Account</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="login_form_inner">
                        <h3>Log in to our site</h3>

                        <form class="row login_form" action="{{ route('login') }}" method="POST" id="contactForm">
                            @csrf

                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address" autocomplete="email" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password" required>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <div class="switch-wrap d-flex align-items-center">
                                        <div class="confirm-checkbox mr-2">
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label for="remember"></label>
                                        </div>

                                        <p>{{ __('Keep me logged in') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn submit_btn">
                                    {{ __('Log In') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
