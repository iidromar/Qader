@extends('layouts.InstitAdminLayouts')
@section('content')

    <div class="container">
        <div class="main-body">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
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
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Creation Date</h6>
                                <span class="text-secondary">{{ \Illuminate\Support\Facades\Auth::user()->created_at }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Password Updated</h6>
                                <span class="text-secondary">{{ \Illuminate\Support\Facades\Auth::user()->updated_at }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <form action="{{ route('changePasswordSendingEmployee') }}" method="POST">
                        @csrf
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="oldPasswordInput" class="form-label">Old Password</label>
                                    <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                           placeholder="Old Password">
                                    @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="newPasswordInput" class="form-label">New Password</label>
                                    <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                           placeholder="New Password">
                                    @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                                    <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                           placeholder="Confirm New Password">
                                </div>
                                <hr>

                                <div class="row">
                                    <div>
                                        <a class="btn btn-info" style="margin-right: 30px; margin-left: 10px;" href="{{ route('Employeeprofile') }}">Cancel</a>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                    </form>
                </div>
            </div>
        </div>




    </div>
    </div>

    </div>
    </div>

@endsection

