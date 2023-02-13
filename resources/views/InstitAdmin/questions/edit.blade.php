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
                    <h3 class="h3 mb-0 text-gray-800">{{ __('edit Quiz')}}</h3>
                    <a href="{{route('course.question')}}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('update.question', $quiz->id) }}" method="POST">
                    @csrf
                    @method('put')


                    <div class="form-group">
                        <label for="exampleSelectGender">Course</label>
                        <select name="course_id" class="form-control" id="exampleSelectGender">
                        <option value="" disabled selected>Choose Option</option>
                        @foreach($courses as $course)
                                <option value="{{$course->id}}" {{$course->id == $quiz->course_id ? 'selected' : ''}} >{{$course->name}}</option>
                            @endforeach


                        </select>

                </div>

                    <div class="form-group">
                        <label for="question_text">{{ __('Quiz Name') }}</label>
                        <input type="text" class="form-control" id="name" placeholder="{{ __('Quiz Name') }}" name="Quiz_name" value="{{ old('name', $quiz->name) }}" required />
                    </div>



                @if( $questions->count()>0)
                  @foreach($questions as $question)

                  <div class="form-group">
                        <label for="question_text">{{ __('question text') }}</label>
                        <input type="text" class="form-control" id="question_text" placeholder="{{ __('question text') }}" name="question_text[]" value="{{ old('question_text', $question->question_text) }}" required />
                        <input type="hidden" name="id_qustion[]" placeholder="Enter Question" class="form-control" value="{{ $question->id}} " >

                    </div>
                    <div class="row">

                    @foreach($options as $option)

                    @if( $option->question_id==$question->id)
                    @if(  $option['points']==1)
                    @php  $index=1   @endphp
                <div class="col-sm-6">
                    <div class="form-group">

                        <label for="">Enter Option  {{ $index }} (Right Answer)</label>
                        <input type="text" required="required" name="option_{{ $index }}[]" placeholder="Enter Question" class="form-control" value="{{ old('option_text', $option['option_text']) }} " required>
                        <input type="hidden" name="id_option_{{ $index }}[]" placeholder="Enter Question" class="form-control" value="{{ $option['id']}} " >
                    </div>
                </div>
                @else
                @php    $index++   @endphp


                <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Enter Option {{ $index }}  (False Answer)</label>
                            <input type="text" required="required" name="option_{{ $index }}[]" placeholder="Enter Question" class="form-control" value="{{ old('option_text',  $option['option_text']) }} " required>
                            <input type="hidden"  name="id_option_{{ $index }}[]" placeholder="Enter Option 2" class="form-control" value="{{ $option['id']}} " >
                        </div>
                    </div>
                    @endif
                    @endif

                    @endforeach
                    </div>
                @endforeach

                      @endif
                      <div class="lesson-content" ></div>
                      <div class="form-group">
                      <h1><a class='btn btn-primary' id="addfield" href="add-new-form">+Add a question</a></h1>
                      </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
                </form>
            </div>
        </div>


    <!-- Content Row -->

</div>

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


        $(
        ' <div class="form-group">'+
        ' <label for="question_text">{{ __('question text') }}</label>'+
        '<input type="text" class="form-control" id="question_txt" placeholder="{{ __('question text') }}" name="question_txt[]" value="{{ old('question_text') }}" required />'+
        ' </div>'+
        '<div class="row">'+
        '<div class="col-sm-6">'+
        ' <div class="form-group">'+
        '<label for="">Enter Option 1 (Right Answer)</label>'+
        '<input type="text" required="required" name="opt_1[]" placeholder="Enter Question" class="form-control"> required'+
        ' </div>'+
        '</div>'+
        '<div class="col-sm-6">'+
        ' <div class="form-group">'+
        '<label for="">Enter Option 2 (False Answer)</label>'+
        '<input type="text" required="required" name="opt_2[]" placeholder="Enter Option 2" class="form-control" required>'+
        ' </div>'+
        '</div>'+
        '<div class="col-sm-6">'+
        ' <div class="form-group">'+
        '<label for="">Enter Option 3 (False Answer)</label>'+
        '<input type="text" required="required" name="opt_3[]" placeholder="Enter  Option 3" class="form-control" required>'+
        ' </div>'+
        '</div>'+
        '<div class="col-sm-6">'+
        ' <div class="form-group">'+
        '<label for="">Enter Option 4 (False Answer)</label>'+
        '<input type="text" required="required" name="opt_4[]" placeholder="Enter  Option 4" class="form-control" required>'+
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
