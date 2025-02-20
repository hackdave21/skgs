@extends('frontend.layout')

@section('title', 'Accueil')

@section('content')


    <!-- Home Banner -->
		<section class="home-slide-five">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 col-12">
						<div class="home-slide-five-face" data-aos="fade-down">

							<!-- Banner Text -->
							<div class="home-slide-five-text">
								<h5>The Leader in Online Learning</h5>
								<h1>Engaging & Accessible Online Courses For All</h1>
								<p>Trusted by over 15K Users worldwide since 2024</p>
							</div>
							<!-- /Banner Text -->

							<!-- banner Seach Category -->
							{{-- <div class="banner-content-five">
								<form class="form" action="https://dreamslms.dreamstechnologies.com/html/course-list.html">
									<div class="form-inner-five">
										<div class="input-group">
											<!-- Slect Category -->
											<span class="drop-detail-five">
												<select class="form-select select">
													<option>Category</option>
													<option>Angular</option>
													<option>Node Js</option>
													<option>React</option>
													<option>Python</option>
												</select>
											</span>
											<!-- Slect Category -->

											<!-- Search -->
											<input type="email" class="form-control"
												placeholder="Search School, Online eductional centers, etc">
											<!-- Search -->

											<!-- Submit Button -->
											<button class="btn btn-primary sub-btn" type="submit"><span><i
														class="fa-solid fa-magnifying-glass"></i></span></button>
											<!-- Submit Button -->
										</div>
									</div>
								</form>
							</div> --}}
							<!-- /banner Seach Category -->

							<!-- Review and Experience -->
							<div class="review-five-group">
								<div class="review-user-five  d-flex align-items-center">

									<div class="review-rating-five">
										<div class="rating-star">
											<p>5.5</p>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
										</div>
									</div>
								</div>
								<!-- Experience -->
								<div class="rate-head-five d-flex align-items-center course-count">
									<h2><span class="counterUp">10</span>+</h2>
									<p>Years of experience tutors</p>
								</div>
								<!-- /Experience -->
							</div>
							<!-- /Review and Experience -->
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="banner-slider-img">
							<div class="row">
								<div class="col-lg-6">
									<div class="slider-five-two aos" data-aos="fade-down">
										<img src="{{ asset("platform/assets/img/a3.png") }}" alt="Img">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="vector-shapes-five">
					<img src="{{ asset("platform/assets/img/bg/banner-vector.svg") }}" alt="Img">
				</div>
			</div>
		</section>
		<!-- /Home Banner -->

		<!-- Leading Companies -->
		<section class="leading-section-five">
			<div class="container">
				<div class="row align-items-center">
					<div data-aos="fade-down" style="display: flex">
                        <div class="leading-five-content course-count">
							<h2>
                                Bonjour
                                @if(auth()->user()->sex === 'Masculin')
                                    Monsieur
                                @else
                                    Madame
                                @endif
                                <mark style="color: orange">
                                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                </mark>
                            </h2>
							<p>Bienvenue sur votre compte de SKGS
                                </p>
						</div>
						<div class="leading-five-content course-count">
							<h2>Pourquoi  SKGS ?</h2>
							<p>L'objectif est en fait de numériser la génération des bulletins
                                 scolaire et de faciliter les enseignant dans leurs tâches.
                                </p>
						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- /Leading Companies -->

