<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from dreamslms.dreamstechnologies.com/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 11:05:55 GMT -->
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>SKGS</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('platform/assets/img/SKGS.png') }}">
     <link rel="shortcut icon" href="{{ asset('template/ubold/assets/images/bleu.png') }}">

	<!-- Theme Settings Js -->
	<script src="{{ asset('platform/assets/js/theme-script.js') }}" type="54fdcfa88c30ae24cb15d906-text/javascript"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('platform/assets/css/bootstrap.min.css') }}">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ asset('platform/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('platform/assets/plugins/fontawesome/css/all.min.css') }}">

	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="{{ asset('platform/assets/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('platform/assets/css/owl.theme.default.min.css') }}">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="{{ asset('platform/assets/plugins/feather/feather.css') }}">

	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ asset('platform/assets/css/style.css') }}">

</head>

<body>

	<!-- Main Wrapper -->
	<div class="main-wrapper log-wrap">

		<div class="row">

			<!-- Login Banner -->
			<div class="col-md-6 login-bg">
				<div class="owl-carousel login-slide owl-theme">
					<div class="welcome-login">
						<div class="login-banner">
							<img src="{{ asset('platform/assets/img/bleu.png') }}" class="img-fluid" alt="Logo">
						</div>
						<div class="mentor-course text-center">
							<p>Une solution pour numériser la génération des bulletins scolaires</p>
						</div>
					</div>
					<div class="welcome-login">
						<div class="login-banner">
							<img src="{{ asset('platform/assets/img/bleu.png') }}" class="img-fluid" alt="Logo">
						</div>
						<div class="mentor-course text-center">
							<p>Travaillez aisément</p>
						</div>
					</div>
					<div class="welcome-login">
						<div class="login-banner">
							<img src="{{ asset('platform/assets/img/bleu.png') }}" class="img-fluid" alt="Logo">
						</div>
						<div class="mentor-course text-center">
							<p>Gestion des notes</p>
						</div>
					</div>
				</div>
			</div>
			<!-- /Login Banner -->

			<div class="col-md-6 login-wrap-bg">

				<!-- Login -->
				<div class="login-wrapper">
					<div class="loginbox">
						<div class="w-100">
							<h1>Bienvenue sur SKGS entrez vos identifiants pour vous connecter</h1>
							<form action="{{ route('teacher.login.submit') }}" method="POST">
                                @csrf
                                <div class="input-block">
                                    <label class="form-control-label">Email</label>
                                    <input type="email"
                                           name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}"
                                           placeholder="entrez votre email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="input-block">
                                    <label class="form-control-label">Mot de passe</label>
                                    <div class="pass-group">
                                        <input type="password"
                                               name="password"
                                               class="form-control pass-input @error('password') is-invalid @enderror"
                                               placeholder="entrez votre mot de passe">
                                        <span class="feather-eye toggle-password"></span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Affichage des messages de succès -->
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="d-grid">
                                    <button class="btn btn-primary btn-start" type="submit">Connexion</button>
                                </div>
                            </form>
						</div>
					</div>

				</div>
				<!-- /Login -->

			</div>

		</div>

	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="{{ asset('platform/assets/js/jquery-3.7.1.min.js') }}" type="54fdcfa88c30ae24cb15d906-text/javascript"></script>

	<!-- Bootstrap Core JS -->
	<script src="{{ asset('platform/assets/js/bootstrap.bundle.min.js') }}" type="54fdcfa88c30ae24cb15d906-text/javascript"></script>

	<!-- Owl Carousel -->
	<script src="{{ asset('platform/assets/js/owl.carousel.min.js') }}" type="54fdcfa88c30ae24cb15d906-text/javascript"></script>

	<!-- Custom JS -->
	<script src="{{ asset('platform/assets/js/script.js') }}" type="54fdcfa88c30ae24cb15d906-text/javascript"></script>

<script src="https://dreamslms.dreamstechnologies.com/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="54fdcfa88c30ae24cb15d906-|49" defer></script></body>


<!-- Mirrored from dreamslms.dreamstechnologies.com/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 11:05:58 GMT -->
</html>
