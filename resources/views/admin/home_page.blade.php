<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | SKGS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('template/ubold/assets/images/SKGS.png') }}">
    <style>.input-group-text {
        cursor: pointer;
    }</style>
    <!-- Plugins css -->
    <link href="{{ asset('template/ubold/layouts/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/ubold/layouts/assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- App css -->
    <link href="{{ asset('template/ubold/layouts/assets/css/config/purple/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- icons -->
    <link href="{{ asset('template/ubold/layouts/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<!-- body start -->

<body class="loading" data-layout-mode="default" data-layout-color="light" data-topbar-color="dark"
    data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        @include('admin.components.topbar')
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.components.left_side_menu')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    @yield('content')
                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            @include('admin.components.footer')
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    @include('admin.components.right_sidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="{{ asset('template/ubold/layouts/assets/js/vendor.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('template/ubold/layouts/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('template/ubold/layouts/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="template/ubold/layouts/libs/selectize/js/standalone/selectize.min.js"></script>

    <!-- Dashboar 1 init js-->
    <script src="{{ asset('template/ubold/layouts/assets/js/pages/dashboard-1.init.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('template/ubold/layouts/assets/js/app.min.js') }}"></script>

</body>


</html>
