<!DOCTYPE html>
<html lang="en">
<head>
<title>Courses</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Lingua project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('HomePageFrontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/styles/courses.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('HomePageFrontend/styles/courses_responsive.css') }}">
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
                                    <li class="active"><a href="{{route('home.courses')}}">Courses</a></li>
                                    <li><a href="{{route('home.InstitCompany')}}">Institutions</a></li>
                                    <li><a href="{{route('home.company')}}">Companies</a></li>

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

<br><br><br>
	<!-- Language -->

	<div class="language">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="language_title">Learn New Skills Easily</div>
				</div>
			</div>

		</div>
	</div>


	<!-- Courses -->

	<div class="courses">
		<div class="container">
			<div class="row courses_row">
            @if( $data->count()>=3)

    @foreach($data as $da)
    <!-- Course -->
    <div class="col-lg-4 course_col">
        <div class="course">
            <div class="course_image"><img src="{{ asset('HomePageFrontend/images/course_'.($loop->index+1).'.jpg') }}" alt=""></div>
            <div class="course_body">
                <div class="course_title"> {{$da->name,10}}</div>
                <div class="course_info">
                    <ul>
                        <li>{{$names[$loop->index]['name'] }}</li>
                        <li>{{$da->category}}</li>
                        <li>Price: {{$da->price}}</li>
                    </ul>
                </div>
                <div class="course_text">
                    <p>{{Str::limit($da->description,30)}}.</p>
                </div>
            </div>

        </div>
    </div>

    @endforeach
    @else


                    <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course">
                            <div class="course_image"><img style="object-fit: fill" src="{{ asset('HomePageFrontend/images/mysql.jpg') }}" alt=""></div>
                            <div class="course_body">
                                <div class="course_title"><a target="_blank" href="https://www.w3schools.com/MySQL/mysql_intro.asp">Mysql</a></div>
                                <div class="course_info">
                                    <ul>
                                        <li>Qintar Tech</li>
                                        <li>IT Category</li>
                                    </ul>
                                </div>
                                <div class="course_text">
                                    <p>
                                        MySQL is a relational database ...</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course">
                            <div class="course_image"><img style="object-fit: fill" src="{{ asset('HomePageFrontend/images/laravel.jpg') }}" alt=""></div>
                            <div class="course_body">
                                <div class="course_title"><a target="_blank" href="https://laravel.com/">Laravel</a></div>
                                <div class="course_info">
                                    <ul>
                                        <li>Tuwaiq</li>
                                        <li>IT Category</li>
                                    </ul>
                                </div>
                                <div class="course_text">
                                    <p>Laravel is a web application framework...</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course">
                            <div class="course_image"><img style="object-fit: fill" src="{{ asset('HomePageFrontend/images/ccma.jpg') }}" alt=""></div>
                            <div class="course_body">
                                <div class="course_title"><a target="_blank" href="https://www.imanet.org/IMA-Certifications/CMA-Certification">Certified Management Accountant</a></div>
                                <div class="course_info">
                                    <ul>
                                        <li>Azero</li>
                                        <li>Accounting Category</li>
                                    </ul>
                                </div>
                                <div class="course_text">
                                    <p>The CMA is a beneficial certification for...</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course">
                            <div class="course_image"><img style="object-fit: fill" src="{{ asset('HomePageFrontend/images/hrm.png') }}" alt=""></div>
                            <div class="course_body">
                                <div class="course_title"><a target="_blank" href="https://www.mishrm.org/Resources/Certification">Human Resource Management</a></div>
                                <div class="course_info">
                                    <ul>
                                        <li>SHRM</li>
                                        <li>HR Category</li>
                                    </ul>
                                </div>
                                <div class="course_text">
                                    <p>
                                        Being a leader in the human...</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course">
                            <div class="course_image"><img style="object-fit: fill" src="{{ asset('HomePageFrontend/images/oopp.png') }}" alt=""></div>
                            <div class="course_body">
                                <div class="course_title"><a target="_blank" href="https://www.coursera.org/learn/wharton-operations">Operations Management</a></div>
                                <div class="course_info">
                                    <ul>
                                        <li>MGMA</li>
                                        <li>Operations Category</li>
                                    </ul>
                                </div>
                                <div class="course_text">
                                    <p>Operations Management Certificate preparing...</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course">
                            <div class="course_image"><img src="{{ asset('HomePageFrontend/images/meno.jpg') }}" alt=""></div>
                            <div class="course_body">
                                <div class="course_title"><a target="_blank" href="https://www.ciobacademy.org/course/level-4-site-management-certificate/">Management CIOB</a></div>
                                <div class="course_info">
                                    <ul>
                                        <li>CIOB</li>
                                        <li>Management Category</li>
                                    </ul>
                                </div>
                                <div class="course_text">
                                    <p>Have an exceptional experience...</p>
                                </div>
                            </div>

                        </div>
                    </div><!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course">
                            <div class="course_image"><img style="object-fit: fill" src="{{ asset('HomePageFrontend/images/agile.jpeg') }}" alt=""></div>
                            <div class="course_body">
                                <div class="course_title"><a target="_blank" href="https://www.atatus.com/glossary/agile-methodology/">Agile Methodology</a></div>
                                <div class="course_info">
                                    <ul>
                                        <li>Software Sparks</li>
                                        <li>Management Category</li>
                                    </ul>
                                </div>
                                <div class="course_text">
                                    <p>
                                        Dealing with rappid development...</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course">
                            <div class="course_image"><img style="object-fit: fill" src="{{ asset('HomePageFrontend/images/sales.jpg') }}" alt=""></div>
                            <div class="course_body">
                                <div class="course_title"><a target="_blank" href="https://seec.schulich.yorku.ca/program/certificate-in-sales-management/">Sales Management</a></div>
                                <div class="course_info">
                                    <ul>
                                        <li>YORK</li>
                                        <li>Sales Category</li>
                                    </ul>
                                </div>
                                <div class="course_text">
                                    <p>Increasing your sales skills...</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Course -->
                    <div class="col-lg-4 course_col">
                        <div class="course">
                            <div class="course_image"><img style="object-fit: fill" src="{{ asset('HomePageFrontend/images/flutter.png') }}" alt=""></div>
                            <div class="course_body">
                                <div class="course_title"><a target="_blank" href="https://www.toptal.com/flutter/flutter-tutorial">Flutter</a></div>
                                <div class="course_info">
                                    <ul>
                                        <li>Toptal</li>
                                        <li>IT Category</li>
                                    </ul>
                                </div>
                                <div class="course_text">
                                    <p>let's develop a mobile aaplication that...</p>
                                </div>
                            </div>

                        </div>
                    </div>

			</div>

            @endif

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
<script src="{{ asset('HomePageFrontend/js/courses.js') }}"></script>
</body>
</html>
