<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::all();

        return view('admin/users')
            ->with('users' , $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::find($id);
        $notes = \App\Note::where("user_id" , "=", $id)->get();
        $stats = \App\Stat::where("user_id" , "=", $id)->get();

        return view('admin/manageUser')
            ->with('user', $user)
            ->with('notes', $notes)
            ->with('stats' , $stats);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user =  \App\User::find($id);

        if($user != null) {

            // Update the user
            $user->email = $request->email;
            $user->name = $request->name;
            $user->state =  $request->state;
            $user->address = $request->address;
            $user->postalcode = $request->postalcode;
            if ($request->userLevel == 0) {
                $user->rank = "Klant";
            } elseif ($request->userLevel == 1) {
                $user->rank = "Trainer";
                $searchTrainer = \App\Trainer::where("user_id" , "=" , $id)->first();

                if ($searchTrainer == null) {
                    $trainer = new \App\Trainer;
                    $trainer->user_id = $id;
                    $trainer->my_story = $request->mystory;
                    $trainer->specialisation = $request->specialisation;
                    $trainer->most_important = $request->mostimportant ;
                    $trainer->my_quote = $request->myqoute;
                    $trainer->age = $request->age;
                    $trainer->experience = $request->experience;
                    $trainer->most = $request->most;
                    $trainer->least = $request->least;
                    $trainer->snack = $request->snack;
                    $trainer->education = $request->education;
                    $trainer->trainer_image = "";
                    $trainer->save();
                }
                else{
                    if ($user->userLevel < 2) {
                        $trainer = \App\Trainer::where("user_id", "=", $id)->first();

                        $trainer->my_story = $request->mystory;
                        $trainer->specialisation = $request->specialisation;
                        $trainer->most_important = $request->mostimportant;
                        $trainer->my_quote = $request->myquote;
                        $trainer->age = $request->age;
                        $trainer->experience = $request->experience;
                        $trainer->most = $request->most;
                        $trainer->least = $request->least;
                        $trainer->snack = $request->snack;
                        $trainer->education = $request->education;

                        $trainer->update();
                    }
                }
            } elseif ($request->userLevel == 2) {
                $user->rank = "Eigenaar";
            } elseif ($request->userLevel == 3) {
                $user->rank = "Super Admin";
            }
            if ($request->note != NULL){
                $note = new \App\Note();

                $note->user_id = $id;
                $note->note = $request->note;
                $note->save();
            }

            $user->userLevel = $request->userLevel;
            $user->update();

            // Update the card
            $card = \App\Card::where("user_id" , "=" , $id)->first();
            if($card != null) {
                $card->amount = $request->amount;
                $card->update();
            }

            return redirect()->action('UserController@index');
        }else{

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::find($id);

        if($user->userLevel == 1){
            $trainer = \App\Trainer::where("user_id", "=" , $id)->first();

            $trainerAppointments = \App\Appointment::where("trainer_id" , "=" , $trainer->id)->get();

            foreach ($trainerAppointments as $trainerAppointment)
            {
                $trainerAppointment->delete();
            }

            $trainer->delete();
        }

        $card = \App\Card::where("user_id", "=" , $id)->first();
        $card->delete();

        $notes = \App\Note::where("user_id" , "=", $id)->get();

        foreach ($notes as $note){
            $note->delete();
        }

        $appointments =  \App\Appointment::where("user_id" , "=" , $id)->get();

        foreach ($appointments as $appointment) {
            $appointment->delete();
        }

        $user->state = 0;

        return redirect()->action('PagesController@allUsers');
    }

    public function addStats(Request $request , $id){
        $stats = new \App\Stat();

        $stats->user_id = $id;
        $stats->fatmass = $request->fat;
        $stats->musclemass = $request->muscle;
        $stats->bmi = $request->bmi;
        $stats->bloodpressure = $request->blood;
        $stats->weight = $request->weight;

        $stats->save();
        return back();
    }

    public function deleteStat($id){
        $stats = \App\Stat::find($id);
        $stats->delete();
        return back();
    }

    public function deleteNoteUser($id){
        $note = \App\Note::find($id);
        $note->delete();

        return back();
    }
}
