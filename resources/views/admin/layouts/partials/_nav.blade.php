<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">

    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('brand/dark.png') }}" class="navbar-brand-img" alt="...">
        </a>

        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item">
                <a href="{{ route('admin.notification') }}" class="nav-link nav-link-icon nav-notification">
                    <i class="ni ni-bell-55"></i>

                    @if (number_notif_unread(Auth::user()->id, 'admin') != 0)
                        <span class="badge badge-pill badge-danger">
                            {{ number_notif_unread(Auth::user()->id, 'admin') }}
                        </span>
                    @endif
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('admin/img/theme/avatar.svg') }}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>
                    <a href="{{ route('admin.profile') }}" class="dropdown-item {{ set_active_route('admin.profile') }}">
                        <i class="ni ni-single-02"></i>
                        <span>My profile</span>
                    </a>
                    <a href="./examples/profile.html" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Settings</span>
                    </a>
                    <a href="./examples/profile.html" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>Activity</span>
                    </a>
                    <a href="./examples/profile.html" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>Support</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>

                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </div>
            </li>
        </ul>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{ asset('admin/img/theme/avatar.svg') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class=" nav-link {{ set_active_route('admin.dashboard') }}" href="{{ route('admin.dashboard') }}"> <i class="ni ni-tv-2 text-primary"></i> Dashboard </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ set_active_route('admin.outfit') }}" href="{{ route('admin.outfit') }}">
                        <i class="fas fa-tshirt text-blue"></i> Outfits
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ set_active_route('admin.appointment') }}" href="{{ route('admin.appointment') }}">
                        <i class="fas fa-calendar-alt text-orange"></i> Appointments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./examples/profile.html">
                        <i class="ni ni-single-02 text-yellow"></i> User profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./examples/tables.html">
                        <i class="ni ni-bullet-list-67 text-red"></i> Tables
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./examples/login.html">
                        <i class="ni ni-key-25 text-info"></i> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./examples/register.html">
                        <i class="ni ni-circle-08 text-pink"></i> Register
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="my-3">

            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Utilities</h6>

            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="{{ route('admin.outfit.create') }}">
                        <i class="fas fa-plus-circle mr-1"></i> ADD NEW OUTFIT
                    </a>
                </li>
            </ul>
        </div>

    </div>

</nav>
