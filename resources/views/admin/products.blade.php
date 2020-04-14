@extends('layouts.admin')

@section('content')
    <section class="admin-content ">
        <div class="container-fluid bg-dark m-b-30">
            <div class="row">

                <div class="col-lg-6 my-auto text-white p-t-20 ">

                    <h4 class=""><span class="js-greeting"></span> {{Auth::user()->name}}!</h4>
                    <p class="opacity-75 ">
                        did you know that, “Your body can stand almost anything. It’s your mind that you have to convince.”,<br>
                        besides that “Fitness is like a relationship. You can’t cheat and expect it to work.”. <br>
                        but HEY! “Respect your body. It’s the only one you get.”
                    </p>
                </div>
            </div>
        </div>

        <div class="container-fluid  p m-b-30">
            <div class="card m-b-30">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 my-auto">
                            <h5 class="m-0"><i class="mdi mdi-package"></i>Producten</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive p-t-10">
                            <table id="example" class="table" style="width:100%">
                                <thead>
                                <tr>
                                    <th style="width: 30%;">Naam</th>
                                    <th style="width: 30%;">Price</th>
                                    <th style="width: 30%;">Aantal Lessen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>&euro;{{$product->price}}</td>
                                        <td>{{$product->amount_of_lessons}}</td></tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection