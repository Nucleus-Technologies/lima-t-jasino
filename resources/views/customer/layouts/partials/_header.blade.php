<header class="header_area">
    <div class="top_menu row m0">
        <div class="container-fluid">
            <div class="float-left">
                <p>Call Us: <a href="tel:+237655191890">+237 655 191 890</a></p>
            </div>
            <div class="float-right">
                <ul class="right_side">
                    @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @endif
                    @else
                        <li><a href="#">{{ Auth::user()->full_name }}</a></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                    <li>
                        <a href="contact.html">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{ route('home') }}">
                    <img src="{{ asset('brand/white.png') }}" alt="" width="129">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <div class="row w-100">
                        <div class="col-lg-7 pr-0">
                            <ul class="nav navbar-nav center_nav pull-right">
                                <li class="nav-item {{ set_active_route('home') }}">
                                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                                </li>
                                <li class="nav-item {{ set_active_route('outfit.shop') }}">
                                    <a href="{{ route('outfit.shop') }}" class="nav-link">Shop</a>
                                </li>
                                <li class="nav-item {{ set_active_route('weedings') }}">
                                    <a href="{{ route('weedings') }}" class="nav-link">Weedings</a>
                                </li>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a class="nav-link" href="login.html">Login</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="tracking.html">Tracking</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="elements.html">Elements</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                            </ul>

                            <div class="nav-search">
                                <form method="GET" action="{{ route('outfit.search') }}" class="search_form" role="search">
                                    @csrf

                                    <div class="input-group-icon form-group w-100 mb-0">
                                        <div class="icon text-center">
                                            <button type="button" class="close">
                                                <i class="fas fa-times" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <input type="search" name="keyword" placeholder="You can search by name, by category, by type, by price or another keyword..." class="w-100">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                <hr>
                                <li class="nav-item">
                                    <a href="#" class="icons" id="search-link">
                                        <i class="fas fa-search" aria-hidden="true"></i>
                                    </a>
                                </li>

                                <hr>

                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="icons dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @guest
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                            @if (Route::has('register'))
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                                </li>
                                            @endif
                                        @else
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">{{ __('My account') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('appointment') }}">My appointments</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('wishlist') }}">My wishlist</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        @endguest
                                    </ul>
                                </li>

                                <hr>

                                <li class="nav-item {{ set_active_route('appointment.create') }}">
                                    <a href="{{ route('appointment.create') }}" class="icons">
                                        <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                                    </a>
                                </li>

                                @if (Auth::check())
                                <hr>

                                <li class="nav-item {{ set_active_route('notification') }}" id="nav-item-notif">
                                    <a href="{{ route('notification') }}" class="icons nav-notification">
                                        <i class="fas fa-bell" aria-hidden="true"></i>

                                        @if (number_notif_unread('user') != 0)
                                            <span class="badge badge-pill badge-danger">
                                                {{ number_notif_unread('user') }}
                                            </span>
                                        @endif
                                    </a>
                                </li>
                                @endif

                                <hr>

                                @if (!Auth::check())
                                <li class="nav-item">
                                    <a href="{{ route('wishlist') }}" class="icons">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                </li>

                                <hr>
                                @endif

                                <li class="nav-item" id="nav-item-cart">
                                    <a href="{{ route('cart') }}" class="icons nav-cart">
                                        <i class="fas fa-shopping-cart"></i>

                                        <span class="badge badge-pill badge-success" id="badge-cart">
                                            {{ number_outfit_cart() }}
                                        </span>
                                    </a>
                                </li>

                                <hr>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
