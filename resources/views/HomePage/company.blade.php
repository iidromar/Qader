<!DOCTYPE html>
<html lang="en">
<head>
<title>Instructors</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Lingua project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('HomePageFrontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link href="{{ asset('HomePageFrontend/plugins/video-js/video-js.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/styles/instructors.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/styles/instructors_responsive.css') }}">
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
                                    <li ><a href="{{route('home.index')}}">Home</a></li>
                                    <li><a href="{{route('home.courses')}}">Courses</a></li>
                                    <li><a href="{{route('home.InstitCompany')}}">Institutions</a></li>
                                    <li class="active"><a href="{{route('home.company')}}">Companies</a></li>

                                </ul>
							</nav>
							<div class="header_content_right ml-auto text-right">

								</div>

								<!-- Hamburger -->

								<div class="user">
								<div class="dropdown">

							<a class=" dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fa fa-user" aria-hidden="true"></i></a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('Employeelogin') }}">Login as an Employee</a>
                                        <a class="dropdown-item" href="{{ route('login') }}">Login as a Company Admin</a>
                                        <a class="dropdown-item" href="{{ route('Institlogin') }}">Login as an Institution Admin</a>
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


	<br>
	<br>
	<br>
	<!-- Instructors -->

	<div class="instructors">
		<div class="instructors_background" style="background-image:url(images/instructors_background.png)"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<h2 class="section_title text-center">Companies that we are proud to serve</h2>
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
						<div class="instructor_name"><a href="instructors.html">{{$da->name}}</a></div>
						<div class="instructor_title">CompanyAdmin</div>
						<div class="instructor_text">
                        Hi there we are {{$da->name}} company. Qader helps us to improve and manage our employees we are happy to work with Qader.
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
							<div class="instructor_image"><img src="{{ asset('HomePageFrontend/images/sap.png') }}" alt=""></div>
						</div>
						<div class="instructor_name"><a href="https://www.sap.com/mena-ar/index.html?url_id=auto_hp_redirect_mena-ar">SAP</a></div>
						<div class="instructor_title">Saudi Arabia</div>
						<div class="instructor_text">

                            SAP is one of the world's leading producers of software for the management of business processes, developing solutions that facilitate effective data processing across organizations.
                    </div>
						<div class="instructor_social">
							<ul>
								<li><a href="https://www.facebook.com/SAP/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="https://www.instagram.com/sap/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="https://twitter.com/sap?lang=ar"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>


					<!-- Instructor -->
					<div class="col-lg-4 instructor_col">
					<div class="instructor text-center">
						<div class="instructor_image_container">
							<div class="instructor_image"><img src="{{ asset('HomePageFrontend/images/oracle.png') }}" alt=""></div>
						</div>
						<div class="instructor_name"><a href="https://www.oracle.com">Oracle</a></div>
						<div class="instructor_title">Saudi Arabia</div>
						<div class="instructor_text">
                            Oracle is the only technology provider with a complete suite of integrated cloud applications and a cloud infrastructure platform.
                        </div>
						<div class="instructor_social">
							<ul>
								<li><a href="https://www.facebook.com/Oracle/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="https://www.instagram.com/oracle/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="https://twitter.com/Oracle?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

					<!-- Instructor -->
					<div class="col-lg-4 instructor_col">
					<div class="instructor text-center">
						<div class="instructor_image_container">
							<div class="instructor_image"><img src="{{ asset('HomePageFrontend/images/acu.png') }}" alt=""></div>
						</div>
						<div class="instructor_name"><a href="https://www.acumatica.com/">Acumatica</a></div>
						<div class="instructor_title">United Arab Emirates</div>
						<div class="instructor_text">
                            There’s a reason Acumatica has been the world's fastest-growing Cloud ERP company for 6 years and counting: we put our customers first.
                    </div>
						<div class="instructor_social">
							<ul>
								<li><a href="https://ar-ar.facebook.com/acumatica/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="https://www.instagram.com/acumatica/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="https://twitter.com/Acumatica?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>
				</div>


                @endif

			</div>
		</div>
	</div>

	<!-- Top Teachers -->

	<div class="teachers">
		<div class="container">
			<div class="row">
				<div class="col">
					<h2 class="section_title text-center">More Companies to success!</h2>
				</div>
			</div>
			<div class="row teachers_row">
			@if( $data2->count()>=3)

			@foreach($data2 as $da)
				<!-- Instructor -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher d-flex flex-row align-items-center justify-content-start">
						<div class="teacher_image"><div><img src="{{ asset('HomePageFrontend/images/company.webp') }}" alt=""></div></div>
						<div class="teacher_content">
							<div class="teacher_name"><a href="">{{$da->name}}</a></div>
							<div class="teacher_title">Riyadh, Saudi Arabia</div>
						</div>
					</div>
				</div>

                @endforeach
				@else

			<!-- Instructor -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher d-flex flex-row align-items-center justify-content-start">
						<div class="teacher_image"><div><img src="{{ asset('HomePageFrontend/images/manafa.jpg') }}" alt=""></div></div>
						<div class="teacher_content">
							<div class="teacher_name"><a href="">Manafa</a></div>
							<div class="teacher_title">Riyadh, Saudi Arabia</div>
						</div>
					</div>
				</div>

				<!-- Instructor -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher d-flex flex-row align-items-center justify-content-start">
						<div class="teacher_image"><div><img src="{{ asset('HomePageFrontend/images/abyan.jpg') }}" alt=""></div></div>
						<div class="teacher_content">
							<div class="teacher_name"><a href="">Abyan Capital</a></div>
							<div class="teacher_title">Riyadh, Saudi Arabia</div>
						</div>
					</div>
				</div>

				<!-- Instructor -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher d-flex flex-row align-items-center justify-content-start">
						<div class="teacher_image"><div><img src="{{ asset('HomePageFrontend/images/sary.jpg') }}" alt=""></div></div>
						<div class="teacher_content">
							<div class="teacher_name"><a href="">Sary</a></div>
							<div class="teacher_title">Riyadh, Saudi Arabia</div>
						</div>
					</div>
				</div>

				<!-- Instructor -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher d-flex flex-row align-items-center justify-content-start">
						<div class="teacher_image"><div><img src="{{ asset('HomePageFrontend/images/emkan.png') }}" alt=""></div></div>
						<div class="teacher_content">
							<div class="teacher_name"><a href="">Emkan</a></div>
							<div class="teacher_title">Riyadh, Saudi Arabia</div>
						</div>
					</div>
				</div>

				<!-- Instructor -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher d-flex flex-row align-items-center justify-content-start">
						<div class="teacher_image"><div><img src="{{ asset('HomePageFrontend/images/tmra.jpg') }}" alt=""></div></div>
						<div class="teacher_content">
							<div class="teacher_name"><a href="">Tamra Capital</a></div>
							<div class="teacher_title">Riyadh, Saudi Arabia</div>
						</div>
					</div>
				</div>

				<!-- Instructor -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher d-flex flex-row align-items-center justify-content-start">
						<div class="teacher_image"><div><img src="{{ asset('HomePageFrontend/images/taw.png') }}" alt=""></div></div>
						<div class="teacher_content">
							<div class="teacher_name"><a href="">Tawuniya</a></div>
							<div class="teacher_title">Riyadh, Saudi Arabia</div>
						</div>
					</div>
				</div>

				<!-- Instructor -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher d-flex flex-row align-items-center justify-content-start">
						<div class="teacher_image"><div><img src="{{ asset('HomePageFrontend/images/pay.png') }}" alt=""></div></div>
						<div class="teacher_content">
							<div class="teacher_name"><a href="">Saudi Payments</a></div>
							<div class="teacher_title">Riyadh, Saudi Arabia</div>
						</div>
					</div>
				</div>

				<!-- Instructor -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher d-flex flex-row align-items-center justify-content-start">
						<div class="teacher_image"><div><img src="{{ asset('HomePageFrontend/images/sii.jpg') }}" alt=""></div></div>
						<div class="teacher_content">
							<div class="teacher_name"><a href="">SITE</a></div>
							<div class="teacher_title">Riyadh, Saudi Arabia</div>
						</div>
					</div>
				</div>

				<!-- Instructor -->
				<div class="col-lg-4 col-md-6">
					<div class="teacher d-flex flex-row align-items-center justify-content-start">
						<div class="teacher_image"><div><img src="{{ asset('HomePageFrontend/images/ell.png') }}" alt=""></div></div>
						<div class="teacher_content">
							<div class="teacher_name"><a href="">Elm</a></div>
							<div class="teacher_title">Riyadh, Saudi Arabia</div>
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
                        <div class="footer_logo mb-auto"><a href="{{route('home.index')}}"><img src="{{ asset('HomePageFrontend/images/Qader-white.png') }}"width="200" height="75" alt=""></a>
                            <p style="color:grey;">Qader can increase your employees skills level to follow the current requirements and specifications jobs.</p>
                        </div>
                    </div>
                </div>





                <!-- About -->
                <div class="col-lg-2 offset-lg-3 footer_col">
                    <div>
                        <div class="footer_title">Pages</div>
                        <ul class="footer_list">
                            <li><a href="{{route('home.index')}}">Home</a></li>
                            <li><a href="{{route('home.courses')}}">Courses</a></li>
                            <li><a href="{{route('home.InstitCompany')}}">Institutions</a></li>
                            <li><a href="{{route('home.company')}}">Partners</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Help & Support -->
                <div class="col-lg-2 footer_col">
                    <div class="footer_title">Location</div>
                    <p style="color:grey;"> Prince Turki Al-Awal, Riyadh, Saudi Arabia</p>
                </div>

                <!-- Privacy -->
                <div class="col-lg-2 footer_col clearfix">
                    <div>
                        <div class="footer_title">Contact information</div>
                        <ul class="footer_list">
                            <li><p style="color:grey;">+966 11 928 392</p></li>
                            <li><p style="color:grey;">HR@Qader.com </p></li>
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
<script src="{{ asset('HomePageFrontend/plugins/parallax-js-master/parallax.min.js') }}"></script>
<script src="{{ asset('HomePageFrontend/plugins/progressbar/progressbar.min.js') }}"></script>
<script src="{{ asset('HomePageFrontend/plugins/video-js/video.min.js') }}"></script>
<script src="{{ asset('HomePageFrontend/plugins/video-js/Youtube.min.js') }}"></script>
<script src="{{ asset('HomePageFrontend/js/instructors.js') }}"></script>
</body>
</html>
