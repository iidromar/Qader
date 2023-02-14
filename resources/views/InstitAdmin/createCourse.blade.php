@extends('layouts.InstitAdminLayouts')




@can('isInstitAdmin')
@section('styles')

<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,500,500i,600,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('InstitAdmin/css/studiare-assets.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('InstitAdmin/css/style.css') }}">



@endsection
@section('content')
<div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create a course</h4>

                    <form class="forms-sample" method="POST" action=" {{url('Instit/storeCourse')}} " enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                      @endif
                      <div class="form-group">
                        <label for="exampleInputName1">Title</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Title">
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <textarea class="form-control" name="description" id="exampleTextarea1" placeholder="Description" rows="4"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Category</label>
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

                      <div class="form-group">
                        <label for="exampleInputName1">Course date</label>
                        <input type="date"  name="course_date" class="form-control" id="exampleInputName1" min="{{ date("Y-m-d") }}">
                      </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Price</label>
                            <input type="number" class="form-control" name="price" min="0" id="exampleInputName1" placeholder="Price">
                        </div>
                      <div class="lesson-content" >
                     </div>
                      <div class="form-group">

                      <h1><a class='btn btn-primary' id="addfield" href="add-new-form">+Add a lesson</a></h1>
                      </div>

                      <div class="form-group" style="height:25px"></div>

                      <button type="submit" class="btn btn-primary">Submit</button>
											<button type="submit" class="btn btn-secondary">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>

          </div>
          <!-- content-wrapper ends -->

          @section('scripts')
  <script>
$(function () {
    var duplicates = -1,

        $original = $('.lesson-content').clone(true);

    function DuplicateForm () {
        var newForm;

        duplicates++;
        newForm = $original.clone(true).insertBefore($('h1'));



        $.each($('input', newForm), function(i, item) {
            $(item).attr('name', $(item).attr('name') + duplicates);
        });


        $('<h5>Lesson ' + (duplicates + 1) + '</h5>'+
        ' <div class="form-group">'+
        '<label for="exampleInputName1">Title</label>'+
        '<input type="text" name="names[]" class="form-control" id="exampleInputName1" placeholder="Title">'+
        ' </div>'+
        ' <div class="form-group">'+
        '<label for="exampleTextarea1">Description</label>'+
        '<textarea class="form-control" name="descriptions[]" id="exampleTextarea1" placeholder="Description" rows="4"></textarea>'+
        ' </div>'+
        ' <div class="form-group">'+
        '<label for="exampleInputName1">Video</label>'+
        '<input type="file" class="form-control" name="file[]" id="exampleInputName1" placeholder="Video">'+
        ' </div>'
        ).insertBefore(newForm);

    }

    $('a[href="add-new-form"]').on('click', function (e) {
        e.preventDefault();
        DuplicateForm();


    });
});
  </script>

  @endsection




   @endsection
   @endcan



