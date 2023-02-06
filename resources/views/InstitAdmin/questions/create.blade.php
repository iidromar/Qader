@extends('layouts.InstitAdminLayouts')

@can('isInstitAdmin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<!-- Content Row -->
        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h2 class="h3 mb-0 text-gray-800">{{ __('Create a Quiz') }}</h2>
                    <a href="{{route('course.question')}}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
            <form action="{{url('storeQuestion')}} " method="POST">
                @csrf
                    @method('POST')


                    <div class="form-group">
                        <label for="exampleSelectGender">Course</label>
                        <select name="course_id" class="form-control" id="exampleSelectGender">
                        <option value="" disabled selected>Choose Option</option>
                        @if(count($courses)>0)  
                        @foreach($courses as $course){
                                <option value="{{$course->id}}" >{{$course->name}}</option>
                            }
                            @endforeach
                            
                            @else
                            <option value=""  >No Courses</option>
                            @endif
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="question_text">{{ __('Quiz Name') }}</label>
                        <input type="text" class="form-control" id="question_text" placeholder="{{ __('Quiz Name') }}" name="Quiz_name" value="{{ old('Quiz_name') }}" required/>
                    </div>

                
                    <div class="lesson-content" ></div>
                      <div class="form-group">
                      <h1><a class='btn btn-primary' id="addfield" href="add-new-form">+Add a question</a></h1>
                      </div>  
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save') }}</button>
                </form>
            </div>
            </div> </div>
    
                        </br>

    <!-- Content Row -->



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

        
        $('<h5>Question ' + (duplicates + 1) + '</h5>'+ 
        ' <div class="form-group">'+
        ' <label for="question_text">{{ __('question text') }}</label>'+
        '<input type="text" class="form-control" id="question_text" placeholder="{{ __('question text') }}" name="question_text[]" value="{{ old('question_text') }}" required />'+
        ' </div>'+
        '<div class="row">'+
        '<div class="col-sm-6">'+
        ' <div class="form-group">'+
        '<label for="">Enter Option 1 (Right Answer)</label>'+
        '<input type="text" required="required" name="option_1[]" placeholder="Enter Question" class="form-control" required>'+
        ' </div>'+
        '</div>'+
        '<div class="col-sm-6">'+
        ' <div class="form-group">'+
        '<label for="">Enter Option 2 (False Answer)</label>'+
        '<input type="text" required="required" name="option_2[]" placeholder="Enter Option 2" class="form-control" required>'+
        ' </div>'+
        '</div>'+
        '<div class="col-sm-6">'+
        ' <div class="form-group">'+
        '<label for="">Enter Option 3 (False Answer)</label>'+
        '<input type="text" required="required" name="option_3[]" placeholder="Enter  Option 3" class="form-control" required>'+
        ' </div>'+
        '</div>'+
        '<div class="col-sm-6">'+
        ' <div class="form-group">'+
        '<label for="">Enter Option 4 (False Answer)</label>'+
        '<input type="text" required="required" name="option_4[]" placeholder="Enter  Option 4" class="form-control" required>'+
        ' </div>'+
        '</div>'+
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
