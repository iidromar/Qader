@extends('layouts.CompanyAdminLayouts')
@can('isCompanyAdmin')
    @section('content')

        <div class="row">


            <!--div-->
            <div class="col-xl-12">
                <div class="card mg-b-20">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">Employee Progress</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-2">You can filter the results by search input</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table key-buttons text-md-nowrap">

                                <thead>
                                <tr>
                                    <th class="border-bottom-0">Employee Name</th>
                                    <th class="border-bottom-0">Course Name</th>
                                    <th class="border-bottom-0">Start date</th>
                                    <th class="border-bottom-0">Percentage Done</th>
                                    <th class="border-bottom-0">Deadline</th>
                                    <th class="border-bottom-0">Price</th>
                                    <th class="border-bottom-0">Notes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($temp as $t)
                                <tr>
                                    <td>{{ $t-> }}</td>
                                    <td>{{$id}}</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">View</a>
                                    </td>
                                    <td>
                                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">-</a>
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
