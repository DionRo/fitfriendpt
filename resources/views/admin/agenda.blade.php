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
            @if(Auth::user()->userLevel >= 2)
            <form action="{{action('AdminController@agendaSearch')}}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="trainer" style="height: 15px;">Kies Trainer</label>
                        <select class="form-control" id="trainer" name="trainer" >
                            @foreach($trainers as $trainer)
                                <option value="{{$trainer->id}}" @if($searchedTrainer != NULL && $searchedTrainer == $trainer->user_id) selected @elseif(Auth::user()->id == $trainer->user_id) selected @endif>{{$trainer->user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="weekNr" style="height: 15px;">Week Nummer</label>
                        <input class="form-control" id="weekNr" name="weekNr" type="number" value="{{$now}}">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="weekNr" style="height: 15px;">Jaar</label>
                        <input class="form-control" id="weekNr" name="year" type="number" value="{{$nowYear}}">
                    </div>
                    <div class="form-group col-md-1">
                        <input class="btn btn-primary" type="submit" value="Zoek" class="save" style="margin-top: 22px;">
                    </div>
                </div>
            </form>
            @endif
            @if (session('statusS'))
                <br>
                <div class="alert alert-border-success  alert-dismissible fade show" role="alert">
                    <div class="d-flex">
                        <div class="icon">
                            <i class="icon mdi mdi-check-circle-outline"></i>
                        </div>
                        <div class="content">
                            <strong>Holy guacamole!</strong> {{ session('statusS') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                </div>
            @elseif(session('statusE'))
                <br>
                <div class="alert alert-border-info  alert-dismissible fade show" role="alert">
                    <div class="d-flex">
                        <div class="icon">
                            <i class="icon mdi mdi-alert-circle-outline"></i>
                        </div>
                        <div class="content">
                            <strong>Holy guacamole!</strong>  {{ session('statusE') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>

                </div>
            @endif
            <?php $i= 0;?>
            <!--  Monday -->
            <div class="card m-b-30">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 my-auto">
                            <h5 class="m-0"><i class="mdi mdi-package"></i>Maandag</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 10%;">Start</th>
                                <th style="width: 10%;">Einde</th>
                                <th style="width: 50%;">Met wie</th>
                                <th style="width: 30%;">Acties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appointments as $appointment)
                                <?php $i++; ?>
                                @if($appointment->day == 0)
                                <tr>
                                    <td>{{$appointment->start}}:00</td>
                                    <td>{{$appointment->end}}:00</td>
                                    <td>{{$appointment->user->name}} - {{$appointment->user->email}}</td>
                                    <td><button form="form{{$i}}" class="btn btn-danger">Annuleer</button></td>
                                    <form id="form{{$i}}" action="{{action('AppointmentController@destroy', $appointment->id)}}" style="display: none;" method="POST">
                                        @csrf
                                        {{method_field('delete')}}
                                    </form>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--  Tuesday -->
            <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 my-auto">
                                <h5 class="m-0"><i class="mdi mdi-package"></i>Dinsdag</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">Start</th>
                                    <th style="width: 10%;">Einde</th>
                                    <th style="width: 50%;">Met wie</th>
                                    <th style="width: 30%;">Acties</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $appointment)
                                    <?php $i++; ?>
                                    @if($appointment->day == 1)
                                        <tr>
                                            <td>{{$appointment->start}}:00</td>
                                            <td>{{$appointment->end}}:00</td>
                                            <td>{{$appointment->user->name}} - {{$appointment->user->email}}</td>
                                            <td><button form="form{{$i}}" class="btn btn-danger">Annuleer</button></td>
                                            <form id="form{{$i}}" action="{{action('AppointmentController@destroy', $appointment->id)}}" style="display: none;" method="POST">
                                                @csrf
                                                {{method_field('delete')}}
                                            </form>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <!--  Wensday -->
            <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 my-auto">
                                <h5 class="m-0"><i class="mdi mdi-package"></i>Woensdag</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">Start</th>
                                    <th style="width: 10%;">Einde</th>
                                    <th style="width: 50%;">Met wie</th>
                                    <th style="width: 30%;">Acties</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $appointment)
                                    <?php $i++; ?>
                                    @if($appointment->day == 2)
                                        <tr>
                                            <td>{{$appointment->start}}:00</td>
                                            <td>{{$appointment->end}}:00</td>
                                            <td>{{$appointment->user->name}} - {{$appointment->user->email}}</td>
                                            <td><button form="form{{$i}}" class="btn btn-danger">Annuleer</button></td>
                                            <form id="form{{$i}}" action="{{action('AppointmentController@destroy', $appointment->id)}}" style="display: none;" method="POST">
                                                @csrf
                                                {{method_field('delete')}}
                                            </form>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <!--  Thursday -->
            <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 my-auto">
                                <h5 class="m-0"><i class="mdi mdi-package"></i>Donderdag</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">Start</th>
                                    <th style="width: 10%;">Einde</th>
                                    <th style="width: 50%;">Met wie</th>
                                    <th style="width: 30%;">Acties</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $appointment)
                                    <?php $i++; ?>
                                    @if($appointment->day == 3)
                                        <tr>
                                            <td>{{$appointment->start}}:00</td>
                                            <td>{{$appointment->end}}:00</td>
                                            <td>{{$appointment->user->name}} - {{$appointment->user->email}}</td>
                                            <td><button form="form{{$i}}" class="btn btn-danger">Annuleer</button></td>
                                            <form id="form{{$i}}" action="{{action('AppointmentController@destroy', $appointment->id)}}" style="display: none;" method="POST">
                                                @csrf
                                                {{method_field('delete')}}
                                            </form>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <!--  Friday -->
            <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 my-auto">
                                <h5 class="m-0"><i class="mdi mdi-package"></i>Vrijdag</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">Start</th>
                                    <th style="width: 10%;">Einde</th>
                                    <th style="width: 50%;">Met wie</th>
                                    <th style="width: 30%;">Acties</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $appointment)
                                    <?php $i++; ?>
                                    @if($appointment->day == 4)
                                        <tr>
                                            <td>{{$appointment->start}}:00</td>
                                            <td>{{$appointment->end}}:00</td>
                                            <td>{{$appointment->user->name}} - {{$appointment->user->email}}</td>
                                            <td><button form="form{{$i}}" class="btn btn-danger">Annuleer</button></td>
                                            <form id="form{{$i}}" action="{{action('AppointmentController@destroy', $appointment->id)}}" style="display: none;" method="POST">
                                                @csrf
                                                {{method_field('delete')}}
                                            </form>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <!--  Saturday -->
            <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 my-auto">
                                <h5 class="m-0"><i class="mdi mdi-package"></i>Zaterdag</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">Start</th>
                                    <th style="width: 10%;">Einde</th>
                                    <th style="width: 50%;">Met wie</th>
                                    <th style="width: 30%;">Acties</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $appointment)
                                    <?php $i++; ?>
                                    @if($appointment->day == 5)
                                        <tr>
                                            <td>{{$appointment->start}}:00</td>
                                            <td>{{$appointment->end}}:00</td>
                                            <td>{{$appointment->user->name}} - {{$appointment->user->email}}</td>
                                            <td><button form="form{{$i}}" class="btn btn-danger">Annuleer</button></td>
                                            <form id="form{{$i}}" action="{{action('AppointmentController@destroy', $appointment->id)}}" style="display: none;" method="POST">
                                                @csrf
                                                {{method_field('delete')}}
                                            </form>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <!--  Sunday -->
            <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 my-auto">
                                <h5 class="m-0"><i class="mdi mdi-package"></i>Zondag</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 10%;">Start</th>
                                    <th style="width: 10%;">Einde</th>
                                    <th style="width: 50%;">Met wie</th>
                                    <th style="width: 30%;">Acties</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($appointments as $appointment)
                                    <?php $i++; ?>
                                    @if($appointment->day == 6)
                                        <tr>
                                            <td>{{$appointment->start}}:00</td>
                                            <td>{{$appointment->end}}:00</td>
                                            <td>{{$appointment->user->name}} - {{$appointment->user->email}}</td>
                                            <td><button form="form{{$i}}" class="btn btn-danger">Annuleer</button></td>
                                            <form id="form{{$i}}" action="{{action('AppointmentController@destroy', $appointment->id)}}" style="display: none;" method="POST">
                                                @csrf
                                                {{method_field('delete')}}
                                            </form>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </section>
@endsection