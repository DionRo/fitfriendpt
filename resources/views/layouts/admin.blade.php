<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <title>FitFriend PT</title>
    <link rel="icon" type="image/x-icon" href="{{URL::asset("/assets/admin/img/logo.png")}}"/>
    <link rel="icon" href="{{URL::asset("/assets/admin/img/logo.png")}}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{URL::asset("/assets/admin/vendor-ex/pace/pace.css")}}">
    <script src="{{URL::asset("/assets/admin/vendor-ex/pace/pace.min.js")}}"></script>
    <!--vendors-->
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset("/assets/admin/vendor-ex/bootstrap-datepicker/css/bootstrap-datepicker3.min.css")}}">
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset("/assets/admin/vendor-ex/jquery-scrollbar/jquery.scrollbar.css")}}">
    <link rel="stylesheet" href="{{URL::asset("/assets/admin/vendor-ex/select2/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{URL::asset("/assets/admin/vendor-ex/jquery-ui/jquery-ui.min.css")}}">
    <link rel="stylesheet" href="{{URL::asset("/assets/admin/vendor-ex/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{URL::asset("/assets/admin/vendor-ex/timepicker/bootstrap-timepicker.min.css")}}">
    <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset("/assets/admin/fonts/jost/jost.css")}}">
    <!--Material Icons-->
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset("/assets/admin/fonts/materialdesignicons/materialdesignicons.min.css")}}">
    <!--Bootstrap + atmos Admin CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset("/assets/admin/css/atmos.min.css")}}">
    <!-- Additional library for page -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

    <!-- Additional library for page -->
    <link rel="stylesheet" href="{{URL::asset('assets/admin/vendor-ex/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/admin/vendor-ex/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css')}}">
</head>
<style>
    table a, .centered a {
        color: #E48632;
        text-decoration: underline;
    }
</style>
<body class="sidebar-pinned ">
<aside class="admin-sidebar">
    <div class="admin-sidebar-brand">
        <!-- begin sidebar branding-->
        <span class="admin-brand-content font-secondary"><a href="index.html">FitFriend PT</a></span>
        <!-- end sidebar branding-->
        <div class="ml-auto">
            <!-- sidebar pin-->
            <a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
            <!-- sidebar close for mobile device-->
            <a href="#" class="admin-close-sidebar"></a>
        </div>
    </div>
    <div class="admin-sidebar-wrapper js-scrollbar">
        <ul class="menu">

            @if(Auth::user()->userLevel >= 0)
                <li class="menu-item @if (\Request::is('dashboard')) active @endif">
                    <a href="{{action('AdminController@index')}}" class=" menu-link">
                        <span class="menu-label">
                            <span class="menu-name">Home
                            </span>
                        </span>
                        <span class="menu-icon">
                             <i class="icon-placeholder mdi mdi-shape-outline "></i>
                        </span>
                    </a>
                </li>
                <li class="menu-item @if (\Request::is('dashboard/appointment') ||  \Request::is('dashboard/appointment/*')) active @endif ">
                    <a href="{{action('AppointmentController@index')}}" class="menu-link">
                    <span class="menu-label">
                             <span class="menu-name">Plan Afspraak
                            </span>
                        </span>
                        <span class="menu-icon">
                        <i class="icon-placeholder mdi mdi-calendar-clock"></i>
                    </span>
                    </a>
                </li>
                <li class="menu-item @if (\Request::is('dashboard/orders') ||  \Request::is('dashboard/orders/*')) active @endif  ">
                    <a href="{{action('OrderController@index')}}" class="menu-link">
                    <span class="menu-label">
                                    <span class="menu-name">Mijn Orders
                                    </span>

                                </span>
                        <span class="menu-icon">
                                    <i class="mdi mdi-credit-card-multiple"></i>
                                </span>
                    </a>
                </li>
                @if(Auth::user()->userLevel >= 1 )
                    <li class="menu-item @if (\Request::is('dashboard/agenda') ||  \Request::is('dashboard/agenda/*')) active @endif  ">
                        <a href="{{action('AdminController@agenda')}}" class="menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Agenda
                                                </span>

                                            </span>
                            <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-calendar-check"></i>
                                            </span>
                        </a>
                    </li>
                    <li class="menu-item @if (\Request::is('dashboard/trainers') ||  \Request::is('dashboard/trainers/*')) active @endif  ">
                        <a href="{{action('TrainerController@index')}}" class="menu-link">
                            <span class="menu-label">
                                            <span class="menu-name">Trainer Info
                                            </span>

                                        </span>
                            <span class="menu-icon">
                                             <i class="icon-placeholder mdi mdi-brain"></i>
                                        </span>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->userLevel >= 2 )
                    <li class="menu-item @if (\Request::is('dashboard/users') ||  \Request::is('dashboard/users/*')) active @endif  ">
                        <a href="{{action('UserController@index')}}" class="menu-link">
                        <span class="menu-label">
                                        <span class="menu-name">Beheer Gebruikers
                                        </span>

                                    </span>
                            <span class="menu-icon">
                                         <i class="icon-placeholder mdi mdi-account-details"></i>
                                    </span>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="/register" class="menu-link">
                    <span class="menu-label">
                                    <span class="menu-name">Registreer Gebruiker
                                    </span>

                                </span>
                            <span class="menu-icon">
                                     <i class="icon-placeholder mdi mdi-account-plus"></i>
                                </span>
                        </a>
                    </li>
                    <li class="menu-item @if (\Request::is('dashboard/payments') ||  \Request::is('dashboard/payments/*')) active @endif  ">
                        <a href="{{action('AdminController@payments')}}" class="menu-link">
                    <span class="menu-label">
                                    <span class="menu-name">Beheer Orders
                                    </span>

                                </span>
                            <span class="menu-icon">
                                    <i class="mdi mdi-credit-card-multiple"></i>
                                </span>
                        </a>
                    </li>
                    <li class="menu-item @if (\Request::is('dashboard/allOrders') ||  \Request::is('dashboard/allOrders/*')) active @endif  ">
                        <a href="{{action('AdminController@allOrders')}}" class="menu-link">
                    <span class="menu-label">
                                    <span class="menu-name">Alle Betaalde Orders
                                    </span>

                                </span>
                            <span class="menu-icon">
                                    <i class="mdi mdi-credit-card-multiple"></i>
                                </span>
                        </a>
                    </li>
                    <li class="menu-item @if (\Request::is('dashboard/products') ||  \Request::is('dashboard/products/*')) active @endif   ">
                        <a href="#" class="open-dropdown menu-link">
                        <span class="menu-label">
                                                <span class="menu-name">Products
                                                    <span class="menu-arrow"></span>
                                                </span>

                                            </span>
                            <span class="menu-icon">
                                                 <i class="icon-placeholder mdi mdi-lead-pencil "></i>
                                            </span>
                        </a>
                        <!--submenu-->
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="{{action('ProductController@index')}}" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Alle producten
                                                </span>
                                            </span>
                                    <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-checkbox-multiple-marked-circle "></i>
                                            </span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{action('ProductController@create')}}" class=" menu-link">
                                        <span class="menu-label">
                                                <span class="menu-name">Maak product
                                                </span>
                                            </span>
                                    <span class="menu-icon">

                                                    <i class="icon-placeholder mdi mdi-checkbook "></i>
                                            </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</aside>
<main class="admin-main">
    <!--site header begins-->
    <header class="admin-header">

        <a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>

        <nav class=" mr-auto my-auto">
            <ul class="nav align-items-center">

                <li class="nav-item">
                    <a class="nav-link  " data-target="#siteSearchModal" data-toggle="modal" href="#">
                        <i class=" mdi mdi-magnify mdi-24px align-middle"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <nav class=" ml-auto">
            <ul class="nav align-items-center">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-sm avatar-online">
                            <span class="avatar-title rounded-circle bg-dark"><i class="mdi mdi-account-check"></i></span>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right">
                        <a class="dropdown-item" href="#">{{Auth::user()->name}}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    @yield('content')



    <script src="{{URL::asset("/assets/admin/vendor-ex/jquery/jquery.min.js")}}"></script>
    <script src="{{URL::asset("/assets/admin/vendor-ex/jquery-ui/jquery-ui.min.js")}}"></script>
    <script src="{{URL::asset("/assets/admin/vendor-ex/popper/popper.js")}}"></script>
    <script src="{{URL::asset("/assets/admin/vendor-ex/bootstrap/js/bootstrap.min.js")}}"></script>
    <script src="{{URL::asset("/assets/admin/vendor-ex/select2/js/select2.full.min.js")}}"></script>
    <script src="{{URL::asset("/assets/admin/vendor-ex/jquery-scrollbar/jquery.scrollbar.min.js")}}"></script>
    <script src="{{URL::asset("/assets/admin/vendor-ex/listjs/listjs.min.js")}}"></script>
    <script src="{{URL::asset("/assets/admin/vendor-ex/moment/moment.min.js")}}"></script>
    <script src="{{URL::asset("/assets/admin/vendor-ex/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{URL::asset("/assets/admin/vendor-ex/bootstrap-datepicker/js/bootstrap-datepicker.min.js")}}"></script>
    <script src="{{URL::asset("/assets/admin/vendor-ex/bootstrap-notify/bootstrap-notify.min.js")}}"></script>
    <script src="{{URL::asset("/assets/admin/js/atmos.min.js")}}"></script>
    <!--page specific scripts for demo-->

    <!--Additional Page includes-->
    <script src="{{URL::asset("/assets/admin/vendor-ex/apexchart/apexcharts.min.js")}}"></script>
    <!--chart data for current dashboard-->
    <script src="{{URL::asset("/assets/admin/js/dashboard-03.js")}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

    <script src="{{URL::asset('assets/admin/vendor-ex/DataTables/datatables.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/js/datatable-data.js')}}"></script>
    <script>
        $("#example2").dataTable()
    </script>
</body>
</html>