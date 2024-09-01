<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name', 'Blog | Admin') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description">
        <meta content="Coderthemes" name="author">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('public\assets\images\favicon.ico') }}">

        @yield('css')
        
        <!-- App css -->
        <link href="{{ url('public\assets\css\bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
        <link href="{{ url('public\assets\css\icons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('public\assets\css\app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet">
    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ url('public\assets\images\users\user.png') }}" alt="user-image" class="rounded-circle">
                            <span class="d-none d-sm-inline-block ml-1">{{ Auth::User()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="{{ route('profile.index') }}" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-outline"></i>
                                <span><b>Profile</b></span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout-variant"></i>
                                    {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="{{ route('home') }}" class="logo text-center">
                        <span class="logo-lg">
                            <img src="{{ url('public\assets\images\logo-light.png') }}" alt="" height="18">
                            <!-- <span class="logo-lg-text-light">Zircos</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">Z</span> -->
                            <img src="{{ url('public\assets\images\logo-sm.png') }}" alt="" height="24">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                </ul>
            </div>
            <!-- end Topbar -->
            
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <li>
                                <a href="{{ route('home') }}" class="waves-effect waves-light">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span>  Dashboard  </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('blog.index') }}" class="waves-effect waves-light">
                                    <i class="far fa-newspaper"></i>
                                    <span>  Blog  </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('questions.index') }}" class="waves-effect waves-light">
                                    <i class="fas fa-question"></i>
                                    <span>  Question  </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('image.index') }}" class="waves-effect waves-light">
                                    <i class="mdi mdi-file-image-outline"></i>
                                    <span>  Image's  </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('category.index') }}" class="waves-effect waves-light">
                                    <i class="mdi mdi-shield-star"></i>
                                    <span>  Category  </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('comment.index') }}" class="waves-effect waves-light">
                                    <i class="mdi mdi-comment-text-outline"></i>
                                    <span>  Comment  </span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect waves-light">
                                    <i class="mdi mdi-settings-outline"></i>
                                    <span>  Setting  </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Admin Dashboard</a></li>
                                    <li><a href="#">User Dashboard</a></li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

                <div class="container">
                    <br>
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{ session('success') }}</strong>
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{ session('error') }}</strong>
                    </div>
                    @endif
                </div>

                @yield('content')
            </div>

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            2023 - 2024 &copy; Custom theme by <a href="#">MicroShorts</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
        <!-- END wrapper -->

        <!-- Vendor js -->
        <script src="{{ url('public\assets\js\vendor.min.js') }}"></script>
        
        <!-- App js -->
        <script src="{{ url('public\assets\js\app.min.js') }}"></script>

        <script>
            $('.back').click(function(){
                history.back();
            });

            $('document').ready(function()
            {
                $('textarea').each(function(){
                    $(this).val($(this).val().trim());
                });

                $(document).on('input', '.generateURL', function() {
                    $(".getURL").val(sanitizeUrl($(this).val()));
                });

                $(document).on('input', '.generateMetaTitle', function() {
                    $(".getMetaTitle").val($(this).val());
                });
            });

            function sanitizeUrl(url) {
                // Remove all characters except letters, numbers, spaces, and hyphens
                url = url.replace(/[^A-Za-z0-9 -]/g, '');
                // Replace spaces with hyphens
                url = url.replace(/\s+/g, '-');
                // Convert the string to lowercase
                return url.toLowerCase();
            }
        </script>

        @yield('scripts')
        
</body>

</html>