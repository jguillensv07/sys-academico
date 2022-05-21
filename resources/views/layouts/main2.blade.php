<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{Env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{Env('APP_NAME')}}" name="description" />
    <meta content="Jhonattan Guillen Dev" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('img/favicon.ico') }}">

    <!-- Plugins css-->
    <link href="{{ URL::asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />    

    <!-- App css -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{ URL::asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <link href="{{ URL::asset('css/sitev1.css') }}" rel="stylesheet" type="text/css" />

</head>

<body data-layout="horizontal">

    <!-- Begin page -->
    <div id="wrapper">


        <!-- Navigation Bar-->
        <header id="topnav">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-right mb-0">

                        <li class="dropdown notification-list">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-bell-outline noti-icon"></i>
                                <span class="badge badge-pink rounded-circle noti-icon-badge">1</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="font-16 m-0">
                                        <span class="float-right">
                                            <a href="" class="text-dark">
                                                <small>Clear All</small>
                                            </a>
                                        </span>Notification
                                    </h5>
                                </div>

                                <div class="slimscroll noti-scroll">

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon">
                                            <i class="mdi mdi-comment-account-outline text-info"></i>
                                        </div>
                                        <p class="notify-details">
                                            Message 1
                                            <small class="noti-time">
                                                1 min ago
                                            </small>
                                        </p>
                                    </a>
                                </div>

                                <!-- All-->
                                <a href="javascript:void(0);" class="dropdown-item text-center notify-item notify-all">
                                    See all notifications
                                </a>

                            </div>
                        </li>


                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ URL::asset('img/avatardefault.png') }}" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ml-1">
                                    {{ "Auth::user()->name" }}
                                    <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="/account" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account-outline"></i>
                                    <span>My Account</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout-variant"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form"  method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>

                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="/" class="logo text-center logo-dark">
                            <span class="logo-lg">
                                <img src="{{ URL::asset('img/sodabiz.png') }}" alt="" height="56">
                                <!-- <span class="logo-lg-text-dark">Velonic</span> -->
                            </span>
                            <span class="logo-sm">
                                <!-- <span class="logo-lg-text-dark">V</span> -->
                                <img src="{{ URL::asset('img/sodabiz.png') }}" alt="" height="22">
                            </span>
                        </a>

                        <a href="/" class="logo text-center logo-light">
                            <span class="logo-lg">
                                <img src="{{ URL::asset('img/sodabiz.png') }}" alt="" height="56">
                                <!-- <span class="logo-lg-text-dark">Velonic</span> -->
                            </span>
                            <span class="logo-sm">
                                <!-- <span class="logo-lg-text-dark">V</span> -->
                                <img src="{{ URL::asset('img/sodabiz.png') }}" alt="" height="22">
                            </span>
                        </a>
                    </div>
                    <!-- LOGO -->

                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->

            <div class="topbar-menu">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">


                            <li class="has-submenu">
                                <a href="/"> <i class="ion-md-speedometer"></i> Dashboard </a>
                            </li>

                            
                            <li class="has-submenu">
                                <a href="/containers"> <i class="fas fa-truck-moving"></i> Containers </a>
                            </li>
                            

                            
                            <li class="has-submenu">
                                <a href="#"> <i class="fab fa-firstdraft"></i> Jobs </a>
                                <ul class="submenu">
                                    <li><a href="/jobs/waiting-list">Waiting List</a></li>
                                    <li><a href="/jobs">Register Job</a></li>
                                    <li><a href="/jobs/archived">Archived Jobs</a></li>
                                </ul>
                            </li>
                            

                            
                            <li class="has-submenu">
                                <a href="#"> <i class="fas fa-box"></i> Equipment Rental </a>
                                <ul class="submenu">
                                    <li><a href="/equipment/active-orders">Active Orders</a></li>
                                    <li><a href="/equipment/archived-orders">Archived Orders</a></li>
                                </ul>
                            </li>
                            

                            
                            <li class="has-submenu">
                                <a href="#"> <i class="fas fa-chart-bar"></i> Reports </a>
                                <ul class="submenu">
                                    <li><a href="/containers/list-all">List of Containers</a></li>
                                </ul>
                            </li>
                            

                            
                            <li class="has-submenu">
                                <a href="#"> <i class="mdi mdi-settings"></i> Configurations </a>
                                <ul class="submenu">
                                    <li><a href="/users">Users</a></li>
                                    <li><a href="/settings">Settings</a></li>
                                </ul>
                            </li>
                            

                        </ul>
                        <!-- End navigation menu -->

                        <div class="clearfix"></div>
                    </div>
                    <!-- end #navigation -->
                </div>
                <!-- end container -->
            </div>
            <!-- end navbar-custom -->

        </header>
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid p-2">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ Env('APP_NAME') }}</h4>
                                @yield('breadcrumb')
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    @yield('content')

                </div>
                <!-- end container-fluid -->

            </div>
            <!-- end content -->



            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            2020 &copy; {{Env('APP_NAME')}} Versión {{Env('APP_VERSION')}}  by <a href="https://smartsoftwaresv.net">SmartSoftwareSV</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->


    <!-- Vendor js -->
    <script src="{{ URL::asset('js/vendor.min.js') }}"></script>

    <!--<script src="{{ URL::asset('libs/moment/moment.min.js') }}"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
    <script src="{{ URL::asset('libs/jquery-scrollto/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ URL::asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('libs/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ URL::asset('libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('libs/switchery/switchery.min.js') }}"></script>
    <script src="{{ URL::asset('libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    

    <!-- App js -->
    <script src="{{ URL::asset('js/app.min.js') }}"></script>
    <script src="{{ URL::asset('js/site.js') }}"></script>

    @yield('custom-scripts')

</body>

</html>