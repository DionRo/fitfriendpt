<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\Mail;
use NumberFormatter;
use PDF;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['store' , 'update']);
//        $this->middleware('admin')->except(['index', 'handle']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = \App\Payment::where("user_id", "=", Auth::user()->id)->get();
        $orders = \App\Order::where("user_id", "=", Auth::user()->id)->get();

        $moneyFormat = new NumberFormatter( 'nl_NL', NumberFormatter::CURRENCY );

        return view('admin/myOrders')
            ->with('payments' , $payments)
            ->with('orders', $orders)
            ->with('moneyFormat', $moneyFormat);
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
        if (!$request->has('id')) {
            return;
        }

        $payment = Mollie::api()->payments()->get($request->id);
        usleep(10000000);
        if($payment->isPaid()){
            $metadata = json_decode($payment->metadata);

            $order = new \App\Order();
            $order->product_id = $metadata[1];
            $order->user_id = $metadata[0];
            $order->payment_id = $request->id;
            $order->save();

            $getPayment =  \App\Payment::find($metadata[2]);
            $getPayment->delete();

            $product = \App\Product::find($metadata[1]);
            $card = \App\Card::where("user_id" , "=", $metadata[0])->first();
            $card->amount = $card->amount + $product->amount_of_lessons;
            $card->update();

            return view('success');
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
        $order = \App\Order::where([["user_id", "=", Auth::user()->id],["id" , "=" , $id]])->first();
        if ($order == null){
            return back();
        }

        $moneyFormat = new NumberFormatter( 'nl_NL', NumberFormatter::CURRENCY );
        $pdf = PDF::loadView('admin/invoice' , ['order' => $order, 'moneyFormat' => $moneyFormat]);

        return $pdf->stream('result.pdf', array('Attachment' => 0));
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
        $getPayment = \App\Payment::find($id);
        $product = \App\Product::find($getPayment->product_id);

        if ($product == null){
            return redirect()->action('PagesController@index');
        }

        $priceIncludingTax = $product->price * 1.09;
        $price = number_format($priceIncludingTax, 2);

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => $price,
            ],
            'description' => $product->name,
            'webhookUrl' => route('webhook.orders'),
            "redirectUrl" => route("success"),
            "metadata" =>  json_encode([Auth::user()->id , $product->id,$getPayment->id]),
        ]);

        return redirect($payment->getCheckoutUrl(), 303);
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
