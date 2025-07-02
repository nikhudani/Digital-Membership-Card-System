<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Portfolio HTML Template" name="keywords">
    <meta content="Portfolio HTML Template" name="description">
    <title>{{ TE::system('title', env('APP_NAME')) }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/brand/favicon.ico')}}">
        <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    {{-- <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet"> --}}

    <!-- Template Stylesheet -->
    <link href="{{asset('landing/css/style.css')}}" rel="stylesheet">

</head>
    <body>
        <!-- Header Nav Start -->
        <div id="header">
            <div class="container-fluid">
                <div id="logo" class="pull-left">
                    <a href="#">
                        <img src="{{asset("images/brand")}}/{{TE::system('logo', 'logo.png')}}" alt="{{ TE::system('title', env('APP_NAME')) }}" height="70" width="240" onerror="this.remove();">    
                    </a>
                </div>

                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="#">Home</a></li>
                        @if (Route::has('login'))
                            @auth
                                <li>
                                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}">Log in</a>
                                </li>

                                <li>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}">Register</a>
                                    @endif
                                </li>
                            @endauth
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Header Nav End -->
        <!-- Header carousel Start-->
        <div id="header-carousel">
            <div class="header-carousel-container">
                <div id="headerCarousel" class="carousel" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            {{-- <div class="carousel-background">
                                <img src="{{asset('landing/img/banner1.png')}}" alt="banner">
                            </div> --}}
                            <div class="carousel-container">
                                <div class="carousel-content">
                                    <h2>DIGITAL WEDDING PASS</h2>
                                    <p class="pr-5">
                                        With our wedding pass you can get up to 10% discount on your wedding expenses and stand a chance to win prizes
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header carousel End-->
        <!-- About Us Start-->
        @php
            use App\Models\Dashboard\Vendor\Settings\Category;
            use App\Models\Dashboard\Vendor\Settings\Location;
            use App\Models\Dashboard\Vendor\Settings\Type;
            use App\Models\Dashboard\Vendor\VendorDetail;
        @endphp
        <div id="about">
            <div class="container-fluid">
                <div class="row">
                    <div class="col about-col border-right">
                        <div class="about-content">
                            <h2>
                                {{Type::count()}}
                            </h2>
                            <h2>Types of Wedding </h2>
                        </div>
                    </div>
                    <div class="col about-col border-right">
                        <div class="about-content">
                            <h2>
                                {{Category::count()}}
                            </h2>
                            <h2>Wedding categories </h2>
                        </div>
                    </div>
                    <div class="col about-col border-right">
                        <div class="about-content">
                            <h2>
                                {{Location::count()}}
                            </h2>
                            <h2>States</h2>
                        </div>
                    </div>
                    <div class="col about-col">
                        <div class="about-content">
                            <h2>{{VendorDetail::count()}}</h2>
                            <h2>Premium Vendors</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Us End-->
        
        <!-- Services Start -->
        <div id="services">
            <div class="container">
                <div class="section-header">
                    <h2>ABOUT</h2>
                    <p>
                        Wedding Pass is designed to help you saved money for your dream wedding.
                    </p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="service-col">
                            <div class="service-icon"><i class="fa fa-money"></i></div>
                            <h3>Get Discounts</h3>
                            <div class="service-detail">
                                Enjoy up to 10% discount with Wedding Pass and make direct booking.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="service-col">
                            <div class="service-icon"><i class="fa fa-exchange"></i> </div>
                            <h3>Fast & Easy</h3>
                            <div class="service-detail">
                                Show digital Wedding pass to vendor and get the discount.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="service-col">
                            <div class="service-icon"><i class="fa fa-briefcase"></i> </div>
                            <h3>Verified Vendors</h3>
                            <div class="service-detail">
                                All Wedding Premium vendors are experienced, trusted and reliable.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="service-col">
                            <div class="service-icon"><i class="fa fa-shield"></i> </div>
                            <h3>Saved Money</h3>
                            <div class="service-detail">
                                Your Wedding budget can be saved and allocated for other expenses.
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <!-- Services End -->
        <!-- Footer Start -->
        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{asset("images/brand")}}/{{TE::system('logo', 'logo.png')}}" alt="{{ TE::system('title', env('APP_NAME')) }}" height="70" width="240" onerror="this.remove();">    
                        <p class="mt-4">
                            Wedding Pass is an exclusive membership pass that entitles users to enjoy discount from vendor.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h2>Contact Us</h2>
                        <p class="mt-4">
                            +60 13-7373632
                            <br>
                            dsasd@gmail.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('landing/lib/easing/easing.min.js')}}"></script>
        <script src="{{asset('landing/lib/menuspy/menuspy.min.js')}}"></script>
        <script src="{{asset('landing/lib/waypoints/waypoints.min.js')}}"></script>
        <script src="{{asset('landing/lib/counterup/counterup.min.js')}}"></script>
        <script src="{{asset('landing/lib/owlcarousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('landing/lib/isotope/isotope.pkgd.min.js')}}"></script>
        <script src="{{asset('landing/lib/lightbox/js/lightbox.min.js')}}"></script>

        <!-- Template Javascript -->
        <script src="{{asset('landing/js/main.js')}}"></script>
    </body>
</html>