<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;

class TransactionController extends Controller
{
    //

    public function payment(Request $request)
    {

        $transaction = Transaction::with(['detail', "transaction_buyer"])->where("id", $request->id)->first();


        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;


        $shipping_address = array(
            'address'       => $transaction->transaction_buyer->province,
            'city'          => $transaction->transaction_buyer->city,
        );

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaction->id,
                'gross_amount' => ($transaction->total_biaya_product + $transaction->biaya_pengiriman)
            ),
            'customer_details' => array(
                'first_name'    => $transaction->transaction_buyer->first_name,
                'last_name'     => $transaction->transaction_buyer->last_name,
                'email'         => $transaction->transaction_buyer->email,
                'shipping_address' => $shipping_address
            )
        );

        $snap_token = \Midtrans\Snap::getSnapToken($params);
        return new ResponseResource(200, "Successfully get", $snap_token);
    }

    public function store(Request $request)
    {


        $transaction = Transaction::create([
            "status" => "PENDING",
            "cart_id" => $request->cart_id
        ]);


        return new ResponseResource(200, "Succesfullly add Transaction", $transaction);
    }

    public function get(Request $request)
    {

        $transaction = Transaction::with('detail', 'detail.product', 'transaction_buyer')->where('user_id', Auth::user()->id)->get();



        return new ResponseResource(200, "Succesfullly add Transaction", $transaction);
    }


    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $transaction = Transaction::find($request->order_id);
                $transaction->update(['status' => "PAID"]);
            }
        }
    }
}
