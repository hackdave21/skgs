@extends('frontend.layout')

@section('title', 'Accueil')

@section('content')

<!-- categories section -->
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2>Our Course Categories</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.</p>
        </div>
        <div class="row">
            <!-- categorie -->
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="/plateforme/img/categories/1.jpg"></div>
                    <div class="ci-text">
                        <h5>IT Development</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                        <span>120 Courses</span>
                    </div>
                </div>
            </div>
            <!-- categorie -->
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="/plateforme/img/categories/2.jpg"></div>
                    <div class="ci-text">
                        <h5>Web Design</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                        <span>70 Courses</span>
                    </div>
                </div>
            </div>
            <!-- categorie -->
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="/plateforme/img/categories/3.jpg"></div>
                    <div class="ci-text">
                        <h5>Illustration & Drawing</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                        <span>55 Courses</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- categories section end -->


<!-- search section -->
<section class="search-section">
    <div class="container">
        <div class="search-warp">
            <div class="section-title text-white">
                <h2>Search your course</h2>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <!-- search form -->
                    <form class="course-search-form">
                        <input type="text" placeholder="Course">
                        <input type="text" class="last-m" placeholder="Category">
                        <button class="site-btn">Search Couse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- search section end -->


<!-- course section -->
<section class="course-section spad">
    <div class="container">
        <div class="section-title mb-0">
            <h2>Featured Courses</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.</p>
        </div>
    </div>
    <div class="course-warp">
        <ul class="course-filter controls">
            <li class="control active" data-filter="all">Toutes les matières</li>
            <li class="control" data-filter=".finance">matière 1</li>
            <li class="control" data-filter=".design">matière</li>
            <li class="control" data-filter=".web">matière</li>
            <li class="control" data-filter=".photo">matière</li>
        </ul>
        <div class="row course-items-area">
            <!-- course -->
            <div class="mix col-lg-3 col-md-4 col-sm-6 finance">
                <div class="course-item">
                    <div class="course-thumb set-bg" data-setbg="/plateforme/img/courses/1.jpg">
                        <div class="price">Price: $15</div>
                    </div>
                    <div class="course-info">
                        <div class="course-text">
                            <h5>Art & Crafts</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                            <div class="students">120 Students</div>
                        </div>
                        <div class="course-author">
                            <div class="ca-pic set-bg" data-setbg="/plateforme/img/authors/1.jpg"></div>
                            <p>William Parker, <span>Developer</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- course -->
            <div class="mix col-lg-3 col-md-4 col-sm-6 design">
                <div class="course-item">
                    <div class="course-thumb set-bg" data-setbg="/plateforme/img/courses/2.jpg">
                        <div class="price">Price: $15</div>
                    </div>
                    <div class="course-info">
                        <div class="course-text">
                            <h5>IT Development</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                            <div class="students">120 Students</div>
                        </div>
                        <div class="course-author">
                            <div class="ca-pic set-bg" data-setbg="/plateforme/img/authors/2.jpg"></div>
                            <p>William Parker, <span>Developer</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- course -->
            <div class="mix col-lg-3 col-md-4 col-sm-6 web">
                <div class="course-item">
                    <div class="course-thumb set-bg" data-setbg="/plateforme/img/courses/3.jpg">
                        <div class="price">Price: $15</div>
                    </div>
                    <div class="course-info">
                        <div class="course-text">
                            <h5>Graphic Design</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                            <div class="students">120 Students</div>
                        </div>
                        <div class="course-author">
                            <div class="ca-pic set-bg" data-setbg="/plateforme/img/authors/3.jpg"></div>
                            <p>William Parker, <span>Developer</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- course -->
            <div class="mix col-lg-3 col-md-4 col-sm-6 photo">
                <div class="course-item">
                    <div class="course-thumb set-bg" data-setbg="/plateforme/img/courses/4.jpg">
                        <div class="price">Price: $15</div>
                    </div>
                    <div class="course-info">
                        <div class="course-text">
                            <h5>IT Development</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur</p>
                            <div class="students">120 Students</div>
                        </div>
                        <div class="course-author">
                            <div class="ca-pic set-bg" data-setbg="/plateforme/img/authors/4.jpg"></div>
                            <p>William Parker, <span>Developer</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- course section end -->


<!-- signup section -->
<section class="signup-section spad">
    <div class="signup-bg set-bg" data-setbg="/plateforme/img/signup-bg.jpg"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="signup-warp">
                    <div class="section-title text-white text-left">
                        <h2>Sign up to became a teacher</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.</p>
                    </div>
                    <!-- signup form -->
                    <form class="signup-form">
                        <input type="text" placeholder="Your Name">
                        <input type="text" placeholder="Your E-mail">
                        <input type="text" placeholder="Your Phone">
                        <label for="v-upload" class="file-up-btn">Upload Course</label>
                        <input type="file" id="v-upload">
                        <button class="site-btn">Search Couse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- signup section end -->

@endsection
