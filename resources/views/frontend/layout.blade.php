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

    <style>
        .course-item-link {
    display: block;
    text-decoration: none;
    color: inherit;
    transition: transform 0.3s ease;
}

.course-item-link:hover {
    transform: translateY(-5px);
}

.course-item-link:hover .course-item {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
    </style>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>
