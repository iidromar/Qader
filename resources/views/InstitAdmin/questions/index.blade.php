@extends('layouts.InstitAdminLayouts')

@can('isInstitAdmin')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    @if(Session::has('alert-success'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Fail! </strong>{{Session::get('alert-class', 'The quiz for this course already exist') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



    <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Quizzes') }}
                </h6>
                <div class="ml-auto">
                    <a href="{{ route('create.question') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">{{ __('New Quiz') }}</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable datatable-question" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>No</th>
                                <th>Course Name</th>
                                <th>Quiz Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $quiz)
                            <tr data-entry-id="{{ $quiz->id }}">
                                <td>

                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $quiz->course->name }}</td>
                                <td>{{ $quiz->name }}</td>
                                <td>
                                    <div class="row">
                                        <form action="{{ route('edit.question') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $quiz->id }}" id="eee" name="eee">
                                            <button type="submit" class="btn btn-info" style="margin-left: 10px">
                                                <i class="fa fa-pencil-alt"></i>
                                            </button>
                                        </form>

                                        <button type="button" class="me-2 btn bg-danger text-white" href="{{route('delete.question' ,$quiz->id)}}" data-toggle="modal" data-target="#deleteModal" style="margin-left: 20px">
                                                <i class="fa fa-trash"></i>
                                        </button>
{{--                                        <form onclick="return confirm('are you sure ? ')" class="d-inline" action="" method="POST">--}}
{{--                                        @method('Delete')--}}
{{--                          @csrf--}}
{{--                          {{ method_field('Delete') }}--}}
{{--                                            <button class="btn btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">--}}
{{--                                                <i class="fa fa-trash"></i>--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
                                    </div>
                                </td>
                            </tr>
                            <!-- delete Modal-->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Select "Delete" below if you want to delete the quiz.</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <a class="btn btn-danger" href="{{route('delete.question' ,$quiz->id)}}" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Delete</a>
                                        </div>
                                        <form id="delete-form" action="{{route('delete.question' ,$quiz->id)}}" method="POST" class="d-none">
                                            @method('Delete')
                                            @csrf
                                            {{ method_field('Delete') }}
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">{{ __('Data Empty') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <!-- Content Row -->

</div>
</br>
@endsection

@push('script-alt')
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = 'delete selected'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "#",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });
      if (ids.length === 0) {
        alert('zero selected')
        return
      }
      if (confirm('are you sure ?')) {
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  });
  $('.datatable-question:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endpush


@endcan










