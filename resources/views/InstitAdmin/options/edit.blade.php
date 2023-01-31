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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('edit option')}}</h1>
                    <a href="{{ route('course.option') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Go Back') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('update.option', $option->id) }}" method="POST">
                    @csrf
                    @method('put')
                    
                    <div class="form-group">
                        <label for="exampleSelectGender">Question</label>
                        <select name="question_id" class="form-control" id="exampleSelectGender">
                        <option value="" disabled selected>Choose Option</option>
                        @foreach($questions as $question)
                                <option value="{{$question->id}}" {{$question->id == $option->question_id ? 'selected' : ''}} >{{$question->question_text}}</option>
                            @endforeach
                            
                      
                        </select>

                </div>

                    <div class="form-group">
                        <label for="option_text">{{ __('option text') }}</label>
                        <input type="text" class="form-control" id="option_text" placeholder="{{ __('option text') }}" name="option_text" value="{{ old('option_text', $option->option_text) }}" />
                    </div>
                    <div class="form-group">
                        <label for="points">{{ __('points') }}</label>
                        <input type="number" class="form-control" id="points" placeholder="{{ __('option text') }}" name="points" value="{{ old('points', $option->points) }}" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Save')}}</button>
                </form>
            </div>
        </div>
    

    <!-- Content Row -->

</div>
@endsection
   
@endcan