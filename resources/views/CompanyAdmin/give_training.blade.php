@extends('layouts.CompanyAdminLayouts')
@can('isCompanyAdmin')
    @section('content')
        @if(session()->has('Add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add') }}</strong>
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
        <!-- row -->
        <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">New Training for <strong>{{ $employee->name }}</strong></h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-2">Please fill the form below:</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('new_training_req', ['id' => $employee->id]) }}" method="post" enctype="multipart/form-data"
                              autocomplete="off">
                            @csrf
                            {{ csrf_field() }}
                            {{-- 1 --}}

                            <input type="hidden" value="" id="hiddenOneValue" name="hiddenOneValue">
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputName1">Training Category</label>
                                    <select name="category" class="form-control SelectBox" id="exampleInputName1" onclick="" onchange="" required>
                                        <option value="" selected disabled>
                                            Choose Category:
                                        </option>
                                        @foreach($options as $o)
                                            <option value="{{ $o }}">{{ $o }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="exampleInputName1">Training Courses</label>
                                    <select name="items" class="form-control SelectBox" id="items" onclick="" onchange="" required>
                                        <option value="" selected disabled>
                                            Choose Course:
                                        </option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label>Deadline</label>
                                    <input class="form-control " name="deadline_Date" placeholder="YYYY-MM-DD"
                                           type="date" value="" required>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">Course Brief:</label>
                                    <input type="text" class="form-control" id="brief" name="brief" value="" readonly>
                                </div>
                            </div>
                            {{-- 4 --}}

                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" value="" readonly>
                                </div>

                                <div class="col">
                                    <label for="inputName" class="control-label">Price with VAT:</label>
                                    <input type="text" class="form-control" id="total" name="total" readonly>
                                </div>
                            </div>


                            <br>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Send Training</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>

        </div>

        <!-- row closed -->


    @endsection
@endcan
