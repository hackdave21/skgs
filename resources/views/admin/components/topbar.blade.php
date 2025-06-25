<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

            <li class="dropdown d-inline-block d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-search noti-icon"></i>
                </a>
                <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                    <form class="p-3">
                        <input type="text" class="form-control" placeholder="Search ..."
                            aria-label="Recipient's username">
                    </form>
                </div>
            </li>

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                    href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src={{ asset('template/ubold/layouts/assets/images/admin-image.png') }} alt="admin-image"
                        class="rounded-circle">
                    @auth
                        <span class="pro-user-name ms-1">
                            {{ Auth::user()->email }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    @else
                        <span class="pro-user-name ms-1">
                            Guest <i class="mdi mdi-chevron-down"></i>
                        </span>
                    @endauth

                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Ravi de vous revoir !</h6>
                    </div>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Mon profil</span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Changer de mot de passe</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>
        </ul>

        <!-- LOGO -->
        <div class="logo-box" style="display: flex; align-items: center;">
            <a href="index.html" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src={{ asset('template/ubold/assets/images/skgslogo.png') }} alt="SKGS" height="57px" width="180px">
                </span>
                <span class="logo-lg">
                    <img src={{ asset('template/ubold/assets/images/skgslogo.png') }} alt="SKGS" height="57px" width="180px">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </li>
        </ul>

        <div class="clearfix"></div>
    </div>
</div>
