<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['handle']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainers = \App\Trainer::all();
        $users = \App\User::all();
        $results = null;
        $error = null;
        return view('admin/createAppointment')
            ->with('trainers', $trainers)
            ->with('results', $results)
            ->with('error' , $error)
            ->with('users', $users);
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

    public function appointmentAvail(Request $request){
        $payments = \App\Payment::where("user_id", "=" , Auth::user()->id)->first();

        if ($payments != null){
            return redirect('dashboard/appointment')->with('statusE', 'U heeft nog een openstaande betaling staan! Deze moet eerst voldaan worden');
        }


        $whole = Carbon::now();
        $pCarbon = Carbon::parse($request->time);
        $dateString = $whole->toDateString();
        $pCarbonp = $pCarbon->toDateString();

        $compareResult = $whole->lessThanOrEqualTo($pCarbon);
        $requestDay = $pCarbon->dayOfYear;
        $requestYear = $pCarbon->year;

        if ($compareResult || $dateString == $pCarbonp){
            if($pCarbon->isSunday() && Auth::user()->userLevel == 0){
                return redirect('dashboard/appointment')->with('statusE', 'Afspraken kunnen niet op zondag geplanned worden!');
            }

            $availTimes = [];
            $takenTimes = [];
            $trainer = \App\Trainer::find($request->trainer);

            if ($trainer != null) {

                if ($pCarbon->isMonday()){
                    $i = $trainer->monday_start;
                    $b = $trainer->monday_end;
                    $c = $trainer->mon_start_block;
                    $d = $trainer->mon_time;
                    $monthD = 0;
                } elseif ($pCarbon->isTuesday()) {
                    $i = $trainer->tuesday_start;
                    $b = $trainer->tuesday_end;
                    $c = $trainer->tue_start_block;
                    $d = $trainer->tue_time;
                    $monthD = 1;
                } elseif ($pCarbon->isWednesday()) {
                    $i = $trainer->wensday_start;
                    $b = $trainer->wensday_end;
                    $c = $trainer->wen_start_block;
                    $d = $trainer->wen_time;
                    $monthD = 2;
                } elseif ($pCarbon->isThursday()) {
                    $i = $trainer->thursday_start;
                    $b = $trainer->thursday_end;
                    $c = $trainer->thu_start_block;
                    $d = $trainer->thu_time;
                    $monthD = 3;
                } elseif ($pCarbon->isFriday()) {
                    $i = $trainer->friday_start;
                    $b = $trainer->friday_end;
                    $c = $trainer->fri_start_block;
                    $d = $trainer->fri_time;
                    $monthD = 4;
                } elseif ($pCarbon->isSaturday()) {
                    $i = $trainer->saturday_start;
                    $b = $trainer->saturday_end;
                    $c = $trainer->sat_start_block;
                    $d = $trainer->sat_time;
                    $monthD = 5;
                }elseif ($pCarbon->isSunday()) {
                    $i = $trainer->sunday_start;
                    $b = $trainer->sunday_end;
                    $c = $trainer->sun_start_block;
                    $d = $trainer->sun_time;
                    $monthD = 6;
                }

                if ($trainer->id != 4) {
                    $q = 0;
                    for ($i; $i <= $b; $i++) {
                        if ($i != $c){
                            array_push($availTimes, $i);
                        }else{
                            $q++;
                            if ($q <= $d){
                                $c++;
                            }
                        }
                    }
                }else{
                    for ($i; $i <= $b; $i+=0.25) {
                        array_push($availTimes, $i);
                    }
                }
            }
            $appointments = \App\Appointment::where([["day_of_year" , "=" , $requestDay],["year" , "=" , $requestYear],["trainer_id" , "=" , $request->trainer]])->get();

            foreach ($appointments as $appointment) {
                array_push($takenTimes, $appointment->start);
            }

            $results = array_diff($availTimes, $takenTimes);

            $error = null;

            if($results == null){
                $error = "Deze dag is helaas helemaal vol geplanned (voor deze trainer)";
            }

            $trainers = \App\Trainer::all();
            $users = \App\User::all();
            $time = $pCarbon->format("D d M Y");
            $year = $pCarbon->year;
            $week = $pCarbon->weekOfYear;

            return view('admin/createAppointment')
                ->with('trainers', $trainers)
                ->with('trainerR' , $trainer)
                ->with('day' , $requestDay)
                ->with('dayType' , $monthD)
                ->with('week' , $week)
                ->with('year' , $year)
                ->with('time', $time)
                ->with('results', $results)
                ->with('error' , $error)
                ->with('users' , $users);
        }else{
            return redirect('dashboard/appointment')->with('statusE', 'De afspraak moet in de toekomst zijn');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->date == null){
            return redirect('dashboard/appointment')->with('statusE', 'Afspraak tijd klopt niet!');
        }

        if($request->trainerid == 4 && Auth::user()->userLevel == 0 && Auth::user()->is_fitfriend == 1){
            return redirect('dashboard/appointment')->with('statusE', 'Alleen trainers en Gymnasium leden kunnen de zaal plannen');
        }

        $date = Carbon::parse($request->time);
        $end = intval($request->date);
        $end++;

        $appointment = new \App\Appointment();

        if (Auth::user()->userLevel > 0){
            $appointment->user_id = $request->user;
        }else {
            $appointment->user_id = Auth::user()->id;

            $card = \App\Card::where("user_id" , "=" , Auth::user()->id)->first();
            if ($card->amount == 0){
                return redirect('dashboard/appointment')->with('statusE', 'Uw rittenkaart is op!');
            }

        }
        $appointment->trainer_id = $request->trainerid;
        $appointment->start =  $request->date;
        $appointment->end = $end;
        $appointment->day = $request->dayType;
        $appointment->day_of_year = $request->day;
        $appointment->week = $request->week;
        $appointment->year = $request->year;
        $appointment->date = $date;

        $saved = $appointment->save();

        if(Auth::user()->userLevel > 0){
            $card = \App\Card::where("user_id", "=", $request->user)->first();
        }else {
            $card = \App\Card::where("user_id", "=", Auth::user()->id)->first();
        }
        $amount = $card->amount;
        $amount--;
        $card->amount = $amount;
        $card->update();

        if($saved){
            return redirect('dashboard/appointment')->with('statusS', 'Afspraak maken gelukt!');
        }else {
            return redirect('dashboard/appointment')->with('statusE', 'Afspraak niet gelukt! Probeer het later nog eens');
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = \App\Appointment::find($id);

        if (Auth::user()->userLevel > 0){
            $appointment->delete();

            $card = \App\Card::where("user_id" , "=" , Auth::user()->id)->first();
            $amount = $card->amount;
            $amount++;
            $card->amount = $amount;
            $card->update();

            return redirect('dashboard/agenda')->with('statusS', 'Afspraak annuleren gelukt!');

        } elseif($appointment->user_id == Auth::user()->id){
            $futureTime = Carbon::tomorrow()->format("Y-m-d h:00:00");
            $appDate  = date($appointment->date);
            $appDateModified = date('Y-m-d H:i:s', strtotime($appDate . " +{$appointment->start} hours "));

            if ($appDateModified >= $futureTime){
                $appointment->delete();
                $card = \App\Card::where("user_id" , "=" , Auth::user()->id)->first();
                $amount = $card->amount;
                $amount++;
                $card->amount = $amount;
                $card->update();
                return redirect('/dashboard')->with('statusS', 'Afspraak annuleren gelukt!');
            }else{
                $appointment->delete();
                return redirect('/dashboard')->with('statusE', 'Afspraak annuleren gelukt! Maar omdat er minder dan 24 uur tussen zat 
                moeten wij helaas een les afschrijven(Hele goede reden? Meld het ons:))');
            }
        }
    }
}
