@php
    $title = 'Appointments'
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
                                        <h5 class="card-title text-uppercase text-muted mb-0">Already Done</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ totalByDone(1) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <strong class="text-success mr-2">Satisfied customers.</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Not yet Done</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ totalByDone(0) }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <strong class="text-danger mr-2">Unsatisfied customers.</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">location for all appointments.</h5>
                                        <span class="h2 font-weight-bold mb-0">Yaoundé, Cameroon (In our Office)</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <h3 class="mb-0">Appointment already done</h3>
                            </div>
                            @if (!$appointments_done->isEmpty())
                                <div class="col">
                                    <div class="form-group w-75 m-0 float-right">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                            </div>
                                            <input class="form-control" id="done-search" placeholder="Search by type, by name, by availibility, ..." type="text">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($appointments_done->isEmpty())
                        <div class="alert alert-primary mb-0" role="alert">
                            <strong>Info!</strong> There are no appointments marked as done!
                        </div>
                    @else
                        <div class="table-responsive table-appointments">
                            <div>
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Date of appointment</th>
                                            <th scope="col">Starts at</th>
                                            <th scope="col">Ends at</th>
                                            <th scope="col">Specified Message</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody class="list" id="done-list">
                                        @foreach ($appointments_done as $appointment)
                                            <tr>
                                                <th scope="row" class="customer">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <strong class="mb-0 text-sm">{{ idToFullname($appointment->user)->full_name }}</strong>
                                                        </div>
                                                    </div>
                                                </th>

                                                <th scope="row" class="takes_place_the">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">{{ formatDate($appointment->takes_place_the) }}</span>
                                                        </div>
                                                    </div>
                                                </th>

                                                <td class="starts_at">
                                                    <span class="badge badge-pill badge-primary"> {{ formatTime($appointment->starts_at) }}</span>
                                                </td>

                                                <td class="ends_at">
                                                    <span class="badge badge-pill badge-primary">{{ formatTime($appointment->ends_at) }}</span>
                                                </td>

                                                <td class="specified_message">
                                                    {!! backToLine(formatMessage($appointment->specified_message, 50)) !!}
                                                </td>

                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="{{ route('admin.appointment.show', $appointment) }}">
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

            <div class="col-lg-12 mb-5 mb-xl-0 mt-5">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Appointment not yet done</h3>
                            </div>
                            @if (!$appointments_not_done->isEmpty())
                                <div class="col">
                                    <div class="form-group w-75 m-0 float-right">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                            </div>
                                            <input class="form-control" id="not-done-search" placeholder="Search by customer, by date, by starting date, ..." type="text">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($appointments_not_done->isEmpty())
                        <div class="alert alert-primary mb-0" role="alert">
                            <strong>Info!</strong> There are no appointments not already done!
                        </div>
                    @else
                        <div class="table-responsive table-appointments">
                            <div>
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Date of appointment</th>
                                            <th scope="col">Starts at</th>
                                            <th scope="col">Ends at</th>
                                            <th scope="col">Specified Message</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody class="list" id="not-done-list">
                                        @foreach ($appointments_not_done as $appointment)
                                            <tr>
                                                <th scope="row" class="customer">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <strong class="mb-0 text-sm">{{ idToFullname($appointment->user)->full_name }}</strong>
                                                        </div>
                                                    </div>
                                                </th>

                                                <th scope="row" class="takes_place_the">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">{{ formatDate($appointment->takes_place_the) }}</span>
                                                        </div>
                                                    </div>
                                                </th>

                                                <td class="starts_at">
                                                    <span class="badge badge-pill badge-primary"> {{ formatTime($appointment->starts_at) }}</span>
                                                </td>

                                                <td class="ends_at">
                                                    <span class="badge badge-pill badge-primary">{{ formatTime($appointment->ends_at) }}</span>
                                                </td>

                                                <td class="specified_message">
                                                    {!! backToLine(formatMessage($appointment->specified_message, 50)) !!}
                                                </td>

                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a class="dropdown-item" href="{{ route('admin.appointment.show', $appointment) }}">
                                                                <i class="fas fa-eye"></i> More...
                                                            </a>
                                                            <a class="dropdown-item mark-done-btn" href="{{ route('admin.appointment.done', $appointment) }}">
                                                                <i class="fas fa-check-circle"></i> Mark as Done
                                                                @csrf
                                                                <input type="hidden" id="id" value="{{ $appointment->id }}">
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
