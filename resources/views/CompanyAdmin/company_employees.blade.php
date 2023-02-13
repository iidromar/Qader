@extends('layouts.CompanyAdminLayouts')
@can('isCompanyAdmin')
    @section('title', 'All Employee')

    @section('content')
        <!-- Internal Data table css -->



        <div class="row">


                <!--div-->
                <div class="col-xl-12">
                    <div class="card mg-b-20">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">

                                    <h4 class="card-title mg-b-0"><strong>{{ $comp->name }}</strong> Employees</h4>

                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
                            <p class="tx-12 tx-gray-500 mb-2">Your Company Unique ID is: <strong>{{ \Illuminate\Support\Facades\Auth::user()->code }}</strong>, please give it to your employees when they register.</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table key-buttons text-md-nowrap">

                                    <thead>
                                    <tr>
                                        <th class="border-bottom-0">Employee Name</th>
                                        <th class="border-bottom-0">Position</th>
                                        <th class="border-bottom-0">Office</th>
                                        <th class="border-bottom-0">Age</th>
                                        <th class="border-bottom-0">Registration date</th>
                                        <th class="border-bottom-0">Courses taken</th>
                                        <th class="border-bottom-0">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($emp as $e)
                                    <tr>
                                        <td>{{ $e->name }}</td>
                                        <td>{{ $e->position }}</td>
                                        <td>{{ $e->office }}</td>
                                        <td>{{ $e->age }}</td>
                                        <td>{{ $e->created_at }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" href="{{ route('employee_progress', [$e->id]) }}">View</a>
                                        </td>
                                        <td>
                                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" href="{{ route('give_training', [$e->id]) }}">Add Training</a>
                                        </td>

                                    </tr>
                                    @endforeach


                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
        </div>

    @endsection
@endcan
