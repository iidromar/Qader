@extends('layouts.EmployeeLayouts')

@can('isEmployee')
    @section('styles')

    @endsection
    @section('content')

        <div class="container">
            @if($events)
                @foreach($events as $event)
                    <div class="card my-4">

                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="{{ asset('HomePageFrontend/images/course_'.($loop->index+1).'.jpg') }}" alt="Bootstrap Tamil cyberdude"
                                     class="card-img h-100" />
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{$event['title']}}</h5>
                                    <p class="card-text">
                                        <span class="badge badge-pill badge-success"> <i class="fa fa-television"></i> {{$event['creator']}} </span><span class="badge badge-primary">{{$event['category']}}</span>

                                    </p>
                                    <p class="card-text">
                                        {{$event['description']}}
                                    </p>
                                    <div class="progress" style="width: 25%;">
                                        @php
                                            $presentage = 0;
                                            if($event['lessonNum'] != 0){
                                                $presentage = ($event['progNum'] /$event['lessonNum']) *100;
                                            }

                                        @endphp

                                        <div class="progress-bar" role="progressbar" style="width: <?= $presentage; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{$presentage}}% </div>
                                    </div>
                                    Completed
                                    <div class="mb-5">
                                        <p class="card-text float-right">
                                            <small class="text-muted"> <i class="fa fa-clock-o"></i> Cteated at {{$event['date']}}</small>
                                        </p>
                                    </div>
                                    <a class="btn btn-primary btn-block" href="{{route('employee.courseDetails' , $event['id'])}}">
                                        Start The Course
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            @else

                <div class="row no-gutters">
                    <div class="col-md-4">
                        <h2 style="color:red;">No Courses</h2>
                    </div>
                </div>

            @endif
        </div>



        @section('scripts')

        @endsection

    @endsection
@endcan
