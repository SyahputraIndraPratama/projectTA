﻿<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=" " />
    <meta name="keywords" content="" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ 'img/logo/logo.png' }}" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Custom Css -->
    <link href="{{ asset('signin/css/style.css') }}" rel="stylesheet" />

</head>

<body>
    <!--start page Loader -->
    <!-- <div id="preloader">
        <div id="status">
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div> -->
    <!--end page Loader -->

    <!-- Begin page -->
    <div>
        <div class="main-content">
            <div class="page-content">
                <!-- START SIGN-IN -->
                <section class="bg-auth">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-10 col-lg-12">
                                <div class="card auth-box">
                                    <div class="row g-0">
                                        <div class="col-lg-6 text-center">
                                            <div class="card-body p-4">
                                                <div class="mt-5">
                                                    <img src="{{ asset('img/1.svg') }}" alt=""
                                                        class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-6">
                                            <div class="auth-content card-body p-5 h-100 text-white">
                                                <div class="w-100">
                                                    <div class="text-center mb-4">
                                                        <h5>Login</h5>
                                                        <p class="text-white-70">Sign in to continue your activity.</p>
                                                    </div>
                                                    @if (session('message'))
                                                        <div class="alert alert-danger">
                                                            {{ session('message') }}
                                                        </div>
                                                    @endif
                                                    <form action="{{ route('karyawan.login') }}" method="post"
                                                        class="auth-form">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="username" class="form-label">Username</label>
                                                            <input id="username" class="form-control" type="text"
                                                                name="username" :value="old('username')"
                                                                placeholder="Enter your username" required autofocus
                                                                autocomplete="username">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label">Password</label>
                                                            <input id="password" class="form-control" type="password"
                                                                name="password" placeholder="Enter your password"
                                                                required autofocus autocomplete="new-password">
                                                        </div>
                                                        <br>
                                                        <div class="text-center">
                                                            <button type="submit"
                                                                class="btn btn-white btn-hover w-100">Sign In</button>
                                                        </div>
                                                    </form>
                                                    <div class="mt-4">
                                                        @if (Route::has('password.request'))
                                                            <a href="{{ route('password.request') }}"
                                                                class="fw-medium text-white">
                                                                <p class="mb-0">Forgot Password?</p>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end auth-box-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end container-->
                </section>
                <!-- END SIGN-IN -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Style switcher -->
    <div id="style-switcher" onclick="toggleSwitcher()" style="left: -165px;">
        <div>
            <h6>Select your color</h6>
            <ul class="pattern list-unstyled mb-0">
                <li>
                    <a class="color-list color1" href="javascript: void(0);" onclick="setColorGreen()"></a>
                </li>
                <li>
                    <a class="color-list color2" href="javascript: void(0);" onclick="setColor('blue')"></a>
                </li>
                <li>
                    <a class="color-list color3" href="javascript: void(0);" onclick="setColor('green')"></a>
                </li>
            </ul>
            <div class="mt-3">
                <h6>Light/dark Layout</h6>
                <div class="text-center mt-3">
                    <!-- light-dark mode -->
                    <a href="javascript: void(0);" id="mode" class="mode-btn text-white rounded-3">
                        <i class="uil uil-brightness mode-dark mx-auto"></i>
                        <i class="uil uil-moon mode-light"></i>
                    </a>
                    <!-- END light-dark Mode -->
                </div>
            </div>
        </div>
        <div class="bottom d-none d-md-block">
            <a href="javascript: void(0);" class="settings rounded-end"><i class="mdi mdi-cog mdi-spin"></i></a>
        </div>
    </div>
    <!-- end switcher-->

    <!--start back-to-top-->
    <button onclick="topFunction()" id="back-to-top">
        <i class="mdi mdi-arrow-up"></i>
    </button>
    <!--end back-to-top-->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js"></script>
    <!-- Switcher Js -->
    <script src="{{ asset('js/switcher.init.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session('invalid'))
        <script>
            swal("Access Denied", "{{ session('invalid') }}", "warning");
        </script>
        <?php session()->forget('invalid'); ?>
    @endif

</body>

</html>
