@extends('layouts.InstitAdminLayouts')

@can('isInstitAdmin')



@section('styles')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>

    @endsection

 @section('content')

    <!-- partial -->
        <div class="main-panel" >
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit the course</h4>

                   <form class="forms-sample" method="post" action=" {{ route('Instit.update' ,  $courses->id) }} " enctype="multipart/form-data">
                   @csrf
                    {{ method_field('PUT') }}
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
                        <input type="text" class="form-control" name="name" value="{{old('name') ?? $courses->name}} "  id="exampleInputName1" placeholder="Title">
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <textarea class="form-control" name="description" value="" id="exampleTextarea1" placeholder="Description" rows="4">{{old('description') ?? $courses->description}} </textarea>
                      </div>
                       <div class="form-group">
                           <label for="exampleInputName1">Category</label>
                           <select name="category" class="form-control SelectBox" id="exampleInputName1" onclick="" onchange="" required>
                               <option value="{{old('category') ?? $courses->category}} " selected>
                                   {{old('category') ?? $courses->category}}
                               </option>
                               @foreach($options as $o)
                                   @if($o != $courses->category)
                                   <option value="{{ $o }}">{{ $o }}
                                   </option>
                                   @endif
                               @endforeach
                           </select>
                       </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Course date</label>
                        <input type="date"  name="course_date"  value="{{ old('course_date', date($courses->course_date)) }}" class="form-control" id="exampleInputName1" >
                      </div>
                       <div class="form-group">
                           <label for="exampleInputName1">Price</label>
                           <input type="number" class="form-control" min="0" value="{{ old('price', $courses->price) }}"name="price" id="exampleInputName1" placeholder="Price">
                       </div>

                      @if( $lessons->count()>0)

                      @foreach($lessons as $lesson)
                      <h5>Lesson {{ $loop->index +1}}</h5>
                      <input type="text" name="id[]" value="{{ $lesson['id'] }}" style="display: none"/>
                      <div class="form-group">
                    <label for="exampleInputName1">Title</label>
                    <input type="text" name="names[]" value="{{old('names') ?? $lesson['names']}} " class="form-control" id="exampleInputName1" placeholder="Category">
                   </div>
                    <div class="form-group">
                    <label for="exampleTextarea1">Description</label>
                    <textarea class="form-control" name="descriptions[]" value="" id="exampleTextarea1" placeholder="Description" rows="4">{{old('descriptions') ?? $lesson['descriptions']}} </textarea>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputName1">Video</label>
                    <input type="file" class="form-control" name="file[]" value="" id="exampleInputName1" placeholder="Video">
                    <video width="700px" height="500px" controls>
                    <source src="{{asset('/storage/instit/courses')}}/{{$lesson['video']}}" type="video/mp4">
                    </video>
                  </div>

                       @endforeach
                      @endif
                      <div class="lesson-content" >
                     </div>
                      <div class="form-group">
                      <h1><a class='btn btn-sm btn-primary inner' id="addfield" href="add-new-form">+Add a lesson</a></h1>
                    </div>



	<!-- Button trigger modal -->
  <button type="button" class="btn btn-primary me-2" data-toggle="modal" data-target="#exampleModal">
  <img width="24" height="24" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB/klEQVR4nO2ZzS5EMRiGu7JkxM9FmD0S1sRPJIOluQbBwnaWFsIOscfa3zUIJm4BV8AOs3mk9Ew69JxpZ3rameS8SZf9+j79vvacfBWiUKFUAdPAthpTol8ElIBb/usGGBK9LGAYqBvMNyFEH5tPNOUScF3V4K6HsSljZqxXxU7b7YyPA6dAA/86b7P2TlcAQBl4JT+dGbI85wgxmbXzf83fAQfAnochjZUMNd8AVi0hrrN2X5ZNojdgQYQ7sA0LiLq+AaaAes2HNG8DUc+6AIS6bRLdRTCfBVHNNG9I134k86kQNsFrzelQi2heh5jvCQD1b/OAm56AkegAQcznBRDMfB4AQc37BujgwP6751WMCzVKwQB8mJdSf8CJtkQIAGAAeOzWfEd+PAFs+DAfE+DK14ElNAAwCHz4MB8LoOrzqiQCwJXPe56QAKp8PtuYf2z7SxwRoJJiWkJdqttpwDFmLSTATIrpQZc4sc/ALLDSjeno3wGfogCILIoMRBZFBvowAzt5N7ZcxG9D2e49QE1YC9FatBVwr/mp2HYR9ObuYhCnBgHLmo8v64c94ESb+A4siTjm3zUfRy6Tx4AXWnWv6nE353Fo6CM9A6OuO1A2QMTQMzDRQRJ/IEaBY1V/ofUly8Z551NAhmSfXjaWPL2RZY0ttVZvv8QXEq36BhSarkfwlJB4AAAAAElFTkSuQmCC">

					</button>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Edit the course</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							Are you sure? do you want to edit the course
						</div>
						<div class="modal-footer">
            <button type="submit" class="btn btn-primary me-2">					<img width="24" height="24" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB/klEQVR4nO2ZzS5EMRiGu7JkxM9FmD0S1sRPJIOluQbBwnaWFsIOscfa3zUIJm4BV8AOs3mk9Ew69JxpZ3rameS8SZf9+j79vvacfBWiUKFUAdPAthpTol8ElIBb/usGGBK9LGAYqBvMNyFEH5tPNOUScF3V4K6HsSljZqxXxU7b7YyPA6dAA/86b7P2TlcAQBl4JT+dGbI85wgxmbXzf83fAQfAnochjZUMNd8AVi0hrrN2X5ZNojdgQYQ7sA0LiLq+AaaAes2HNG8DUc+6AIS6bRLdRTCfBVHNNG9I134k86kQNsFrzelQi2heh5jvCQD1b/OAm56AkegAQcznBRDMfB4AQc37BujgwP6751WMCzVKwQB8mJdSf8CJtkQIAGAAeOzWfEd+PAFs+DAfE+DK14ElNAAwCHz4MB8LoOrzqiQCwJXPe56QAKp8PtuYf2z7SxwRoJJiWkJdqttpwDFmLSTATIrpQZc4sc/ALLDSjeno3wGfogCILIoMRBZFBvowAzt5N7ZcxG9D2e49QE1YC9FatBVwr/mp2HYR9ObuYhCnBgHLmo8v64c94ESb+A4siTjm3zUfRy6Tx4AXWnWv6nE353Fo6CM9A6OuO1A2QMTQMzDRQRJ/IEaBY1V/ofUly8Z551NAhmSfXjaWPL2RZY0ttVZvv8QXEq36BhSarkfwlJB4AAAAAElFTkSuQmCC">
