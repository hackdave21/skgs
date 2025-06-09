<!DOCTYPE html>
<html lang="en">
<head>
	<title>SKGS </title>
	<meta charset="UTF-8">
	<meta name="description" content="WebUni Education Template">
	<meta name="keywords" content="webuni, education, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="/plateforme/img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="/plateforme/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="/plateforme/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="/plateforme/css/owl.carousel.css"/>
	<link rel="stylesheet" href="/plateforme/css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	@include('frontend.components.header')
	<!-- Header section end -->


	<!-- Hero section -->
	@include('frontend.components.hero')
	<!-- Hero section end -->


	@yield('content')


	<!-- banner section -->
	{{-- <section class="banner-section spad">
		<div class="container">
			<div class="section-title mb-0 pb-2">
				<h2>Join Our Community Now!</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.</p>
			</div>
			<div class="text-center pt-5">
				<a href="#" class="site-btn">Register Now</a>
			</div>
		</div>
	</section> --}}
	<!-- banner section end -->


	<!-- footer section -->
	@include('frontend.components.footer')
	<!-- footer section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="/plateforme/js/jquery-3.2.1.min.js"></script>
	<script src="/plateforme/js/bootstrap.min.js"></script>
	<script src="/plateforme/js/mixitup.min.js"></script>
	<script src="/plateforme/js/circle-progress.min.js"></script>
	<script src="/plateforme/js/owl.carousel.min.js"></script>
	<script src="/plateforme/js/main.js"></script>
</html>