<!-- Course Categories Five -->
<section class="course-section-five">
    <div class="container">
        <div class="header-five-title text-center" data-aos="fade-down">
            <h2>Vos classes</h2>
            <p>Ici les classes dans lesquelles vous intervenez, veuillez cliquer pour avoir accès à la classe pour la saisie des notes</p>
        </div>
        <div class="owl-carousel home-five-course owl-theme aos">
            @php
                // Utiliser une collection unique basée sur l'ID de la classe
                $uniqueClasses = $schoolClasses->unique('id');
            @endphp

            @foreach($uniqueClasses as $schoolClasse)
            <!-- Carousel Item -->
            <div class="carousel-five-item" data-aos="fade-down">
                <div class="course-five-item">
                    <div class="course-five-grid">
                        <div class="course-icon-five">
                            <div class="icon-five-border">
                                <a href="{{ route('teacher.classes.show', $schoolClasse->id) }}">
                                </a>
                            </div>
                        </div>
                        <div class="course-info-five">
                            <a href="{{ route('teacher.classes.show', $schoolClasse->id) }}">
                                <h3>{{ $schoolClasse->name }}</h3>
                                <p>{{ $schoolClasse->students_count ?? 0 }} Élèves</p>
                            </a>
                        </div>
                        <div class="course-info-btn">
                            <a href="{{ route('teacher.classes.show', $schoolClasse->id) }}" class="btn-five">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Course Categories Five -->

		<!-- Counter Five-->
		<section class="counter-section-five">
			<div class="container">
				<div class="row align-items-center text-center justify-content-between">
					<!-- col -->
					<div class="col-lg-3 col-md-3 col-sm-12" data-aos="fade-down">
						<div class="count-five">
							<div class="count-content-five course-count ms-0">
								<h4><span class="counterUp">{{$students_count}}</span></h4>
								<p class="mb-0">Elèves</p>
							</div>
						</div>
					</div>
					<!--/ col -->

					<!-- col -->
					<div class="col-lg-3 col-md-3 col-sm-12" data-aos="fade-down">
						<div class="count-five">
							<div class="count-content-five course-count ms-0">
								<h4><span class="counterUp">{{$teachers_count}}</span></h4>
								<p class="mb-0">Enseigants</p>
							</div>
						</div>
					</div>
					<!--/ col -->

					<!-- col -->
					<div class="col-lg-3 col-md-3 col-sm-12" data-aos="fade-down">
						<div class="count-five">
							<div class="count-content-five course-count ms-0">
								<h4><span class="counterUp">{{$subjects_count}}</span></h4>
								<p class="mb-0">Matières</p>
							</div>
						</div>
					</div>
					<!--/ col -->

					<!-- col -->
					<div class="col-lg-3 col-md-3 col-sm-12" data-aos="fade-down">
						<div class="count-five count-five-last count-five-0">
							<div class="count-content-five course-count ms-0">
								<h4><span class="counterUp">58,370</span></h4>
								<p class="mb-0">Bulletins scolaires</p>
							</div>
						</div>
					</div>
					<!--/ col -->

				</div>
			</div>
		</section>
		<!-- /Counter Five-->

		<!-- Master the skills Five -->
		<section class="master-section-five">
			<div class="container">
				<div class="master-five-vector">
					<img class="ellipse-right" src="{{ asset("platform/assets/img/bg/master-vector-left.svg") }}" alt="Img">
				</div>
				<div class="row">
					<div class="col-lg-6 col-sm-12" data-aos="fade-down">
						<div class="section-five-sub">
							<div class="header-five-title">
								<h2>C'est quoi SKGS</h2>
								<p>La plateforme dédiée aux enseignants</p>
							</div>
							<div class="career-five-content">
								<p data-aos="fade-down">Get certified, master modern tech skills, and level up your
									career — whether you’re starting out or a seasoned pro. 95% .</p>
								<p class="mb-0" data-aos="fade-down">Get certified, master modern tech skills, and level
									up your career — whether you’re starting out or a seasoned pro. 95% of eLearning
									learners report our hands-on content directly helped their careers.</p>
							</div>
							<a href="course-list.html" class="learn-more-five">Contactez l'administration</a>
						</div>
					</div>
					<div class="col-lg-6 col-sm-12">
						<div class="row">
                            <img src="{{ asset("platform/assets/img/a2.png") }}" alt="enseignant">
							{{-- <div class="col-lg-6 col-sm-6" data-aos="fade-down">
								<div class="skill-five-item">
									<div class="skill-five-icon">
										<img src="assets/img/skills/skills-01.svg" class="bg-warning"
											alt="Stay motivated">
									</div>
									<div class="skill-five-content">
										<h3>Stay motivated with engaging instructors</h3>
										<p>eLearning learners report our hands-on content directly helped their careers.
										</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6" data-aos="fade-down">
								<div class="skill-five-item">
									<div class="skill-five-icon">
										<img src="{{ asset("platform/assets/img/skills/skills-02.svg") }}" class="bg-info" alt="Stay motivated">
									</div>
									<div class="skill-five-content">
										<h3>Keep up with in the latest in cloud</h3>
										<p>eLearning learners report our hands-on content directly helped their careers.
										</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6" data-aos="fade-down">
								<div class="skill-five-item">
									<div class="skill-five-icon">
										<img src="assets/img/skills/skills-03.svg" class="bg-danger"
											alt="Stay motivated">
									</div>
									<div class="skill-five-content">
										<h3>Get certified with 100+ certification courses</h3>
										<p>eLearning learners report our hands-on content directly helped their careers.
										</p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6" data-aos="fade-down">
								<div class="skill-five-item">
									<div class="skill-five-icon">
										<img src="assets/img/skills/skills-04.svg" class="bg-light-green"
											alt="Stay motivated">
									</div>
									<div class="skill-five-content">
										<h3>Build skills your way, from labs to courses</h3>
										<p>eLearning learners report our hands-on content directly helped their careers.
										</p>
									</div>
								</div>
							</div> --}}
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Master the skills Five -->

@endsection
