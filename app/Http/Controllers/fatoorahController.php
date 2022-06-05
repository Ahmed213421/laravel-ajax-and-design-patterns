<?php

namespace App\Http\Controllers;

use App\Http\services\FatoorahServices;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class fatoorahcontroller extends Controller
{
    private $fatoorahServices;




    public function __construct(FatoorahServices $fatoorahServices)
    {
        $this->fatoorahServices = $fatoorahServices;
    }


    public function payOrder(){
        $data = [
            'CustomerName' => 'ibrahimrezk',
            'NotificationOption' => 'Lnk',
            'InvoiceValue' => 100,
            'CustomerEmail' => 'ibrahimrezk@live.com',
            'CallBackUrl' => 'http://127.0.0.1:8000/call_back/',
            'ErrorUrl' => 'https://youtube.com/',
            'Language' =>  'en',
            'DisplayCurrencyIso' => 'KWD',
        ];
        
        $data = $this->fatoorahServices->sendPayment($data);
        $payment = new Invoice();
        $payment->invoice_id = $data['Data']['InvoiceId'];
        $payment->status = 0;
        $payment->user_id = Auth::user()->id;
        $payment->save();


        return redirect($data['Data']['InvoiceURL']);
    }

    public function paymentCallBack(Request $request)
    {
        // return $request;
        // $myfatoorah = MyFatoorah::payment($request->paymentId);
        $data = [];
        $data['Key'] = $request->paymentId;
        $data['KeyType'] = 'paymentId';
        $payment = $this->fatoorahServices->getPaymentStatus($data);
        $payment = Invoice::where('invoice_id',$payment['Data']['InvoiceId'])->first();
        $payment->status = 1;
        $payment->save();
        
        return redirect()->route('invoices.index');
    }
}

