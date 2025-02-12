<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Karma Shop</title>
    <!--
  CSS
  ============================================= -->
    <link rel="stylesheet" href="{{ asset('landing_assets/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/ion.rangeSlider.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing_assets/css/ion.rangeSlider.skinFlat.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing_assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('landing_assets/css/main.css') }}">
</head>

<body>

    <!-- Start Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html"><img
                            src="{{ asset('landing_assets/img/logo.png') }}" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="/">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="/products">Product</a></li>
                            @if (auth()->user())
                                <li class="nav-item"><a class="nav-link"
                                        href="/my-profile">{{ auth()->user()->name }}</a></li>
                                <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                            @endif
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item"><a href="/keranjang" class="cart"><span class="ti-bag"></span></a>
                            </li>
                            <li class="nav-item"><a href="/wishlist" class="cart"><span class="ti-heart"></span></a>
                            </li>
                            <li class="nav-item">
                                <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between" action="/products">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here"
                        name="keyword">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- End Header Area -->

    @yield('content')

    <!-- start footer Area -->
    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>About Us</h6>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                            ut labore dolore
                            magna aliqua.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-6">
                    <div class="single-footer-widget">
                        <h6>Follow Us</h6>
                        <p>Let us be social</p>
                        <div class="footer-social d-flex align-items-center">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
                <p class="footer-text m-0">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </div>
    </footer>
    <!-- End footer Area -->

    <script src="{{ asset('landing_assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('landing_assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('landing_assets/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/countdown.js') }}"></script>
    <script src="{{ asset('landing_assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/owl.carousel.min.js') }}"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="{{ asset('landing_assets/js/gmaps.min.js') }}"></script>
    <script src="{{ asset('landing_assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- @yield('scripts') --}}
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        @if (session('success'))
            Toast.fire({
                icon: "success",
                title: @json(session('success'))
            });
        @endif
    </script>
</body>

</html>
