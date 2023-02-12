@extends('layouts.EmployeeLayouts')

@can('isEmployee')
@section('styles')

<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,500,500i,600,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('InstitAdmin/css/studiare-assets.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('InstitAdmin/css/style.css') }}">



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
												<a href="single-teacher.html">{{$creatorName[0]['creator']}}</a>
											</div>
										</div>
									</div>
									<div class="course-category before-gallery-unit">
										<div class="icon">
											
										</div>
										<div class="info">
											<span class="label">Category</span>
											<div class="value">
												<a href="#">{{$courses->category}} </a>
												
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
									<img src="{{ asset('HomePageFrontend/images/course_1.jpg') }}" alt="">
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
													<h4>{{$lesson->names}} <span class="badge-item video">video</span>
													</h4>
													<p class="subtitle">01:10</p>
												</div>
											</div>
											
										</div>
										<div class="panel-content">
											<div class="panel-content-inner">
												<p>{{$lesson->descriptions}}</p>
											<!-- Button trigger modal -->
										
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
											Watch The Lesson
											</button>

											<!-- Modal -->
											<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">{{$lesson->names}}</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
												<video width="760px" height="500px" controls>
																						<source src="{{asset('/storage/instit/courses')}}/{{$lesson->video}}" type="video/mp4">
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
										@if(sizeof($results)==0)
											<div class="panel-content-inner"> <a class="btn btn-primary"  href="{{route('client.test' ,$courses->id)}}">Start Quiz</a></div>
											@else
											<div class="panel-content-inner">You Already Took The Quiz</div>
											@endif
										</div>
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
<script src="{{ asset('InstitAdmin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('InstitAdmin/js/gmap3.min.js') }}"></script>
<script src="{{ asset('InstitAdmin/js/jquery.countTo.js') }}"></script>
<script src="{{ asset('InstitAdmin/js/popper.js') }}"></script>
<script src="{{ asset('InstitAdmin/js/script.js') }}"></script>
<script src="{{ asset('InstitAdmin/js/studiare-plugins.min.js') }}"></script>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyCiqrIen8rWQrvJsu-7f4rOta0fmI5r2SI&amp;sensor=false&amp;language=en"></script>
@endsection

@endsection
@endcan
