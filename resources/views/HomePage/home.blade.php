<!DOCTYPE html>
<html lang="en">
<head>
<title>Lingua</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Lingua project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('HomePageFrontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/styles/responsive.css') }}">
</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">
		

		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container mr-auto">
								<a href="{{route('home.index')}}">
									<div class="logo_text"><img src="{{ asset('HomePageFrontend/images/QaderLogo.png') }}"width="200" height="75" alt=""></div>
								</a>
							</div>
							<nav class="main_nav_contaner">
								<ul class="main_nav">
									<li class="active"><a href="{{route('home.index')}}">Home</a></li>
									<li><a href="{{route('home.courses')}}">Courses</a></li>
									<li><a href="{{route('home.InstitCompany')}}">InstituteCompany</a></li>
									<li><a href="{{route('home.company')}}">Company</a></li>
									
								</ul>
							</nav>
							<div class="header_content_right ml-auto text-right">
								
								</div>

								<!-- Hamburger -->

								<div class="user">
								<div class="dropdown">
  
							<a class=" dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fa fa-user" aria-hidden="true"></i></a>
							
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="{{ route('Employeelogin') }}">LogIn as an Employee</a>
								<a class="dropdown-item" href="{{ route('login') }}">LogIn as a CompanyAdmin</a>
								<a class="dropdown-item" href="{{ route('Institlogin') }}">LogIn as a InstitCompany</a>
							</div>
							</div></div>
								<div class="hamburger menu_mm">

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</header>

	
	
	<!-- Home -->

	<div class="home">
		<div class="home_background" style="background-image: url({{ asset('HomePageFrontend/images/index_background.jpg') }});"></div>
		<div class="home_content">
			<div class="container">
				<div class="row">
					<div class="col text-center">
						<h1 class="home_title">Improve Your Employees Skils Easily</h1>
						<div class="home_button trans_200"><a href="{{ route('login') }}">get started</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<!-- Courses -->

	<div class="courses">
		<div class="courses_background"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<h2 class="section_title text-center">Popular Online Courses</h2>
				</div>
			</div>
			<div class="row courses_row">
            @if( $data->count()==3)

            @foreach($data as $da)
				<!-- Course -->
				<div class="col-lg-4 course_col">
					<div class="course">
						<div class="course_image"><img src="{{ asset('HomePageFrontend/images/course_'.($loop->index+1).'.jpg') }}" alt=""></div>
						<div class="course_body">
							<div class="course_title"><a href="course.html"> {{$da->name,10}} </a></div>
							<div class="course_info">
								<ul>
									<li><a href="instructors.html">{{$names[$loop->index]['name'] }}</a></li>
									<li><a href="#">{{$da->category}}</a></li>
								</ul>
							</div>
							<div class="course_text">
								<p>{{Str::limit($da->description,30)}}.</p>
							</div>
						</div>
						<div class="course_footer d-flex flex-row align-items-center justify-content-start">
							<div class="course_students"><i class="fa fa-user" aria-hidden="true"></i><span></span></div>
							<div class="course_rating ml-auto"><i class="fa fa-star" aria-hidden="true"></i><span></span></div>
							<div class="course_mark course_free trans_200"><a href="#">{{$da->price}}</a></div>
						</div>
					</div>
				</div>

                @endforeach
				@else

				<!-- Course -->
				<div class="col-lg-4 course_col">
					<div class="course">
						<div class="course_image"><img src="{{ asset('HomePageFrontend/images/course_5.jpg') }}" alt=""></div>
						<div class="course_body">
							<div class="course_title"><a href="course.html">Intercultural Communication Training.</a></div>
							<div class="course_info">
								<ul>
									<li><a href="instructors.html">LearnWorlds</a></li>
									<li><a href="#">Self Improving</a></li>
								</ul>
							</div>
							<div class="course_text">
								<p>Intercultural Communication Training...</p>
							</div>
						</div>
						<div class="course_footer d-flex flex-row align-items-center justify-content-start">
							<div class="course_students"><i class="fa fa-user" aria-hidden="true"></i><span></span></div>
							<div class="course_rating ml-auto"><i class="fa fa-star" aria-hidden="true"></i><span></span></div>
							<div class="course_mark course_free trans_200"><a href="#">Free</a></div>
						</div>
					</div>
				</div>

				<!-- Course -->
				<div class="col-lg-4 course_col">
					<div class="course">
						<div class="course_image"><img src="{{ asset('HomePageFrontend/images/course_6.jpg') }}" alt=""></div>
						<div class="course_body">
							<div class="course_title"><a href="course.html">Writing for the Web Training.</a></div>
							<div class="course_info">
								<ul>
									<li><a href="instructors.html">Kajabi</a></li>
									<li><a href="#">Self Improving</a></li>
								</ul>
							</div>
							<div class="course_text">
								<p>Writing for the Web Training...</p>
							</div>
						</div>
						<div class="course_footer d-flex flex-row align-items-center justify-content-start">
							<div class="course_students"><i class="fa fa-user" aria-hidden="true"></i><span></span></div>
							<div class="course_rating ml-auto"><i class="fa fa-star" aria-hidden="true"></i><span></span></div>
							<div class="course_mark trans_200"><a href="#">$45</a></div>
						</div>
					</div>
				</div>
	<!-- Course -->
	<div class="col-lg-4 course_col">
					<div class="course">
						<div class="course_image"><img src="{{ asset('HomePageFrontend/images/course_8.jpg') }}" alt=""></div>
						<div class="course_body">
							<div class="course_title"><a href="course.html">Conflict Management Training.</a></div>
							<div class="course_info">
								<ul>
									<li><a href="instructors.html">WizIQ</a></li>
									<li><a href="#">Self Improving</a></li>
								</ul>
							</div>
							<div class="course_text">
								<p>Conflict Management Training...</p>
							</div>
						</div>
						<div class="course_footer d-flex flex-row align-items-center justify-content-start">
							<div class="course_students"><i class="fa fa-user" aria-hidden="true"></i><span></span></div>
							<div class="course_rating ml-auto"><i class="fa fa-star" aria-hidden="true"></i><span></span></div>
							<div class="course_mark course_free trans_200"><a href="#">Free</a></div>
						</div>
					</div>
				</div>


                      @endif
			
			</div>
		</div>
	</div>

	<!-- Instructors -->

	<div class="instructors">
		<div class="instructors_background" style="background-image:url(images/instructors_background.png)"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<h2 class="section_title text-center">The Best Institute Company</h2>
				</div>
			</div>
			<div class="row instructors_row">
            @if( $data->count()==3)

            @foreach($data as $da)
				<!-- Instructor -->
				<div class="col-lg-4 instructor_col">
					<div class="instructor text-center">
						<div class="instructor_image_container">
							<div class="instructor_image"><img width="110px" height="130px" src="{{ asset('HomePageFrontend/images/company.webp') }}" alt=""></div>
						</div>
						<div class="instructor_name"><a href="instructors.html">{{$names[$loop->index]['name'] }}</a></div>
						<div class="instructor_title">InstituteCompany</div>
						<div class="instructor_text">
						Hi there we are {{$names[$loop->index]['name'] }} company. We are a  specialist company in creating and managing employee training courses we are happy to work with Qader.

					</div>
						<div class="instructor_social">
							<ul>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

                @endforeach
				@else
						<!-- Instructor -->
						<div class="col-lg-4 instructor_col">
					<div class="instructor text-center">
						<div class="instructor_image_container">
							<div class="instructor_image"><img src="{{ asset('HomePageFrontend/images/company.webp') }}" alt=""></div>
						</div>
						<div class="instructor_name"><a href="instructors.html">Systeme.io</a></div>
						<div class="instructor_title">InstituteCompany</div>
						<div class="instructor_text">
						Hi there we are Systeme.io company. We are a  specialist company in creating and managing employee training courses we are happy to work with Qader.
					</div>
						
					</div>
				</div>

			
					<!-- Instructor -->
					<div class="col-lg-4 instructor_col">
					<div class="instructor text-center">
						<div class="instructor_image_container">
							<div class="instructor_image"><img src="{{ asset('HomePageFrontend/images/company.webp') }}" alt=""></div>
						</div>
						<div class="instructor_name"><a href="instructors.html">Academy of Mine	</a></div>
						<div class="instructor_title">InstituteCompany</div>
						<div class="instructor_text">
						Hi there we are Academy of Mine company. We are a  specialist company in creating and managing employee training courses we are happy to work with Qader.
					</div>
						
					</div>
				</div>

					<!-- Instructor -->
					<div class="col-lg-4 instructor_col">
					<div class="instructor text-center">
						<div class="instructor_image_container">
							<div class="instructor_image"><img src="{{ asset('HomePageFrontend/images/company.webp') }}" alt=""></div>
						</div>
						<div class="instructor_name"><a href="instructors.html">Kartra</a></div>
						<div class="instructor_title">InstituteCompany</div>
						<div class="instructor_text">
						Hi there we are Kartra company. We are a  specialist company in creating and managing employee training courses we are happy to work with Qader.
					</div>
						
					</div>
				</div>

		
                @endif

			</div>
		</div>
	</div>


	
	<!-- Footer -->

	<footer class="footer">
		<div class="footer_body">
			<div class="container">
				<div class="row">

					<!-- Newsletter -->
					<div class="col-lg-3 footer_col">
						<div class="newsletter_container d-flex flex-column align-items-start justify-content-end">
							<div class="footer_logo mb-auto"><a href="{{route('home.index')}}"><img src="{{ asset('HomePageFrontend/images/QaderLogo.png') }}"width="200" height="75" alt=""></a>
							<p style="color:grey;">Qader is...</p>
						</div>
						</div>
					</div>

							
						
				

					<!-- About -->
					<div class="col-lg-2 offset-lg-3 footer_col">
						<div>
							<div class="footer_title">About Us</div>
							<ul class="footer_list">
							<li><a href="{{route('home.index')}}">Home</a></li>
							<li><a href="{{route('home.courses')}}">Courses</a></li>
							<li><a href="{{route('home.InstitCompany')}}">InstituteCompany</a></li>
							<li><a href="{{route('home.company')}}">Company</a></li>
							</ul>
						</div>
					</div>

					<!-- Help & Support -->
					<div class="col-lg-2 footer_col">
						<div class="footer_title">Location</div>
						<p style="color:grey;"> Prince Turki Al Awal Riyadh, Saudi Arabia</p>
					</div>

					<!-- Privacy -->
					<div class="col-lg-2 footer_col clearfix">
						<div>
							<div class="footer_title">Contact information</div>
							<ul class="footer_list">
								<li><p style="color:grey;">Phone:0571593478</p></li>
								<li><p style="color:grey;">Email:Qader@gmail.com </p></li>
								<li><p style="color:grey;">Tel:2648921</p></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
		
	</footer>
</div>

<script src="{{ asset('HomePageFrontend/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('HomePageFrontend/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('HomePageFrontend/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('HomePageFrontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('HomePageFrontend/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('HomePageFrontend/js/custom.js') }}"></script>
</body>
</html>