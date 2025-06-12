<div class="left-side-menu">
    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="../assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">
                    <!-- User menu items -->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i><span>Mon Compte</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i><span>Paramètres</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i><span>Lock</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i><span>Déconnexion</span>
                    </a>
                </div>
            </div>
            <p class="text-muted">Admin </p>
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

                  <!-- Series -->
                  <li>
                    <a href="#sidebarMatière" data-bs-toggle="collapse">
                      <i class="mdi mdi-pencil"></i>
                        <span>Series</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMatière">
                        <ul class="nav-second-level">
                            <li><a href="{{route('admin.series.create')}}">Ajouter une serie</a></li>
                            <li><a href="{{route('admin.series.index')}}">Voir tout</a></li>
                        </ul>
                    </div>
                </li>
                <!-- Classes -->
                <li>
                    <a href="#sidebarClasses" data-bs-toggle="collapse">
                        <i class="mdi mdi-school"></i>
                        <span> Classes </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarClasses">
                        <ul class="nav-second-level">
                            <li><a href="{{route('admin.school_classes.create')}}">Ajouter une classe</a></li>
                            <li><a href="{{route('admin.school_classes.index')}}">Voir tout</a></li>
                        </ul>
                    </div>
                </li>

                  <!-- Matières -->
                  <li>
                    <a href="#sidebarMatière" data-bs-toggle="collapse">
                        <i class="mdi mdi-book-open"></i>
                        <span>Matières</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMatière">
                        <ul class="nav-second-level">
                            <li><a href="{{route('admin.subjects.create')}}">Ajouter une matière</a></li>
                            <li><a href="{{route('admin.subjects.index')}}">Voir tout</a></li>
                        </ul>
                    </div>
                </li>

                  <!-- elèves -->
                  <li>
                    <a href="#sidebarEleves" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> Elèves </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEleves">
                        <ul class="nav-second-level">
                            <li><a href="{{route('admin.students.create')}}">Ajouter un élève</a></li>
                            <li><a href="{{route('admin.students.index')}}">Voir tout</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Enseignants -->
                <li>
                    <a href="#sidebarEnseignants" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> Enseignants </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEnseignants">
                        <ul class="nav-second-level">
                            <li><a href="{{route('admin.teachers.create')}}">Ajouter un enseignant</a></li>
                            <li><a href="{{route('admin.teachers.index')}}">Voir tout</a></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
