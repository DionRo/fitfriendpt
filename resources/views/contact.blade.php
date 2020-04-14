@extends('layouts.masterOther')
@section('content')
    <!--//=== breadcrumb-section ===//-->
    <div class="detail-section">
        <div class="container-fluid">
            <div class="row ">
                <div class="special-style special-style-dark col-md-12 breadcrumb-img-section">
                    <div class="bg-image" style="background-image:url({{URL::asset('assets/img/banner/banner-1.jpg')}});"></div>
                </div>
                <div class="breadcrumb-section text-center padT200 padB100">
                    <h3>contact us</h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li style="color: white;" class="/contact">Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--//=== breadcrumb-section Finesh ===//-->
    <!--//=== Map Section ===//-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2479.654119958215!2d4.827385315739645!3d51.574573979646175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6a1f9c25cc7b7%3A0x34b1ee8e97db0b75!2sSportcentrum+Gymnasium!5e0!3m2!1snl!2snl!4v1544532769438" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!--//=== Map Section finish ===//-->
    <section class="padTB20">
        <div class="container">
            <div class="row">
                <div class="contact-text">
                    <h3>send your query or call us at <a href="tel:+31681314022" style="color: #f22e2e;">+31681314022</a></h3>
                </div>
                <form action="/sendemail" method="POST">
                    @csrf
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="post-gray">
                            <input type="text" name="fullname" value="" placeholder="Volledige Naam">
                            <input type="text" name="email" value="" placeholder="Email">
                            <input type="text" name="subject" value="" placeholder="Uw Onderwerp">
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="post-gray marT20">
                            <textarea name="message" placeholder="Typ hier uw bericht" rows="5" cols="50"></textarea>
                        </div>
                    </div>
                    @if(env('GOOGLE_RECAPTCHA_KEY'))
                        <div class="col-md-12">
                            <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                        </div>
                    @endif
                    <div class="col-md-12 col-sm-6 col-xs-12 marT30">
                        <button type="submit" class="itg-button-3">Verzend</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        window.onload = function () {
            document.getElementById("g-recaptcha-response").name = "response";
            document.getElementById("g-recaptcha-response").required = true;
        }
    </script>
@endsection