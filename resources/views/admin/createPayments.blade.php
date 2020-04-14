@extends('layouts.admin')
@section('content')
        <!--site header ends -->
        <section class="admin-content">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <!--  container or container-fluid as per your need           -->
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-12">
                        <h4>Creeër een order voor een klant</h4><br>
                        @if (\Session::has('successC'))
                            <div class="alert alert-success">
                                <li>{!! \Session::get('successC') !!}</li>
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <form action="{{action('AdminController@storePayment')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <select class="selectpicker" data-live-search="true" name="user">
                                    @foreach($users as $user)
                                        <option data-subtext="{{$user->name}}" value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <select class="selectpicker" data-live-search="true" name="product">
                                    @foreach($products as $product)
                                        <option data-subtext="{{$product->name}}" value="{{$product->id}}">{{$product->name}} - {{$product->amount_of_lessons}} Lessen </option>
                                    @endforeach
                                </select>
                                <input type="submit" class="btn btn-success" value="Maak Order">
                            </div>
                        </form>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-12">
                        @if (\Session::has('success'))
                            <br>
                            <div class="alert alert-success">
                                <li>{!! \Session::get('success') !!}</li>
                            </div>
                        @elseif(\Session::has('error'))
                            <br>
                            <div class="alert alert-danger">
                                <li>{!! \Session::get('error') !!}</li>
                            </div>
                        @endif
                        <br>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-b-0">
                                    <i class="mdi mdi-checkbox-intermediate"></i> Onbetaalde Orders
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive p-t-10">
                                    <table id="example" class="table   " style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Name Product</th>
                                            <th>Prijs</th>
                                            <th>Aantal lessen</th>
                                            <th>Persoon</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{$payment->product->name}}</td>
                                                <td>&euro;{{$payment->product->price}}</td>
                                                <td>{{$payment->product->amount_of_lessons}}</td>
                                                <td>{{$payment->user->name}}</td>
                                                <td><a href="{{action('AdminController@deletePayment' , $payment->id)}}"> <i style="font-size: 20px;" class="mdi mdi-delete-circle"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PLACE PAGE CONTENT HERE -->
        </section>
    </main>
@endsection

