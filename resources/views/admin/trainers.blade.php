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
                            <h5 class="m-0"><i class="mdi mdi-package"></i>Trainers</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 20%;">Naam</th>
                                <th style="width: 70%;">Email</th>
                                <th style="width: 10%;text-align: center;">Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trainers as $trainer)
                                <tr>
                                    <td>{{$trainer->user->name}}</td>
                                    <td>{{$trainer->my_quote}}</td>
                                    <td><a href="{{action('TrainerController@edit', $trainer->id)}}"><i class="mdi mdi-account-edit"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection