@extends('layouts.CompanyAdminLayouts')
@can('isCompanyAdmin')
    @section('content')
        <!-- Internal Data table css -->



        <div class="row">


            <!--div-->
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">

                            <h4 class="card-title mg-b-0"><strong>{{ $admin->name }}</strong>'s Requested Courses</h4>

                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-2">You can track all the requests here: </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">

                                <thead>
                                <tr>
                                    <th class="border-bottom-0">Institution Name</th>
                                    <th class="border-bottom-0">Course title</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Deadline for receiving</th>
                                    <th class="border-bottom-0">Accepted/Rejected Status</th>
                                    <th class="border-bottom-0">Accepted/Rejected Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $c = 0;
                                @endphp
                                @foreach($requests as $r)
                                    <tr>
                                        <td>{{ $instit[$c] }}</td>
                                        <td>{{ $r->title }}</td>
                                        <td>{{ $r->category }}</td>
                                        <td>{{ $r->receive_date }}</td>
                                        @if($r->accepted == '0')
                                            <td>No Action on it</td>
                                        @elseif($r->accepted == '1')
                                                <td>Accepted</td>
                                        @elseif($r->accepted == '2')
                                                <td>Rejected</td>
                                        @endif
                                            @if($r->accepted == '0')
                                                <td>No Action Date</td>
                                            @elseif($r->accepted == '1')
                                                <td>{{ $r->accepted_date }}</td>
                                            @elseif($r->accepted == '2')
                                            <td>{{ $r->accepted_date }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" href="{{ route('give_training', [$e->id]) }}">Add Training</a>
                                        </td>
                                            <td></td>

                                    </tr>
                                    @endif
                                    @php
                                        $c = $c +1
                                    @endphp
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
