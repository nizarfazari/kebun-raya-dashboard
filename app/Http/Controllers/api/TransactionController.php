<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Snap;

class TransactionController extends Controller
{
    //

    public function payment(Request $request)
    {

        $transaction = Transaction::with(['detail', 'detail.product', "transaction_buyer"])->where("id", $request->id)->first();
        

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;




        $item_details = array();

        foreach ($transaction->detail as $value) {
            $item_details[] = array(
                'id' => $value->product->id,
                'price' => $value->product->harga,
                'quantity' => $value->qty,
                'name' => $value->product->name
            );
        }

        $transaction_details = array(
            'order_id' => Str::uuid(),
            'gross_amount' => ($transaction->total_biaya_product + $transaction->biaya_pengiriman)
        );

        $customer_details = array(
            'first_name'    => $transaction->transaction_buyer->first_name,
            'last_name'     => $transaction->transaction_buyer->last_name,
            'email'         => $transaction->transaction_buyer->email,
            'phone' => "08123456789",
        );

        $transactionR = array(
            'transaction_details' => $transaction_details,
            'item_details' => $item_details, // Masukkan item_details yang sudah diisi
            'customer_details' => $customer_details,
        );

        $transaction->update(['order_id_midtrans' => $transaction_details['order_id']]);

        $snap_token = \Midtrans\Snap::getSnapToken($transactionR);
        return new ResponseResource(200, "Successfully get", $snap_token);
    }

    public function store(Request $request)
    {


        $transaction = Transaction::create([
            "status" => "pending",
            "cart_id" => $request->cart_id
        ]);


        return new ResponseResource(200, "Succesfullly add Transaction", $transaction);
    }

    public function get(Request $request)
    {

        $status = $request->query('status') ?? "pending";
        $transaction = Transaction::with('detail', 'detail.product', 'transaction_buyer')
            ->where('user_id', Auth::user()->id)
            ->where('status', $status)
            ->get();

        return new ResponseResource(200, "Succesfullly add Transaction", $transaction);
    }


    public function getByStatus(Request $request)
    {
        $status = $request->query('status');

        $transaction = Transaction::with('detail', 'detail.product', 'transaction_buyer')
            ->where('user_id', Auth::user()->id)
            ->where('status', $status)
            ->get();




        return new ResponseResource(200, "Succesfullly add Transaction", $transaction);
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $transaction = Transaction::find($request->order_id);
                $transaction->update(['status' => "paid"]);
            }
        }
    }

    public function callbackSuccess(Request $request)
    {
        $transaction = Transaction::where('order_id_midtrans', $request->order_id);
        $transaction->update(['status' => 'SUDAH-DIBAYAR']);
    }


    public function confirmation_status(Request $request)
    {
        $transaction = Transaction::where('order_id_midtrans', $request->order_id);
        $transaction->update(['status' => 'DIKIRIM']);

        return redirect()->route('order.index');
    
    }
    public function accepted_status(Request $request)
    {
        $transaction = Transaction::where('order_id_midtrans', $request->order_id);
        $transaction->update(['status' => 'DITERIMA']);

        
    }
}
