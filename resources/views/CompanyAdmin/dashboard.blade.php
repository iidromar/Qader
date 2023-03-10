@extends('layouts.CompanyAdminLayouts')
@can('isCompanyAdmin')
@section('content')


                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><strong>{{ Auth::user()->name }}</strong>'s Dashboard</h1>
                        <a href="{{ route('all_employees') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                                                Courses Scheduled</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $counter_of_courses_scheduled }}{{ $counter_of_courses_scheduled == 1? ' Course': ' Courses' }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                                                Paid Invoices</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $invoices }} SAR</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                                                Paid Invoices with VAT</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $vat }} SAR</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"> EMPLOYEES Progress
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $calcProg }}%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: {{ $calcProg }}%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Courses Requested</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data_requested }}{{ $data_requested == 1? ' Request': ' Requests' }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
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
                                                Total Employees</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totemp }}{{ $totemp == 1? ' Employee': ' Employees' }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-person-booth fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Paid Invoices Overview</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <input type="hidden" id="jan" value="{{ $jan }}">
                                        <input type="hidden" id="feb" value="{{ $feb }}">
                                        <input type="hidden" id="mar" value="{{ $mar }}">
                                        <input type="hidden" id="apr" value="{{ $apr }}">
                                        <input type="hidden" id="may" value="{{ $may }}">
                                        <input type="hidden" id="jun" value="{{ $jun }}">
                                        <input type="hidden" id="jul" value="{{ $jul }}">
                                        <input type="hidden" id="aug" value="{{ $aug }}">
                                        <input type="hidden" id="sep" value="{{ $sep }}">
                                        <input type="hidden" id="oct" value="{{ $oct }}">
                                        <input type="hidden" id="nov" value="{{ $nov }}">
                                        <input type="hidden" id="dec" value="{{ $dec }}">

                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Requested Courses</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <input type="hidden" id="accepted_req" value="{{ $accepted_req }}">
                                    <input type="hidden" id="rejected_req" value="{{ $rejected_req }}">
                                    <input type="hidden" id="no_action" value="{{ $no_action }}">

                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Accepted
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Rejected
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> No Action
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <!-- /.container-fluid -->


@endsection
@endcan
