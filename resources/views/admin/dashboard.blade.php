@php
    $title = 'Dashboard'
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
                                        <h5 class="card-title text-uppercase text-muted mb-0">Traffic</h5>
                                        <span class="h2 font-weight-bold mb-0">350,897</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ number_customers() }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-primary mr-2"><i class="fas fa-plus"></i> {{ total_week('user', 1) }}</span>
                                    <span class="text-nowrap">Last week</span> <br>

                                    <span class="text-primary mr-2"><i class="fas fa-plus"></i> {{ total_week('user', 0) }}</span>
                                    <span class="text-nowrap">This week</span> <br>

                                    @if (stat_week_pcent('user', 0) < stat_week_pcent('user', 1))
                                        <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> {{ stat_week_pcent('user', 0) }}%</span>
                                    @else
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ stat_week_pcent('user', 0) }}%</span>
                                    @endif
                                    <span class="text-nowrap">This week</span>
                                </p>

                                <hr>

                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-primary mr-2"><i class="fas fa-plus"></i> {{ total_month('user', 1) }}</span>
                                    <span class="text-nowrap">Last month</span> <br>

                                    <span class="text-primary mr-2"><i class="fas fa-plus"></i> {{ total_month('user', 0) }}</span>
                                    <span class="text-nowrap">This month</span> <br>

                                    @if (stat_month_pcent('user', 0) < stat_month_pcent('user', 1))
                                        <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> {{ stat_month_pcent('user', 0) }}%</span>
                                    @else
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ stat_month_pcent('user', 0) }}%</span>
                                    @endif
                                    <span class="text-nowrap">This month</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Orders</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ number_orders() }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-tags"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-primary mr-2"><i class="fas fa-plus"></i> {{ total_week('order', 1) }}</span>
                                    <span class="text-nowrap">Last week</span> <br>

                                    <span class="text-primary mr-2"><i class="fas fa-plus"></i> {{ total_week('order', 0) }}</span>
                                    <span class="text-nowrap">This week</span> <br>

                                    @if (stat_week_pcent('order', 0) < stat_week_pcent('order', 1))
                                        <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> {{ stat_week_pcent('order', 0) }}%</span>
                                    @else
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ stat_week_pcent('order', 0) }}%</span>
                                    @endif
                                    <span class="text-nowrap">This week</span>
                                </p>

                                <hr>

                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-primary mr-2"><i class="fas fa-plus"></i> {{ total_month('order', 1) }}</span>
                                    <span class="text-nowrap">Last month</span> <br>

                                    <span class="text-primary mr-2"><i class="fas fa-plus"></i> {{ total_month('order', 0) }}</span>
                                    <span class="text-nowrap">This month</span> <br>

                                    @if (stat_month_pcent('order', 0) < stat_month_pcent('order', 1))
                                        <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> {{ stat_month_pcent('order', 0) }}%</span>
                                    @else
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> {{ stat_month_pcent('order', 0) }}%</span>
                                    @endif
                                    <span class="text-nowrap">This month</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                                        <span class="h2 font-weight-bold mb-0">49,65%</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-percent"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">

        <div class="row">

            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">Sales value</h2>
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="XAF" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                            <span class="d-none d-md-block">Month</span>
                                            <span class="d-md-none">M</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="XAF" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span class="d-none d-md-block">Week</span>
                                            <span class="d-md-none">W</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-sales" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                                <h2 class="mb-0">Total orders</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <canvas id="chart-orders" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-5">

            <div class="col-xl-8 mb-5 mb-xl-0 best-selling">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">The 10 best-selling outfits</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Outfit</th>
                                    <th scope="col">Sales</th>
                                    <th scope="col">Wishes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lines as $key=>$line)
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <th scope="row">{{ $line->outfit->name }}</th>
                                        <td><i class="fas fa-tag text-success mr-1"></i> {{ $line->number_sales }}</td>
                                        <td><i class="fas fa-heart text-danger mr-1"></i> {{ number_wishes($line->outfit->id) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Social traffic</h3>
                    </div>
                    <div class="col text-right">
                        <a href="#!" class="btn btn-sm btn-primary">See all</a>
                    </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Referral</th>
                        <th scope="col">Visitors</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">
                            Facebook
                        </th>
                        <td>
                            1,480
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                            <span class="mr-2">60%</span>
                            <div>
                                <div class="progress">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                </div>
                            </div>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <th scope="row">
                            Facebook
                        </th>
                        <td>
                            5,480
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                            <span class="mr-2">70%</span>
                            <div>
                                <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                </div>
                            </div>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <th scope="row">
                            Google
                        </th>
                        <td>
                            4,807
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                            <span class="mr-2">80%</span>
                            <div>
                                <div class="progress">
                                <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                </div>
                            </div>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <th scope="row">
                            Instagram
                        </th>
                        <td>
                            3,678
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                            <span class="mr-2">75%</span>
                            <div>
                                <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                                </div>
                            </div>
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <th scope="row">
                            twitter
                        </th>
                        <td>
                            2,645
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                            <span class="mr-2">30%</span>
                            <div>
                                <div class="progress">
                                <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                                </div>
                            </div>
                            </div>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>

        </div>

        @include('admin.layouts.partials._footer')

    </div>

@endsection
