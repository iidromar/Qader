@extends('layouts.InstitAdminLayouts')

    @section('content')
        <!-- Internal Data table css -->

        @if(session()->has('Add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session()->has('Error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">


            <!--div-->
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">

                            <h4 class="card-title mg-b-0"><strong>{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong>'s Courses Requests</h4>

                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-2">Your Requests to make courses from the companies will be shown here:</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">

                                <thead>
                                <tr>
                                    <th class="border-bottom-0">Company Name</th>
                                    <th class="border-bottom-0">Course Title</th>
                                    <th class="border-bottom-0">Category</th>
                                    <th class="border-bottom-0">Sending Date</th>
                                    <th class="border-bottom-0">Deadline date</th>
                                    <th class="border-bottom-0">Actions</th>
                                    <th class="border-bottom-0">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $c = 0;
                                @endphp
                                @foreach($temp as $t)
                                    <tr>
                                        <td>{{ $names[$c] }}</td>
                                        <td>{{ $t->title }}</td>
                                        <td>{{ $t->category }}</td>
                                        <td>{{ $t->created_at }}</td>
                                        <td>{{ $t->receive_date }}</td>
                                        <td>
                                            <form action="{{ route('accepting_course') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $t->id }}" id="accepttt" name="accepttt">
                                                <button type="submit" class="modal-effect btn btn-outline-primary btn-block" style="margin-bottom: 20px">
                                                    Accept
                                                </button>
                                            </form>
                                            <form action="{{ route('rejecting_course') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $t->id }}" id="rejecttt" name="rejecttt">
                                                <button type="submit" class="modal-effect btn btn-outline-danger btn-block" >
                                                    Reject
                                                </button>
                                            </form>
{{--                                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" href="{{ route('accepting_course', ['id'=> $t->id]) }}">Accept</a>--}}
{{--                                            <a class="modal-effect btn btn-outline-danger btn-block" data-effect="effect-scale" href="{{ route('rejecting_course', ['id' => $t->id]) }}">Reject</a>--}}
                                        </td>
                                        <td>
                                            {{ $t->description }}
                                        </td>
                                        @php
                                            $c++;
                                        @endphp

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

