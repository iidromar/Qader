@extends('layouts.CompanyAdminLayouts')

@can('isCompanyAdmin')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->


    <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    Results
                </h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap">
                        <thead>
                        <tr>
                            <th class="border-bottom-0">No</th>
                            <th class="border-bottom-0">User</th>
                            <th class="border-bottom-0">Points</th>
                            <th class="border-bottom-0">Course Name</th>
                            <th class="border-bottom-0">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(count($users)>0)
                           @foreach($users as $user)
                           @if(count($user->userResults)>0)
                           @foreach($user->userResults as $result)

                            <tr data-entry-id="{{ $result->id }}">

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                @php
                                $presentage = ($result->total_points /count($result->questions)) *100;
                                @endphp
                                <td>{{number_format($presentage, 1, '.' ,'') }} %</td>
                                <td>

                                      {{  $result->course->name }}

                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('show.Result', $result->id) }}" class="btn btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="dropdown-item btn bg-danger text-white" href="{{ route('delete.Result', $result->id) }}" data-toggle="modal" data-target="#deleteModal" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <!-- delete Modal-->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Select "Delete" below if you want to delete the result.</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <a class="btn btn-danger" href="{{ route('delete.Result', $result->id) }}" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Delete</a>
                                        </div>
                                        <form id="delete-form" action="{{ route('delete.Result', $result->id) }}" method="POST" class="d-none">
                                            @method('Delete')
                                            @csrf
                                            {{ method_field('Delete') }}
                                        </form>
                                    </div>
                                </div>
                            </div>

                           @endforeach
                            @endif
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    <!-- Content Row -->

</div>
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
  $('.datatable-result:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endpush
    @endcan
