<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | SKGS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/ubold/assets/images/SKGS.png') }}">

	<!-- Theme Settings Js -->
	<script src="{{ asset("platform/assets/js/theme-script.js") }}" type="832a7c381eebdb5575f29e68-text/javascript"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset("platform/assets/css/bootstrap.min.css") }}">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ asset("platform/assets/plugins/fontawesome/css/fontawesome.min.css") }}">
	<link rel="stylesheet" href="{{ asset("platform/assets/plugins/fontawesome/css/all.min.css") }}">

	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="{{ asset("platform/assets/css/owl.carousel.min.css") }}">
	<link rel="stylesheet" href="{{ asset("platform/assets/css/owl.theme.default.min.css") }}">

	<!-- Slick CSS -->
	<link rel="stylesheet" href="{{ asset("platform/assets/plugins/slick/slick.css") }}">
	<link rel="stylesheet" href="{{ asset("platform/assets/plugins/slick/slick-theme.css") }}">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ asset("platform/assets/plugins/select2/css/select2.min.css") }}">

	<!-- Aos CSS -->
	<link rel="stylesheet" href="{{ asset("platform/assets/plugins/aos/aos.css") }}">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="{{ asset("platform/assets/css/feather.css") }}">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ asset("platform/assets/css/style.css") }}">

</head>


 <body class="home-five">


    	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
        @include('frontend.components.header')
		<!-- /Header -->

        @yield('content')


		<!-- Footer -->
        @include('frontend.components.footer')
		<!-- /Footer -->

	</div>
	<!-- /Main Wrapper -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   <!-- jQuery -->
	<script src="{{ asset("platform/assets/js/jquery-3.7.1.min.js") }}" type="832a7c381eebdb5575f29e68-text/javascript"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{ asset("platform/assets/js/bootstrap.bundle.min.js") }}" type="832a7c381eebdb5575f29e68-text/javascript"></script>

	<!-- counterup JS -->
	<script src="{{ asset("platform/assets/js/jquery.waypoints.js") }}" type="832a7c381eebdb5575f29e68-text/javascript"></script>
	<script src="{{ asset("platform/assets/js/jquery.counterup.min.js") }}" type="832a7c381eebdb5575f29e68-text/javascript"></script>

	<!-- Select2 JS -->
	<script src="{{ asset("platform/assets/plugins/select2/js/select2.min.js") }}" type="832a7c381eebdb5575f29e68-text/javascript"></script>

	<!-- Owl Carousel -->
	<script src="{{ asset("platform/assets/js/owl.carousel.min.js") }}" type="832a7c381eebdb5575f29e68-text/javascript"></script>

	<!-- Slick Slider -->
	<script src="{{ asset("platform/assets/plugins/slick/slick.js") }}" type="832a7c381eebdb5575f29e68-text/javascript"></script>

	<!-- Aos -->
	<script src="{{ asset("platform/assets/plugins/aos/aos.js") }}" type="832a7c381eebdb5575f29e68-text/javascript"></script>

	<!-- Custom JS -->
	<script src="{{ asset("platform/assets/js/script.js") }}" type="832a7c381eebdb5575f29e68-text/javascript"></script>

<script src="https://dreamslms.dreamstechnologies.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="832a7c381eebdb5575f29e68-|49" defer></script>
@yield('scripts')
</body>


</html>