</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="24" height="24"
viewBox="0,0,256,256"
style="fill:#000000;">
<g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M25,2c-12.681,0 -23,10.319 -23,23c0,12.681 10.319,23 23,23c12.681,0 23,-10.319 23,-23c0,-12.681 -10.319,-23 -23,-23zM33.71,32.29c0.39,0.39 0.39,1.03 0,1.42c-0.2,0.19 -0.45,0.29 -0.71,0.29c-0.26,0 -0.51,-0.1 -0.71,-0.29l-7.29,-7.29l-7.29,7.29c-0.2,0.19 -0.45,0.29 -0.71,0.29c-0.26,0 -0.51,-0.1 -0.71,-0.29c-0.39,-0.39 -0.39,-1.03 0,-1.42l7.29,-7.29l-7.29,-7.29c-0.39,-0.39 -0.39,-1.03 0,-1.42c0.39,-0.39 1.03,-0.39 1.42,0l7.29,7.29l7.29,-7.29c0.39,-0.39 1.03,-0.39 1.42,0c0.39,0.39 0.39,1.03 0,1.42l-7.29,7.29z"></path></g></g>
</svg></button>
							</div>
							</div>
						</div>
						</div>







                      <a class='btn btn-secondary' href="{{route('Instit.show' ,$courses->id)}}"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="24" height="24"
viewBox="0,0,256,256"
style="fill:#000000;">
<g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M25,2c-12.681,0 -23,10.319 -23,23c0,12.681 10.319,23 23,23c12.681,0 23,-10.319 23,-23c0,-12.681 -10.319,-23 -23,-23zM33.71,32.29c0.39,0.39 0.39,1.03 0,1.42c-0.2,0.19 -0.45,0.29 -0.71,0.29c-0.26,0 -0.51,-0.1 -0.71,-0.29l-7.29,-7.29l-7.29,7.29c-0.2,0.19 -0.45,0.29 -0.71,0.29c-0.26,0 -0.51,-0.1 -0.71,-0.29c-0.39,-0.39 -0.39,-1.03 0,-1.42l7.29,-7.29l-7.29,-7.29c-0.39,-0.39 -0.39,-1.03 0,-1.42c0.39,-0.39 1.03,-0.39 1.42,0l7.29,7.29l7.29,-7.29c0.39,-0.39 1.03,-0.39 1.42,0c0.39,0.39 0.39,1.03 0,1.42l-7.29,7.29z"></path></g></g>
</svg></a>

                    </form></div>
                </div>
              </div>

              </div>
            </div>
          </div>



          @section('scripts')

          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"> </script>
    <script>
$(function () {
    var duplicates = 0,

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
        '<input type="text" name="title[]" class="form-control" id="exampleInputName1" placeholder="Title" required>'+
        ' </div>'+
        ' <div class="form-group">'+
        '<label for="exampleTextarea1">Description</label>'+
        '<textarea class="form-control" name="des[]" id="exampleTextarea1" placeholder="Description" rows="4"></textarea required>'+
        ' </div>'+
        ' <div class="form-group">'+
        '<label for="exampleInputName1">Video</label>'+
        '<input type="file" class="form-control" name="files[]" id="exampleInputName1" placeholder="Video" required>'+
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
