<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TrainerController extends Controller
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
        if (Auth::user()->userLevel >= 2) {
            $trainers = \App\Trainer::paginate(9);

            return view('admin/trainers')
                ->with('trainers', $trainers);
        }else{
            $trainers  = \App\Trainer::where("user_id" , "=" ,Auth::user()->id)->paginate(8);

            return view('admin/trainers')
                ->with('trainers', $trainers);
        }
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
        $trainer = \App\Trainer::find($id);

        return view('trainerDetail')
            ->with('trainer', $trainer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trainer = \App\Trainer::where("id" , "=" , $id)->first();

        return view('admin/manageTrainer')
            ->with('trainer', $trainer);
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
        $trainer = \App\Trainer::find($id);

        $trainer->my_story = $request->my_story;
        $trainer->specialisation = $request->specialisation;
        $trainer->most_important = $request->most_important;
        $trainer->my_quote =  $request->my_quote;
        $trainer->age = $request->age;
        $trainer->experience = $request->experience;
        $trainer->most = $request->most;
        $trainer->least = $request->least;
        $trainer->snack = $request->snack;
        $trainer->education = $request->education;


        $trainer->monday_start = $request->monday_start;
        $trainer->monday_end = $request->monday_end;
        $trainer->tuesday_start = $request->tuesday_start;
        $trainer->tuesday_end = $request->tuesday_end;
        $trainer->wensday_start = $request->wensday_start;
        $trainer->wensday_end = $request->wensday_end;
        $trainer->thursday_start = $request->thursday_start;
        $trainer->thursday_end = $request->thursday_end;
        $trainer->friday_start = $request->friday_start;
        $trainer->friday_end = $request->friday_end;
        $trainer->saturday_start = $request->saturday_start;
        $trainer->saturday_end = $request->saturday_end;
        $trainer->sunday_start = $request->sunday_start;
        $trainer->sunday_end = $request->sunday_end;

        $trainer->mon_start_block = $request->mon_start_block;
        $trainer->mon_time = $request->mon_time;
        $trainer->tue_start_block = $request->tue_start_block;
        $trainer->tue_time = $request->tue_time;
        $trainer->wen_start_block = $request->wen_start_block;
        $trainer->wen_time = $request->wen_time;
        $trainer->thu_start_block = $request->thu_start_block;
        $trainer->thu_time = $request->thu_time;
        $trainer->fri_start_block = $request->fri_start_block;
        $trainer->fri_time = $request->fri_time;
        $trainer->sat_start_block = $request->sat_start_block;
        $trainer->sat_time = $request->sat_time;
        $trainer->sun_start_block = $request->sun_start_block;
        $trainer->sun_time = $request->sun_time;

        $trainer->update();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
