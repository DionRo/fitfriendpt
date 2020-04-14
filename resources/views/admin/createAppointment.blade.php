@extends('layouts.admin')

@section('content')
    <script src="{{URL::asset("assets/admin/vendor-ex/jquery/jquery.min.js")}}"></script>
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
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="m-b-0">
                    Plan een afspraak
                    </h5>
                </div>
                <div class="card-body ">
                    <form action="{{action('AppointmentController@appointmentAvail')}}" class="flex flex-column"  method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Selecteer Trainer</label>
                            <select class="form-control" name="trainer" id="">
                                @foreach($trainers as $trainer)
                                    <option value="{{$trainer->id}}">{{$trainer->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kies Datum</label>
                            <input class="form-control" name="time" type="date" id="txtDate" required>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Check" class="save">
                        </div>
                    </form>
                    <script>
                        $(function(){
                            var dtToday = new Date();

                            var month = dtToday.getMonth() + 1;
                            var day = dtToday.getDate();
                            var year = dtToday.getFullYear();

                            if(month < 10)
                                month = '0' + month.toString();
                            if(month == 12)
                                month = '01';
                            year = year +1;
                            if(day < 10)
                                day = '0' + day.toString();

                            var maxDate = year + '-' + month + '-' + day;
                            $('#txtDate').attr('max', maxDate);
                        });
                    </script>
                </div>
            </div>
            @if($results != null)
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                            Kies een tijd
                        </h5>
                    </div>
                    <div class="card-body ">
                        <form action="{{action('AppointmentController@store')}}" class="flex flex-column"  method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Gekozen trainer</label>
                                <input class="form-control" type="text" value="{{$trainerR->user->name}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Kies Tijdstip voor {{$time}} </label>
                                <select class="form-control" name="date" id="">
                                    @foreach($results as $result)
                                        <?php $resultFloat = $result; ?>
                                        <option value="{{$result}}">
                                            <?php
                                            $resultShowString = strval($resultFloat);
                                            if(strpos($resultShowString, ".25") !== false){
                                                $resultFinal = str_replace(".25", ":15", $resultShowString);
                                                echo $resultFinal;
                                            }
                                            elseif(strpos($resultFloat, ".5") !== false){
                                                $resultFinal = str_replace(".5", ":30", $resultShowString);
                                                echo $resultFinal;
                                            }
                                            elseif(strpos($resultFloat, ".75") !== false){
                                                $resultFinal = str_replace(".75", ":45", $resultShowString);
                                                echo $resultFinal;
                                            }
                                            else{
                                                echo $resultShowString . ":00";
                                            }
                                            ?>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                @if(Auth::user()->userLevel > 0)
                                    <label for="">Kies User</label>
                                    <select class="form-control" name="user">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" >{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <input name="trainerid" type="hidden" value="{{$trainerR->id}}">
                            <input name="day" type="hidden" value="{{$day}}">
                            <input name="dayType" type="hidden" value="{{$dayType}}">
                            <input name="week" type="hidden" value="{{$week}}">
                            <input name="year" type="hidden" value="{{$year}}">
                            <input name="time" type="hidden" value="{{$time}}">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Maak Afspraak">
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection