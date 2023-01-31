@extends('layouts.EmployeeLayouts')

@can('isEmployee')
@section('styles')

<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,500,500i,600,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('InstitAdmin/css/studiare-assets.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('InstitAdmin/css/style.css') }}">



@endsection
@section('content')

		<!-- page-banner-section
			================================================== -->
            <section class="page-banner-section">
			<div class="container">
				<h1>{{$courses->name}}</h1>
			</div>
		</section>
		<!-- End page-banner-section -->
        <!-- single-course-section
			================================================== -->
		<section class="single-course-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-10">

						<div class="single-course-box">

							<!-- single top part -->
							<div class="product-single-top-part">
								<div class="product-info-before-gallery" style="text-align:center">
									<div class="course-author before-gallery-unit" style="text-align:center">

										<div class="info">
											<span class="label">Teacher</span>
											<div class="value">
												<a href="single-teacher.ht">{{auth()->user()->name}}</a>
											</div>
										</div>
									</div>
									<div class="course-category before-gallery-unit" style="text-align:center">

										<div class="info">
											<span class="label">Category</span>
											<div class="value">
												<a href="#">{{$courses->category}}</a>
											</div>
										</div>
									</div>
									<div class="course-rating before-gallery-unit" style="text-align:center">
                                    <div class="info">
											<span class="label">Lessons</span>
											<div class="value">
												<a href="#"></a>
											</div>
										</div>
									</div>

								</div>
								<div class="course-single-gallery">
									<img src="upload/courses/4.jpg" alt="">
								</div>

							</div>

							<!-- single course content -->
							<div class="single-course-content">
								<h2>Course Description</h2>
								<p>{{$courses->description}}</p>
								<!-- course section -->
                                @if( $lessons->count()>0)
                               @foreach($lessons as $lesson)
								<div class="course-section">
									<h3>{{ $loop->index +1}}. Lesson</h3>
									<div class="panel-group">
										<div class="course-panel-heading">
											<div class="panel-heading-left">
												<div class="course-lesson-icon">
													<i class="fa fa-play-circle-o"></i>
												</div>
												<div class="title">
													<h4>{{ $lesson['names'] }} </h4>

												</div>
											</div>
										</div>
										<div class="panel-content" >
											<div class="panel-content-inner">Lesson Description: {{ $lesson['descriptions'] }}</div>
											<div class="panel-content-inner">
                                            <video width="700px" height="500px" controls>
                                            <source src="{{asset('/storage/instit/courses')}}/{{$lesson['video']}}" type="video/mp4">
                                            </video>
                                            </div>
										</div>

								
                                @endforeach
                               @endif
                                </div>

						</div>

				<a class='btn btn-primary' href="#"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                width="24" height="24"
                viewBox="0,0,256,256"
                style="fill:#000000;">
                <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M12,2c-5.514,0 -10,4.486 -10,10c0,5.514 4.486,10 10,10c5.514,0 10,-4.486 10,-10c0,-1.126 -0.19602,-2.2058 -0.54102,-3.2168l-1.61914,1.61914c0.105,0.516 0.16016,1.05066 0.16016,1.59766c0,4.411 -3.589,8 -8,8c-4.411,0 -8,-3.589 -8,-8c0,-4.411 3.589,-8 8,-8c1.633,0 3.15192,0.49389 4.41992,1.33789l1.43164,-1.43164c-1.648,-1.194 -3.66656,-1.90625 -5.85156,-1.90625zM21.29297,3.29297l-10.29297,10.29297l-3.29297,-3.29297l-1.41406,1.41406l4.70703,4.70703l11.70703,-11.70703z"></path></g></g>
                </svg></a>
					<a class="btn btn-success me-2 "  href="{{route('Instit.edit' ,$courses->id)}}">

					<img width="24" height="24" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAB/klEQVR4nO2ZzS5EMRiGu7JkxM9FmD0S1sRPJIOluQbBwnaWFsIOscfa3zUIJm4BV8AOs3mk9Ew69JxpZ3rameS8SZf9+j79vvacfBWiUKFUAdPAthpTol8ElIBb/usGGBK9LGAYqBvMNyFEH5tPNOUScF3V4K6HsSljZqxXxU7b7YyPA6dAA/86b7P2TlcAQBl4JT+dGbI85wgxmbXzf83fAQfAnochjZUMNd8AVi0hrrN2X5ZNojdgQYQ7sA0LiLq+AaaAes2HNG8DUc+6AIS6bRLdRTCfBVHNNG9I134k86kQNsFrzelQi2heh5jvCQD1b/OAm56AkegAQcznBRDMfB4AQc37BujgwP6751WMCzVKwQB8mJdSf8CJtkQIAGAAeOzWfEd+PAFs+DAfE+DK14ElNAAwCHz4MB8LoOrzqiQCwJXPe56QAKp8PtuYf2z7SxwRoJJiWkJdqttpwDFmLSTATIrpQZc4sc/ALLDSjeno3wGfogCILIoMRBZFBvowAzt5N7ZcxG9D2e49QE1YC9FatBVwr/mp2HYR9ObuYhCnBgHLmo8v64c94ESb+A4siTjm3zUfRy6Tx4AXWnWv6nE353Fo6CM9A6OuO1A2QMTQMzDRQRJ/IEaBY1V/ofUly8Z551NAhmSfXjaWPL2RZY0ttVZvv8QXEq36BhSarkfwlJB4AAAAAElFTkSuQmCC">

				</a>
					</div>


				</div>

			</div>
		</section>
					</div>
		<!-- End single-course section -->




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
