@extends('layouts.admin')
@section('content')
        <!--site header ends -->
        <section class="admin-content">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <!--  container or container-fluid as per your need           -->
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="m-b-0">
                                    <i class="mdi mdi-checkbox-intermediate"></i> Onbetaalde Orders
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-td-middle">
                                        <thead>
                                        <tr>
                                            <th>Name Product</th>
                                            <th>Prijs</th>
                                            <th>Aantal lessen</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{$payment->product->name}}</td>
                                                <td>@php $taxPrice = $payment->product->price * 1.09;@endphp @php echo $moneyFormat->formatCurrency($taxPrice, "EUR"); @endphp</td></td>
                                                <td>{{$payment->product->amount_of_lessons}}</td>
                                                <td><button type="submit" form="accForm{{$payment->id}}" class="btn btn-success">Betaal Order</button></td>
                                            </tr>
                                            <form style="display: none;" id="accForm{{$payment->id}}" action="{{action("OrderController@update" , $payment->id)}}" method="post">
                                                {{ method_field('PUT') }}
                                                @csrf
                                            </form>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{$order->product->name}}</td>
                                                <td>@php $taxPrice = $order->product->price * 1.09;@endphp @php echo $moneyFormat->formatCurrency($taxPrice, "EUR"); @endphp</td>
                                                <td>{{$order->product->amount_of_lessons}}</td>
                                                <td><a style="text-decoration: none;" href="{{action('OrderController@show', $order->id)}}" class="btn  btn-success">Toon PDF</a></td>
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
    <script>
        $('#example2').dataTable(); //replace id with your second table's id
    </script>
@endsection

