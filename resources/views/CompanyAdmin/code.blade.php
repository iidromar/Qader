@extends('layouts.CompanyAdminLayouts')
@can('isCompanyAdmin')
    @section('content')


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><strong>{{ $admin->name }}</strong>'s Company Code</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="" style="margin-left: 30px">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Share this code to your employees</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $admin->code }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>




            </div>
     <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <!-- /.container-fluid -->


    @endsection
@endcan
