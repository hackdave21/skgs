<div class="left-side-menu">
    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="../assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">
                    <!-- User menu items -->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i><span>My Account</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i><span>Settings</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i><span>Lock Screen</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i><span>Logout</span>
                    </a>
                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!-- Sidebar menu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Menu principal</li>

                <!-- Tableau de bord -->
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Tableau de bord </span>
                    </a>
                </li>

                <!-- Catégories -->
                <li>
                    <a href="#sidebarCategories" data-bs-toggle="collapse">
                        <i class="mdi mdi-tag-multiple-outline"></i>
                        <span> Catégories </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCategories">
                        <ul class="nav-second-level">
                            <li><a href="#">Voir tout</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Cours -->
                <li>
                    <a href="#sidebarCours" data-bs-toggle="collapse">
                        <i class="mdi mdi-book-open-page-variant"></i>
                        <span> Cours </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCours">
                        <ul class="nav-second-level">
                            <li><a href="#">Ajouter un cours</a></li>
                            <li><a href="#">Voir tout</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Inscription -->
                <li>
                    <a href="#">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> Inscription </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
