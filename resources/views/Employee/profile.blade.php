@extends('layouts.EmployeeLayouts')
@section('content')

    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">{{ \Illuminate\Support\Facades\Auth::user()->name }}'s Profile</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <i class="fas fa-fw fa-user fa-4x"></i>
                                <div class="mt-3">
                                    <h4>{{ \Illuminate\Support\Facades\Auth::user()->name }}</h4>
                                    <p class="text-secondary mb-1">{{ \Illuminate\Support\Facades\Auth::user()->email }}</p>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Code</h6>
                                <span class="text-secondary">{{ \Illuminate\Support\Facades\Auth::user()->code }}</span>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ \Illuminate\Support\Facades\Auth::user()->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Position</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ \Illuminate\Support\Facades\Auth::user()->position }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Office</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ \Illuminate\Support\Facades\Auth::user()->office }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Age</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ \Illuminate\Support\Facades\Auth::user()->age }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Account Created At</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ \Illuminate\Support\Facades\Auth::user()->created_at }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Last Password Modification</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ \Illuminate\Support\Facades\Auth::user()->updated_at }}
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-info" href="{{ route('changePasswordEmployee') }}">Change Password</a>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>

@endsection

