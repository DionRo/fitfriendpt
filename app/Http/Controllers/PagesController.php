<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\URL;


class PagesController extends Controller
{

    public function index(){

        $trainers = \App\Trainer::all();
        return view('welcome')
            ->with('trainers' , $trainers);
    }

    public function contact(){
        return view('contact');
    }

    public function showTrainer($id){
        $trainer = \App\Trainer::find($id);

        return view('trainerDetail')
            ->with('trainer' , $trainer);
    }

    public function sendEmail(Request $request){

        $request->validate([
            'fullname' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $to = "info@fitfriendpt.nl";
        $subject = $request->subject;
        $txt = "Beste Odin,
        U heeft zojuist een bericht ontvangen via het contact formulier op uw website.

        Het bericht is verstuurd door $request->name met het mailadres: $request->email
        
        Het bericht bevat de volgende boodschap:
        '$request->message'";


        $headers = "FROM: ". $request->email;

        mail($to,$subject,$txt,$headers);

        return back();
    }

    public function success(){
        return view('success');
    }
}
