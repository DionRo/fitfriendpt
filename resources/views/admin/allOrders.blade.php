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
                        <div class="card">
                            <div class="card-header">
                                <h5 class="m-b-0">
                                    <i class="mdi mdi-checkbox-intermediate"></i> Betaalde Orders
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive p-t-10">
                                    <table id="example" class="table" style="width:100%">
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
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{$order->product->name}}</td>
                                                <td>{{$moneyFormat->formatCurrency(( $order->product->price * 1.09 ), "EUR")}}</td>
                                                <td>{{$order->product->amount_of_lessons}}</td>
                                                <td>{{$order->user->name}}</td>
                                                <td><a style="text-decoration: none;" href="{{action('AdminController@showPDF', $order->id)}}" class="btn  btn-success">Toon PDF</a></td>
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

