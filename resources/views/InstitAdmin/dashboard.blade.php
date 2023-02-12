@extends('layouts.InstitAdminLayouts')

@can('isInstitAdmin')
@section('content')


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><strong>{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong>'s Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Maid Courses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $maid }}{{ $maid == 1? ' Course': ' Courses' }} </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-laptop fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $earnings }} Riyals</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{--        <!-- Earnings (Monthly) Card Example -->--}}
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card border-left-info shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks--}}
{{--                            </div>--}}
{{--                            <div class="row no-gutters align-items-center">--}}
{{--                                <div class="col-auto">--}}
{{--                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <div class="progress progress-sm mr-2">--}}
{{--                                        <div class="progress-bar bg-info" role="progressbar"--}}
{{--                                             style="width: 50%" aria-valuenow="50" aria-valuemin="0"--}}
{{--                                             aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $no_action }}{{ $no_action == 1? ' Request': ' Requests' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Approved Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $approved }}{{ $approved == 1? ' Request': ' Requests' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Rejected Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rejected }}{{ $rejected == 1? ' Request': ' Requests' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-outdent fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Quizzes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $quizzes }}{{ $quizzes == 1? ' Quiz': ' Quizzes' }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-question-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">


    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Earnings Courses</h6>
                </div>
                @php
                $c = 1;
                @endphp
                @foreach($topFive as $t)
                <div class="card-body">
                    <h6 class=" font-weight-bold">{{{ $c }}}: {{ $t->name }}<span
                            class="float-right">{{ number_format($t->price, 2) }} Riyals</span></h6>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="{{ $prices }}"></div>
                    </div>                    </div>

                    @php
                        $c++;
                    @endphp
                    @endforeach
</div>
        </div>

        <div class="col-lg-6 mb-4">

@php
$c =0;
@endphp
            <!-- Illustrations -->
                <!-- Color System -->
                <div class="row">

                    @foreach($topCourses as $tc)
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                                Course: {{ $tc->name }}
                                <div class="text-white-50 small">Number of Employees taking: {{ $countAll[$c] }}</div>
                            </div>
                        </div>
                    </div>
                        @php
                        $c++;
                        @endphp
                    @endforeach

                </div>
            </div>



        </div>


    <!-- /.container-fluid -->


@endsection
@endcan
