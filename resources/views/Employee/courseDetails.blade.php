@extends('layouts.EmployeeLayouts')

@can('isEmployee')
    @section('styles')

        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,500,500i,600,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('InstitAdmin/css/studiare-assets.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('InstitAdmin/css/style.css') }}">

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @endsection
    @section('content')

        <!-- Container -->
        <div id="container">
            <!-- Header
                ================================================== -->
            @if($courses)
                <!-- page-banner-section
			================================================== -->
                <section class="page-banner-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10">
                                <h1>{{$courses->name}}</h1>
                                <span data-important="{{$courses->id}}" id="courseId"></span>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End page-banner-section -->

                <!-- single-course-section
                    ================================================== -->
                <section class="single-course-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10">

                                <div class="single-course-box">

                                    <!-- single top part -->
                                    <div class="product-single-top-part">
                                        <div class="product-info-before-gallery">
                                            <div class="course-author before-gallery-unit">
                                                <div class="icon">
                                                </div>
                                                <div class="info">
                                                    <span class="label">Teacher</span>
                                                    <div class="value">
                                                        <a href="">{{$creatorName[0]['creator']}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-category before-gallery-unit">
                                                <div class="icon">

                                                </div>
                                                <div class="info">
                                                    <span class="label">Category</span>
                                                    <div class="value">
                                                        <a href="">{{$courses->category}} </a>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-category before-gallery-unit">
                                                <div class="icon">

                                                </div>
                                                <div class="info">
                                                    <span class="label">Lessons</span>
                                                    <div class="value">
                                                        @if($lessons)
                                                            <a href="#">{{count($lessons)}} Lessons</a>
                                                        @else
                                                            <a href="#">0 Lesson</a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="course-single-gallery">
                                            <img src="{{ asset('HomePageFrontend/images/sample.png') }}" alt="">
                                        </div>

                                    </div>

                                    <!-- single course content -->
                                    <div class="single-course-content">
                                        <h2>Course Description</h2>
                                        <p>{{$courses->description}}</p>

                                        @if($lessons)
                                            <!-- course section -->
                                            @foreach($lessons as $lesson)
                                                <div class="course-section">
                                                    <h3>{{$loop->index+1}}. Lesson</h3>
                                                    <div class="panel-group">
                                                        <div class="course-panel-heading">
                                                            <div class="panel-heading-left">
                                                                <div class="course-lesson-icon">
                                                                    <i class="fa fa-play-circle-o"></i>
                                                                </div>
                                                                <div class="title">
                                                                    <h4>{{ $lesson['names'] }}  <span class="badge-item video">video</span>
                                                                    </h4>
                                                                    @php
                                                                        $lessonId=$lesson->id;
                                                                        $empId=auth()->user()->id;
                                                                    @endphp
                                                                    <p class="subtitle" id="duration{{$loop->index}}"></p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="panel-content">
                                                            <div class="panel-content-inner">
                                                                <p>{{ $lesson['descriptions'] }}</p>
                                                                <!-- Button trigger modal -->

                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$loop->index}}" id="{{$loop->index}}"  disabled>
                                                                    Watch The Lesson
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade bd-example-modal-lg" id="exampleModal{{$loop->index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$loop->index}}" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel{{$loop->index}}">{{ $lesson['names'] }} </h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>

                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <video width="760px" height="500px" controls id="video{{$loop->index}}">
                                                                                    <source src="{{asset('/storage/instit/courses')}}/{{$lesson['video']}}" type="video/mp4">
                                                                                </video>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>

                                                <span data-important="{{$lessonId}}" id="lessonId{{$loop->index}}"></span>
                                                <span data-important="{{$empId}}" id="empId{{$loop->index}}"></span>
                                                <span data-important="{{sizeof($lessons)}}" id="lastSpan"></span>

                                                <!-- end course section -->
                                            @endforeach
                                        @endif
                                        @endif


                                        <!-- course section-->
                                        <div class="course-section">
                                            <h3>Quiz Sections</h3>
                                            <div class="panel-group">
                                                <div class="course-panel-heading">
                                                    <div class="panel-heading-left">
                                                        <div class="course-lesson-icon">
                                                            <i class="fa fa-question-circle"></i>
                                                        </div>
                                                        <div class="title">
                                                            <h4> Course &amp; Practice <span class="badge-item quiz">quiz</span></h4>
                                                            <p class="subtitle">Course quiz</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-content">

                                                        @if(sizeof($results)==0 && sizeof($quiz)!=0)
                                                        <div class="panel-content-inner" id="already_taken">Please finish the lessons before taking the quiz</div>
                                                        <div class="panel-content-inner"> <a class="btn btn-primary" id="quizbtn" style="display:none;" href="{{route('client.test' ,$courses->id)}}" >Start Quiz</a></div>
                                                        @elseif(sizeof($results)>0 && sizeof($quiz) !=0)
                                                            <div class="panel-content-inner">You Already Took The Quiz</div>
                                                    @else
                                                        <div class="panel-content-inner">No Quiz</div>
                                                    @endif</div>
                                                <div class="course-panel-heading">
                                                    <div class="panel-heading-left">
                                                        <div class="course-lesson-icon">
                                                            <i class="fa fa-trophy"></i>
                                                        </div>
                                                        <div class="title">
                                                            <h4>Quiz Result</h4>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-content">

                                                    @if(sizeof($results)!=0)
                                                        <div class="panel-content-inner">Your Quiz Result: {{ $results[0]->total_points }} Out Of {{count($results[0]->questions)}}</div>
                                                    @else
                                                        <div class="panel-content-inner">No Result</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end course section -->

                                    </div>
                                    <!-- end single course content -->


                                </div>
                                <div class="ml-auto">
                                    <a href="{{ route('employee.allCourses'  , auth()->user()->id)}}" class="btn btn-primary">
                                        <span class="text">{{ __('Go Back') }}</span>
                                    </a>
                                </div>
                            </div>


                        </div>

                    </div>

                </section>
                <!-- End single-course section -->


        </div>



        @section('scripts')
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

            <script src="{{ asset('InstitAdmin/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('InstitAdmin/js/gmap3.min.js') }}"></script>
            <script src="{{ asset('InstitAdmin/js/jquery.countTo.js') }}"></script>
            <script src="{{ asset('InstitAdmin/js/popper.js') }}"></script>
            <script src="{{ asset('InstitAdmin/js/script.js') }}"></script>
            <script src="{{ asset('InstitAdmin/js/studiare-plugins.min.js') }}"></script>
            <script src="http://maps.google.com/maps/api/js?key=AIzaSyCiqrIen8rWQrvJsu-7f4rOta0fmI5r2SI&amp;sensor=false&amp;language=en"></script>
            <script>
                $(document).ready(function() {

                    //check if video has been watched
                    var prog = @json($prog);
                    console.log(prog.length);
                    var lastSpan = document.getElementById("lastSpan").dataset.important;
                    var intLastSpan=parseInt(lastSpan);
                    var progLength=prog.length;
                    if(intLastSpan==progLength){
                        document.getElementById("quizbtn").style.display="block";
                        document.getElementById("already_taken").style.display="none";
                        document.getElementById("quizbtn").style.width="13%";
                    }
                    document.getElementById(intLastSpan-1).onclick = function(){
                        document.getElementById("quizbtn").style.display="block";
                        document.getElementById("already_taken").style.display="none";
                        document.getElementById("quizbtn").style.width="13%";
                    }
                    console.log(intLastSpan==progLength);
                    for (let i = 0; i < prog.length; i++) {
                        var lessonId1 = document.getElementById("lessonId"+i).dataset.important;
                        var empId1 = document.getElementById("empId"+i).dataset.important;
                        var courseId1 = document.getElementById("courseId").dataset.important;
                        if(prog[i]['empId']==empId1 && prog[i]['courseId']==courseId1 && prog[i]['lessonId']==lessonId1){
                            document.getElementById(i).disabled = false;
                            document.getElementById(i+1).disabled = false;
                        }
                    }
                    for (let i = 0; i < prog.length; i++) {
                        var lessonId1 = document.getElementById("lessonId"+i).dataset.important;
                        var empId1 = document.getElementById("empId"+i).dataset.important;
                        var courseId1 = document.getElementById("courseId").dataset.important;
                        if(prog[i]['empId']==empId1 && prog[i]['courseId']==courseId1 && prog[i]['lessonId']==lessonId1){
                            document.getElementById(i).disabled = false;
                            document.getElementById(i+1).disabled = false;
                        }
                    }


                    //display duration of video
                    const video =  document.getElementsByTagName("video");
                    for (let i = 0; i < video.length; i++) {
                        video[i].onloadedmetadata = (event) => {
                            var mzminutes = Math.floor(video[i].duration / 60);
                            var mzseconds = Math.floor(video[i].duration - (mzminutes * 60));
                            document.getElementById("duration"+i).innerHTML = mzminutes+':'+mzseconds;
                        };

                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    //store the info of watched video
                    const buttons = document.getElementsByTagName("button");
                    document.getElementById("0").disabled = false;
                    const buttonPressed = e => {
                        $vid=document.getElementById("video"+e.target.id);  // Get ID of Clicked Element

                        const onTimeUpdate = event => {
                            console.log(checkSkipped(event.target.currentTime));
                        }

                        let prevTime = 0;
                        const checkSkipped = currentTime => {
                            const skip = [];
                            // only record when user skip more than 2 seconds
                            const skipThreshold = 2;

                            // user skipped part of the video
                            if (currentTime - prevTime > skipThreshold) {
                                skip.push({
                                    periodSkipped: currentTime - prevTime,
                                    startAt: prevTime,
                                    endAt: currentTime,
                                });
                                prevTime = currentTime;
                                return skip;
                            }

                            prevTime = currentTime;
                            return false;
                        }
                        var lessonId = document.getElementById("lessonId"+e.target.id).dataset.important;
                        var empId = document.getElementById("empId"+e.target.id).dataset.important;
                        var courseId = document.getElementById("courseId").dataset.important;
                        var sss=parseInt(e.target.id);

                        $vid.addEventListener("play", e => console.log('play'));
                        $vid.addEventListener("playing", e => console.log('playing'));
                        $vid.addEventListener("timeupdate", onTimeUpdate);
                        $vid.addEventListener("ended", function(e){

                            var state=1;
                            $.ajax({
                                url:"{{ route('progress.store') }}",
                                type:"POST",
                                dataType:'json',
                                data:{ lessonId, empId, state ,courseId },
                            });
                            document.getElementById(sss+1).disabled = false;
                        });

                        $vid.addEventListener("pause", e => console.log('pause'));


                    }

                    for (let button of buttons) {
                        button.addEventListener("click", buttonPressed);
                    }



                });
            </script>
        @endsection

    @endsection
@endcan
