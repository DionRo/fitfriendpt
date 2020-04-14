@extends('layouts.admin')

@section('content')
    <script src="{{URL::asset("assets/admin/vendor-ex/jquery/jquery.min.js")}}"></script>
    <section class="admin-content ">
        <div class="container-fluid bg-dark m-b-30">
            <div class="row">

                <div class="col-lg-6 my-auto text-white p-t-20 ">

                    <h4 class=""><span class="js-greeting"></span> {{Auth::user()->name}}!</h4>
                    <p class="opacity-75 ">
                        did you know that, “Your body can stand almost anything. It’s your mind that you have to convince.”,F<br>
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
                        Gebruiker: {{$user->name}}
                    </h5>
                </div>
                <div class="card-body ">
                    <form action="{{action('UserController@update', $user->id)}}" method="post">
                        @csrf
                        {{method_field('put')}}
                        <div class="form-group flex flex-between">
                            <label for="firstname">Naam: </label>
                            <input class="form-control" type="text" value="{{$user->name}}" id="firstname" name="name">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="firstname">Email: </label>
                            <input class="form-control"  type="text" value="{{$user->email}}" id="firstname" name="email">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="firstname">Lessen: </label>
                            <input class="form-control"  type="text" value="{{$user->card->amount}}" id="firstname" name="amount">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="address">Adres: </label>
                            <input class="form-control"  type="text" value="{{$user->address}}" id="address" name="address">

                            <label for="postalcode">Postcode: </label>
                            <input class="form-control"  type="text" value="{{$user->postalcode}}" id="postalcode" name="postalcode">
                        </div>
                        <div class="form-group flex  flex-between">
                            <label for="fitfriend">is Actief: </label>
                            <select class="form-control"  name="state" id="userLevel">
                                <option @if($user->state == 0) selected="selected" @endif value="0">Nee</option>
                                <option @if($user->state == 1) selected="selected" @endif value="1">Ja</option>
                            </select>
                        </div>
                        <div class="form-group flex  flex-between">
                            <label for="userLevel">Type U: </label>
                            <select class="form-control"  name="userLevel" id="userLevel">
                                <option @if($user->userLevel == 0) selected="selected" @endif value="0">Klant</option>
                                <option @if($user->userLevel == 1) selected="selected" @endif value="1">Trainer</option>
                                <option @if($user->userLevel == 2) selected="selected" @endif value="2">Eigenaar</option>
                                <option @if($user->userLevel == 3) selected="selected" @endif value="3">Super Admin</option>
                            </select>
                        </div>
                        <h6>LEEG LATEN ALS JE GEEN NOTITIE WILT INVULLEN</h6>
                        <div class="form-group flex flex-column">
                            <label for="note">My note: </label>
                            <textarea class="form-control" name="note" id="" cols="30" rows="10"></textarea>
                        </div>
                        @if($user->userLevel == 1)
                            <h3 style="color: white;">ALLEEN INVULLEN ALS JE ER EEN TRAINER VAN MAAKT/IS</h3>
                            <div class="form-group flex flex-between">
                                <label for="firstname">Age: </label>
                                <input class="form-control"  name="age" type="text" value="{{$user->trainer->age}}">
                            </div>
                            <div class="form-group flex flex-between">
                                <label for="firstname">EXP: </label>
                                <input class="form-control"  name="experience" type="text" value="{{$user->trainer->experience}}">
                            </div>
                            <div class="form-group flex flex-between">
                                <label for="firstname">L-Workout: </label>
                                <input class="form-control"  name="least" type="text" value="{{$user->trainer->least}}">
                            </div>
                            <div class="form-group flex flex-between">
                                <label for="firstname">F-Workout: </label>
                                <input class="form-control"  name="most" type="text" value="{{$user->trainer->most}}">
                            </div>
                            <div class="form-group flex flex-between">
                                <label for="firstname">F-Snack: </label>
                                <input class="form-control"  name="snack" type="text" value="{{$user->trainer->snack}}">
                            </div>
                            <div class="form-group flex flex-between">
                                <label for="firstname">Edu: </label>
                                <input class="form-control" name="education" type="text" value="{{$user->trainer->education}}">
                            </div>
                            <div class="form-group flex flex-column">
                                <label for="firstname">My Story: </label>
                                <textarea class="form-control" name="mystory" id="" cols="30" rows="10">{{$user->trainer->my_story}}</textarea>
                            </div>
                            <div class="form-group flex flex-column">
                                <label for="firstname">Specialisation: </label>
                                <textarea class="form-control" name="specialisation" id="" cols="30" rows="10">{{$user->trainer->specialisation}}</textarea>
                            </div>
                            <div class="form-group flex flex-column">
                                <label for="firstname">Important: </label>
                                <textarea class="form-control" name="mostimportant" id="" cols="30" rows="10">{{$user->trainer->most_important}}</textarea>
                            </div>
                            <div class="form-group flex flex-column">
                                <label for="firstname">My Quote: </label>
                                <textarea class="form-control" name="myquote" id="" cols="30" rows="10">{{$user->trainer->my_quote}}</textarea>
                            </div>
                            @if($user->trainer->trainer_image == null)
                                <div class="form-group flex flex-between upload">
                                    <label for="image">Upload Foto</label>
                                    <input class="form-control" type="file" name="trainer_image" id="image" required>
                                </div>
                            @endif
                        @endif
                        <input type="submit" value="Save" class="btn btn-primary" style="margin-bottom: 10px;">
                    </form>
                    <form action="{{action('UserController@destroy', $user->id)}}" method="post">
                        @csrf
                        {{method_field('delete')}}
                        <input type="submit" value="Verwijder" class="btn btn-danger">
                    </form>
                </div>
            </div>

            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="m-b-0">
                        Gebruiker Notities: {{$user->name}}
                    </h5>
                </div>
                <div class="card-body ">
                    @foreach($notes as $note)
                        <div class="">
                            <p style="font-size: 15px;">{{$note->note}}</p>
                            <form action="{{action('UserController@deleteNoteUser' , $note->id)}}" method="POST">
                                @csrf
                                {{method_field('delete')}}
                                <input type="hidden" value="{{$user->id}}">
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>

            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="m-b-0">
                        Gebruiker Metingen : {{$user->name}}
                    </h5>
                </div>
                <div class="card-body ">
                    <form action="{{action('UserController@addStats', $user->id)}}" method="post">
                        @csrf
                        <div class="form-group flex flex-between">
                            <label for="fat">Vet %: </label>
                            <input class="form-control" type="number" id="fat" name="fat" step=".01">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="muscle">Spiermassa: </label>
                            <input class="form-control"  type="number" id="muscle" name="muscle" step=".01">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="bmi">BMI: </label>
                            <input class="form-control"  type="number"  id="bmi" name="bmi" step=".01">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="blood">bloeddruk: </label>
                            <input class="form-control"  type="text"  id="blood" name="blood">
                        </div>
                        <div class="form-group flex flex-between">
                            <label for="weight">Gewicht: </label>
                            <input class="form-control"  type="number"  id="weight" name="weight" step=".01">
                        </div>
                        <input type="submit" value="Save" class="btn btn-primary" style="margin-bottom: 10px;">
                    </form>
                </div>
            </div>
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="m-b-0">
                        Gebruiker Stats: {{$user->name}}
                    </h5>
                </div>
                <div class="card-body ">
                    @foreach($stats as $stat)
                        <div class="">
                            <p style="font-size: 15px;">vet%: {{$stat->fatmass}} | spiermassa: {{$stat->musclemass}} | BMI: {{$stat->bmi}} | Blooddruk: {{$stat->bloodpressure}}
                                    | Gewicht {{$stat->weight}} | Toegevoegd op: {{$stat->created_at}}</p>
                            <form action="{{action('UserController@deleteStat' , $stat->id)}}" method="POST">
                                @csrf
                                {{method_field('delete')}}
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection