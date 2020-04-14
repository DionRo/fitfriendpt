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
            <div class="row">
                @if(Auth::user()->userLevel > 0)
                    <div class="col-lg-8 m-b-30">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="m-b-0">
                                    <h5 class="m-0"><i class="mdi mdi-package"></i> Mensen die laag zijn op lessen ( < 4)</h5>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table">
                                        <thead>
                                        <tr>
                                            <th>Naam</th>
                                            <th>Aantal Lessen</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$user->user->name}}</td>
                                                <td>{{$user->amount}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-md-12 m-b-30">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Recente Notities</div>
                                    </div>
                                    <div class="card-body">
                                        @foreach($notes as $note)
                                            <p>
                                                <b>{{$note->user->name}}</b> <br>{{$note->note}}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="m-b-0">
                                    <h5 class="m-0"><i class="mdi mdi-package"></i> Mensen die al lang niet zijn geweest (3 of +)</h5>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="table">
                                        <thead>
                                        <tr>
                                            <th>Naam</th>
                                            <th>Aantal Lessen</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($noAppointments as $user)
                                            <tr>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->card->amount}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
                @if(Auth::user()->userLevel == 3 || Auth::user()->userLevel == 0)

                    <div class="col-lg-12 m-b-30">
                        @if (session('statusS'))
                            <br>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Holy guacamole!</strong> {{ session('statusS') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @elseif(session('statusE'))
                            <br>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Holy guacamole!</strong> {{ session('statusE') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        <div class="card m-b-30">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6 my-auto">
                                        <h5 class="m-0"><i class="mdi mdi-package"></i>Uw Afspraken - Aantal lessen over: {{$card->amount}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th style="width: 30%;">Wanneer</th>
                                            <th style="width: 30%;">Tijdstip</th>
                                            <th style="width: 30%;">Trainer</th>
                                            <th style="width: 10%;text-align: center;">Acties</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($appointments as $appointment)
                                            <tr>
                                                <td><?php setlocale(LC_TIME, 'NL_nl');setlocale(LC_ALL, 'nl_NL');$string =  substr($appointment->date , 0 , -8);echo strftime("%A %e %B %Y", strtotime($string));?></td>
                                                <td>{{$appointment->start}}:00 - {{$appointment->end}}:00</td>
                                                <td> @foreach($trainers as $trainer)
                                                        @if($trainer->id ==  $appointment->trainer_id)
                                                            {{$trainer->user->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <form action="{{action('AppointmentController@destroy', $appointment->id)}}" style="text-align: center;" method="POST">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                        <input type="submit" value="Annuleer" class="btn m-b-15 ml-2 mr-2 btn-danger">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="card m-b-30">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            <h5 class="m-0"><i class="mdi mdi-package"></i>Uw Progressie</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Toegevoegd op</th>
                                                <th>Vet Percentage (%)</th>
                                                <th>Spiermassa (%)</th>
                                                <th>BMI</th>
                                                <th>Bloeddruk</th>
                                                <th>Gewicht</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($stats as $stat)
                                                <tr>
                                                    <td>{{$stat->created_at}}</td>
                                                    <td>{{$stat->fatmass}}%</td>
                                                    <td>{{$stat->musclemass}}%</td>
                                                    <td>{{$stat->bmi}}</td>
                                                    <td>{{$stat->bloodpressure}}</td>
                                                    <td>{{$stat->weight}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection