<!DOCTYPE html>
<html lang="en">
<!--
    **********************************************************************************************************
    Copyright (c) 2018 FitFriend
    **********************************************************************************************************
    -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <![endif]-->
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="" />
    <meta name="author" content="crucialdesigns.nl" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- The above 3 meta tags must come first in the head; any other head content must come after these tags -->
    <title>FitFriend</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/img/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{ URL::asset('assets/img/favicon.ico')}}" type="image/x-icon">
    <!-- Master Css -->
    <link href="{{ URL::asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/responsive.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/color.css')}}" rel="stylesheet" id="colors">
    <!-- Remember to include jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!--//=== pre-loder ===//-->
<div class="spinner-wrapper">
    <div class="spinner">
        <div class="cube1"></div>
        <div class="cube2"></div>
        <h3>Loading</h3>
    </div>
</div>
<!--//=== pre-loder Finesh ===//-->
<!--//=== Header Section ===//-->
<header id="header" class="nav-menu-sec">
    <div id="main-menu" class="wa-main-menu">
        <!-- Menu -->
        <div class="wathemes-menu relative">
            <!-- navbar -->
            <div class="navbar navbar-default theme-bg mar0" role="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="navbar-header">
                                <div class="body-menu-1">
                                    <!-- Button For Responsive toggle -->
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <!-- Logo -->
                                    <a class="navbar-brand" href="/#">
                                        <figure>
                                            <img class="site_logo hidden-xs" src="{{URL::asset('assets/img/test001.png')}}" alt="Site Logo">
                                            <img class="site_logo hidden-md hidden-lg hidden-sm" src="{{URL::asset('assets/img/test001.png')}}" alt="Site Logo">
                                        </figure>
                                    </a>
                                </div>
                            </div>
                            <!-- Navbar Collapse -->
                            <div class="navbar-collapse collapse body-menu-section">
                                <!-- nav -->
                                <ul class="nav navbar-nav menu-section">
                                    <li>
                                        <a href="/#">Home</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/#about">About Us</a></li>
                                            <li><a href="/#trainer">Trainers</a></li>
                                            <li><a href="/#services">Services</a></li>
                                            <li><a href="/#pricing">Pricing</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/contact">Contact</a></li>
                                    @if (Auth::check())
                                        <li><a href="/dashboard">Dashboard</a></li>
                                        <li><a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a></li>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @else
                                        <li><a href="/login">Login</a></li>
                                    @endif
                                </ul>
                            </div>
                            <!-- navbar-collapse -->
                        </div>
                    </div>
                    <!-- col-md-12 -->
                </div>
                <!-- container -->
            </div>
            <!-- navbar -->
        </div>
        <!--  Menu -->
    </div>
</header>
<!--//=== Header Section Finish ===//-->
@yield('content')
<div class="clear"></div>
<!--//=== Footer Section ===//-->
<section>
    <div class="detail-section">
        <div class="footer-secton-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="capitalize text-center text-color">
                            <p>© FitfriendPT <script>
                                    document.write(new Date().getFullYear());  // auto-updating year with javascript
                                </script></p>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <ul class="fot-bom-bar">
                            <li><a href="#about">About Us</a></li>
                            <li><a href="#trainer">Trainers</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <li><a href="/contact">Contact</a></li>
                            @if (Auth::check())
                                <li><a href="/dashboard">Dashboard</a></li>
                                <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                <li><a href="/login">Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--//=== Footer finish ===//-->
<!--//=== scroll top button ===//-->
<a id="scrollbtntop"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
<!--//=== scroll top button finish ===//-->
<!--//=== Finish ===//-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugin/owl-carousel/js/owl.carousel.min.js')}}"></script>
<script src="{{ URL::asset('assets/plugin/megamenu/js/hover-dropdown-menu.js')}}"></script>
<script src="{{ URL::asset('assets/plugin/megamenu/js/jquery.hover-dropdown-menu-addon.js')}}"></script>
<script src="{{ URL::asset('assets/plugin/fancybox/js/jquery.fancybox.pack.js')}}"></script>
<script src="{{ URL::asset('assets/plugin/fancybox/js/jquery.fancybox-media.js')}}"></script>
<script src="{{ URL::asset('assets/plugin/jquery-ui/js/jquery-ui.js')}}"></script>
<script src="{{ URL::asset('assets/plugin/counter/js/jquery.appear.js')}}"></script>
<script src="{{ URL::asset('assets/plugin/jquery-bxslider/js/jquery.bxslider.js')}}"></script>
<script src="{{ URL::asset('assets/plugin/counter/js/jquery.countTo.js')}}"></script>
<script src="{{ URL::asset('assets/js/main.js')}}"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>