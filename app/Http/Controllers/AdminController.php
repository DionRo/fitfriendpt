<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use NumberFormatter;
use PDF;




class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index']);
    }

    public function index()
    {
        // Admin
        $amountUsers = \App\User::All()->count();
        $amountNotes = \App\Note::all()->count();
        $usersLow = \App\Card::where("amount" , "<" , 4)->get();
        $notes = \App\Note::orderBy('created_at', 'asc')->take(5)->get();


        $whole = Carbon::now();
        $pCarbon = Carbon::parse($whole);

        $year = $pCarbon->year;
        $week = $pCarbon->weekOfYear;

        $yearStepOne = 0;
        $yearStepTwo = 0;
        $yearStepThree = 0;
        $firstStep = 0;
        $secondStep = 0;
        $thirdStep = 0;

        if ($week - 1 == 0){
            $firstStep = 52;
            $yearStepOne = $year - 1;
        }else{
            $firstStep = $week - 1;
            $yearStepOne = $year;
        }

        if ($week - 2 <= 0){
            if ($week - 2 == -1){
                $secondStep = 51;
                $yearStepTwo = $year - 1;
            }else{
                $secondStep = 52;
                $yearStepTwo = $year - 1;
            }
        }else{
            $secondStep = $week - 2;
            $yearStepTwo = $year;
        }

        if ($week - 3 <= 0){
            if ($week - 3 == -2){
                $thirdStep = 50;
                $yearStepThree = $year - 1;
            }
            elseif ($week - 2 == -1){
                $thirdStep = 51;
                $yearStepThree = $year - 1;
            }else{
                $thirdStep = 52;
                $yearStepThree = $year - 1;
            }
        }
        else{
            $thirdStep = $week - 3;
            $yearStepThree = $year;
        }

        $users = \App\User::where('state', "=", 1)->get();

        $noAppointments = [];
        foreach ($users as $user) {
            $appointmentsOne = \App\Appointment::where([["year" , "=" , $yearStepOne],["week" , "=" , $firstStep], ["user_id" , "=" , $user->id]])->first();

            if ($appointmentsOne == null){
                $appointmentsTwo = \App\Appointment::where([["year" , "=" , $yearStepTwo],["week" , "=" , $secondStep], ["user_id" , "=" , $user->id]])->first();

                if ($appointmentsTwo == null){
                    $appointmentsThee = \App\Appointment::where([["year" , "=" , $yearStepThree],["week" , "=" , $thirdStep], ["user_id" , "=" , $user->id]])->first();

                    if ($appointmentsThee == null){
                        if ($user->id != 2 && $user->id != 3 && $user->id != 28){
                            array_push($noAppointments, $user);
                        }
                    }
                }
            }
        }

        //Users
        $appointments = \App\Appointment::where([["user_id" , "=" , Auth::user()->id],["date" , ">=" , Carbon::now()->format("Y-m-d 00:00:00")]])
            ->orderBy('date' , 'ASC')
            ->orderBy('start' , 'ASC')
            ->get();
        $trainers = \App\Trainer::all();
        $card = \App\Card::where("user_id" , "=" , Auth::user()->id)->first();
        $stats = \App\Stat::where("user_id" , "=" , Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        return view('admin/home')
            ->with('amountUsers', $amountUsers)
            ->with('amountNotes' , $amountNotes)
            ->with('notes', $notes)
            ->with('users' , $usersLow)
            ->with('appointments' , $appointments)
            ->with('trainers' , $trainers)
            ->with('card' , $card)
            ->with('stats', $stats)
            ->with('noAppointments', $noAppointments);
    }

    // Agenda Handlers
    public function agenda(){
        $whole = Carbon::now();
        $now = $whole->weekOfYear;
        $nowyear = $whole->year;

        if (Auth::user()->userLevel != 3) {
            $trainer = \App\Trainer::where("user_id", "=", Auth::user()->id)->first();
            $appointments = \App\Appointment::where([["week", "=", $now], ["trainer_id", "=", $trainer->id], ["year", "=", $nowyear]])->orderBy('start' , 'ASC')->get();
        }else{
            $appointments = \App\Appointment::where([["week", "=", $now], ["trainer_id", "=", 1], ["year", "=", $nowyear]])->get();
        }

        $trainers = \App\Trainer::all();
        $searchedTrainer = NULL;

        return view('admin/agenda')
            ->with('appointments' , $appointments)
            ->with('now', $now)
            ->with('nowYear', $nowyear)
            ->with('trainers' , $trainers)
            ->with('searchedTrainer' , $searchedTrainer);
    }

    public function agendaSearch(Request $request){
        $now = $request->weekNr;
        $nowyear = $request->year;

        $notes = \App\Note::all();
        $appointments = \App\Appointment::where([["week" , "=" , $now],["trainer_id" , "=", $request->trainer], ["year", "=" , $nowyear]])->orderBy('start' , 'ASC')->get();
        $trainers = \App\Trainer::all();
        $searchedTrainerO = \App\Trainer::find($request->trainer);
        $searchedTrainer = $searchedTrainerO->user_id;

        return view('admin/agenda')
            ->with('appointments' , $appointments)
            ->with('now', $now)
            ->with('nowYear',$nowyear)
            ->with('notes' , $notes)
            ->with('trainers' , $trainers)
            ->with('searchedTrainer' , $searchedTrainer);
    }

    public function allOrders(){
        $orders = \App\Order::all();

        $moneyFormat = new NumberFormatter( 'nl_NL', NumberFormatter::CURRENCY );
        return view('admin/allOrders', ['orders' => $orders, 'moneyFormat' => $moneyFormat]);
    }

    // Payment Functions
    public function payments(){
        $products = \App\Product::all();
        $users  = \App\User::all();

        $fetchAllPayment = \App\Payment::where("state", "=" , 0)->get();

        return view('admin/createPayments')
            ->with("products",$products)
            ->with("users", $users)
            ->with("payments" , $fetchAllPayment);
    }

    public function storePayment(Request $request){
        $payment = new \App\Payment();
        $payment->user_id = $request->user;
        $payment->product_id = $request->product;
        $payment->state = 0;
        $payment->save();

        return redirect()->back()->with('successC', 'Payment is toegevoegd');
    }

    public function deletePayment($id){
        if (Auth::user()->userLevel >= 2){
            $payment = \App\Payment::where("id" , "=" , $id)->first();
            $payment->delete();
            return redirect()->back()->with('success', 'Payment is verwijderd');
        }else{
            return redirect()->back()->with('error', 'Payment verwijderen is mislukt');
        }
    }

    public function showPDF($id){
        $order = \App\Order::find($id);
        if ($order == null){
            return back();
        }

        $moneyFormat = new NumberFormatter( 'nl_NL', NumberFormatter::CURRENCY );
        $pdf = PDF::loadView('admin/invoice' , ['order' => $order, 'moneyFormat' => $moneyFormat]);

        return $pdf->stream('result.pdf', array('Attachment' => 0));
    }
}
