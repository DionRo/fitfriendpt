@extends('layouts.masterOther')
@section('content')
    <!--//=== breadcrumb-section ===//-->
    <div class="detail-section">
        <div class="container-fluid">
            <div class="row ">
                <div class="special-style special-style-dark col-md-12 breadcrumb-img-section">
                    <div class="bg-image" style="background-image:url({{URL::asset('assets/img/banner/banner-1.jpg')}})";></div>
                </div>
                <div class="breadcrumb-section text-center padT200 padB100">
                    <h3>Our Trainers</h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li class="active">Trainers</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--//=== breadcrumb-section Finesh ===//-->
    <section class="padTB100">
        <div class="services-details-pages">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="service-text padT10">
                            <h3>{{$trainer->user->name}}<br><span style="font-size: 15px; color: #f22e2e;">{{$trainer->my_quote}}</span></h3>
                            <p>{{$trainer->my_story}}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="about-font padT50">
                            <div class="detail-section trainer-color-1 padTB30">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p><strong class="capitalize">Age</strong></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p class="capitalize">{{$trainer->age}} Years Old</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p><strong class="capitalize">experience</strong></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p class="capitalize">{{$trainer->experience}} Year</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p><strong class="capitalize">qualification</strong></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p>{{$trainer->education}}</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p><strong class="capitalize">Favorite Workout</strong></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p class="capitalize">{{$trainer->most}}</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p><strong class="capitalize">Favorite Cheat Snack</strong></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p class="capitalize">{{$trainer->snack}}</p>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p><strong class="capitalize">Least Favorite Workout</strong></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p class="capitalize">{{$trainer->least}}</p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p><strong class="capitalize">reviews</strong></p>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="trainer-icon">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Hier moeten nog dingen bekeken worden -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12"></div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <br>
                        <figure>
                            <img style="margin-top: 33px;" src="{{URL::asset($trainer->trainer_image)}}" alt="">
                        </figure>
                    </div>
                    <div class="col-md-12">
                        <div class="service-class">
                            <h3 class="padT40">Most Important</h3>
                            <p class="padT20 padB20 mar0">{{$trainer->most_important}}
                            <h3 >My Specialization</h3>
                            <p>{{$trainer->specialisation}}</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection