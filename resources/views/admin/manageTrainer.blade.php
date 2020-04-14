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
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="m-b-0">
                        Trainer: {{$trainer->user->name}}
                    </h5>
                </div>
                <div class="card-body ">
                    <form class="flex flex-between" action="{{action('TrainerController@update', $trainer->id)}}" method="post">
                        @csrf
                        {{method_field('put')}}
                        <div class="form-group flex flex-between">
                            <label for="firstname">Age: </label>
                            <input class="form-control" name="age" type="text" value="{{$trainer->age}}">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="firstname">EXP: </label>
                            <input class="form-control" name="experience" type="text" value="{{$trainer->experience}}">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="firstname">L-Workout: </label>
                            <input class="form-control" name="least" type="text" value="{{$trainer->least}}">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="firstname">M-Workout: </label>
                            <input class="form-control" name="most" type="text" value="{{$trainer->most}}">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="firstname">F-Snack: </label>
                            <input class="form-control" name="snack" type="text" value="{{$trainer->snack}}">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="firstname">Edu: </label>
                            <input class="form-control" name="education" type="text" value="{{$trainer->education}}">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="firstname">My Story: </label>
                            <textarea class="form-control" name="my_story" id="" cols="60" rows="8">{{$trainer->my_story}}</textarea>
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="firstname">Special: </label>
                            <textarea class="form-control" name="specialisation" id="" cols="60" rows="8">{{$trainer->specialisation}}</textarea>
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="firstname">Important: </label>
                            <textarea class="form-control" name="most_important" id="" cols="60" rows="8">{{$trainer->most_important}}</textarea>
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="firstname">My Quote: </label>
                            <textarea class="form-control" name="my_quote" id="" cols="60" rows="8">{{$trainer->my_quote}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Maandag: </label>
                            <br>
                            <input type="number" value="{{$trainer->monday_start}}" id="firstname" name="monday_start" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->monday_end}}" id="firstname" name="monday_end"  style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->mon_start_block}}" id="firstname" name="mon_start_block" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->mon_time}}" id="firstname" name="mon_time">
                        </div>
                        <div class="form-group">
                            <label for="">Dinsdag: </label>
                            <br>
                            <input type="number" value="{{$trainer->tuesday_start}}" id="firstname" name="tuesday_start" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->tuesday_end}}" id="firstname" name="tuesday_end"  style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->tue_start_block}}" id="firstname" name="tue_start_block" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->tue_time}}" id="firstname" name="tue_time">
                        </div>
                        <div class="form-group">
                            <label for="">Woensdag: </label>
                            <br>
                            <input type="number" value="{{$trainer->wensday_start}}" id="firstname" name="wensday_start" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->wensday_end}}" id="firstname" name="wensday_end"  style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->wen_start_block}}" id="firstname" name="wen_start_block" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->wen_time}}" id="firstname" name="wen_time">
                        </div>
                        <div class="form-group">
                            <label for="">Donderdag: </label>
                            <br>
                            <input type="number" value="{{$trainer->thursday_start}}" id="firstname" name="thursday_start" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->thursday_end}}" id="firstname" name="thursday_end"  style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->thu_start_block}}" id="firstname" name="thu_start_block" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->thu_time}}" id="firstname" name="thu_time">
                        </div>
                        <div class="form-group">
                            <label for="">Vrijdag: </label>
                            <br>
                            <input type="number" value="{{$trainer->friday_start}}" id="firstname" name="friday_start" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->friday_end}}" id="firstname" name="friday_end"  style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->fri_start_block}}" id="firstname" name="fri_start_block" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->fri_time}}" id="firstname" name="fri_time">
                        </div>
                        <div class="form-group">
                            <label for="">Zaterdag: </label>
                            <br>
                            <input type="number" value="{{$trainer->saturday_start}}" id="firstname" name="saturday_start" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->saturday_end}}" id="firstname" name="saturday_end"  style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->sat_start_block}}" id="firstname" name="sat_start_block" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->sat_time}}" id="firstname" name="sat_time">
                        </div>
                        <div class="form-group">
                            <label for="">Zondag: </label>
                            <br>
                            <input type="number" value="{{$trainer->sunday_start}}" id="firstname" name="sunday_start" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->sunday_end}}" id="firstname" name="sunday_end"  style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->sun_start_block}}" id="firstname" name="sun_start_block" style="margin-bottom: 5px;">
                            <input type="number" value="{{$trainer->sun_time}}" id="firstname" name="sun_time">
                        </div>
                        <input  type="submit" value="Save" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection