<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <title>FitFriend PersonalTraining</title>
    <link rel="stylesheet" href="{{URL::asset("assets/admin/vendor-ex/pace/pace.css")}}">
    <script src="{{URL::asset("assets/admin/vendor-ex/pace/pace.min.js")}}"></script>
    <!--vendors-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset("assets/admin/vendor-ex/bootstrap-datepicker/css/bootstrap-datepicker3.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset("assets/admin/vendor-ex/jquery-scrollbar/jquery.scrollbar.css")}}">
    <link rel="stylesheet" href="{{URL::asset("assets/admin/vendor-ex/select2/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{URL::asset("assets/admin/vendor-ex/jquery-ui/jquery-ui.min.css")}}">
    <link rel="stylesheet" href="{{URL::asset("assets/admin/vendor-ex/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{URL::asset("assets/admin/vendor-ex/timepicker/bootstrap-timepicker.min.css")}}">
    <link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset("assets/admin/fonts/jost/jost.css")}}">
    <!--Material Icons-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset("assets/admin/fonts/materialdesignicons/materialdesignicons.min.css")}}">
    <!--Bootstrap + atmos Admin CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset("assets/admin/css/atmos.min.css")}}">
    <!-- Additional library for page -->

</head>
<body class="jumbo-page">

<main class="admin-main  ">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-4  bg-white">
                <div class="row align-items-center m-h-100">
                    <div class="mx-auto col-md-8">
                        <div class="p-b-20 text-center">
                            <p>
                                <img src="{{ URL::asset('assets/img/new1.svg') }}" width="100" alt="">

                            </p>
                            <p class="admin-brand-content">
                                FitFriend Personal Training
                            </p>
                        </div>
                        <h3 class="text-center p-b-20 fw-400">Login</h3>
                        <form class="needs-validation" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group floating-label col-md-12">
                                    <label>Email</label>
                                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                                </div>
                                <div class="form-group floating-label col-md-12">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Remember me</label>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="margin-left: 10px;">
                                </div>
                                <br>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg">{{ __('Log in') }}</button>

                        </form>
                        <p class="text-right p-t-10">
                            <a href="/" class="text-underline">Go back</a>
                            <a href="{{ route('password.request') }}" class="text-underline">Forgot Password?</a>
                        </p>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('assets/admin/img/login.svg');">

            </div>
        </div>
    </div>
</main>

<script src="{{URL::asset("assets/admin/vendor-ex/jquery/jquery.min.js")}}"   ></script>
<script src="{{URL::asset("assets/admin/vendor-ex/jquery-ui/jquery-ui.min.js")}}"   ></script>
<script src="{{URL::asset("assets/admin/vendor-ex/popper/popper.js")}}"   ></script>
<script src="{{URL::asset("assets/admin/vendor-ex/bootstrap/js/bootstrap.min.js")}}"   ></script>
<script src="{{URL::asset("assets/admin/vendor-ex/select2/js/select2.full.min.js")}}"   ></script>
<script src="{{URL::asset("assets/admin/vendor-ex/jquery-scrollbar/jquery.scrollbar.min.js")}}"   ></script>
<script src="{{URL::asset("assets/admin/vendor-ex/listjs/listjs.min.js")}}"   ></script>
<script src="{{URL::asset("assets/admin/vendor-ex/moment/moment.min.js")}}"></script>
<script src="{{URL::asset("assets/admin/vendor-ex/daterangepicker/daterangepicker.js")}}"></script>
<script src="{{URL::asset("assets/admin/vendor-ex/bootstrap-datepicker/js/bootstrap-datepicker.min.js")}}"></script>
<script src="{{URL::asset("assets/admin/vendor-ex/bootstrap-notify/bootstrap-notify.min.js")}}"   ></script>
<script src="{{URL::asset("assets/admin/js/atmos.min.js")}}"></script>
<!--page specific scripts for demo-->

</body>
</html>