<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class OrderController extends Controller
{


    public function index()
    {
        $data = Transaction::with(['detail', 'transaction_buyer'])->get();

        return view('order.index', compact('data'));
    }
    public function create()
    {

        $carts = Cart::with(['product'])->where('user_id', Auth::user()->id)->get();

        $data = Product::with(['categories'])->get();

        return view('order.create', compact('data',  'carts'));
    }


    public function addToCart($id)
    {

        $duplicate = Cart::where("product_id", $id)
            ->where("user_id", Auth::user()->id)
            ->first();



        if ($duplicate) {
            Toastr::warning('Product has already been added to the cart', 'Warning');

            return redirect()->back();
        }


        $cart = Cart::create([
            "user_id" => Auth::user()->id,
            'product_id' => $id,
            "qty" => 1
        ]);

        Toastr::success('Successfully added product to cart', 'Success');

        return redirect()->back();
    }


    public function updateCart(Request $request, $id)
    {
        $cart = Cart::where("id", $id)->update([
            'qty' => $request->quantity
        ]);


        return redirect()->back();
    }

    public function deleteCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        Toastr::success('Successfully Menghapus product to cart', 'Success');

        return redirect()->back();
    }


    public function create_receipt(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'no_receipt' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);


        $transaction = Transaction::where('id', $request->transaction_id)->first();

        $image = $request->file('image');
        $filename = time() . '-' . $image->hashName();
        $path = 'order/' . $filename;
        Storage::disk('public')->put($path, file_get_contents($image));


        $transaction->receipt()->create([
            'no_receipt' => $request->no_receipt,
            'image' => $filename
        ]);

        return redirect()->route('order.index');
    }


    public function update_receipt(Request $request)
    {

        // dd($request->all());
        $validator  = Validator::make($request->all(), [
            'no_receipt' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $transaction  = Transaction::where('id', $request->transaction_id)->first();

        if ($request->has('image')) {

            $image = $request->file('image');
            $filename = time() . '-' . $image->getClientOriginalName();
            $path = 'category/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($image));
            Storage::disk('public')->delete('order/' . $transaction->image);

            $data['image'] = $filename;
        }

        $data['no_receipt'] = $request->no_receipt;


        $transaction->receipt()->update($data);

        return redirect()->route('order.index');
    }
    public function upload_receipt(Request $request)
    {

        // dd($request->all());
        $validator  = Validator::make($request->all(), [
            'no_receipt' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $transaction = Transaction::find($request->transaction_id);

        $image = $request->file('image');
        $filename = time() . '-' . $image->hashName();
        $path = 'order/' . $filename;
        Storage::disk('public')->put($path, file_get_contents($image));

        if ($transaction) {
            $transaction->update([
                'no_receipt' => $request->no_receipt,
                'image' => $filename,
            ]);
        }

        return redirect()->route('order.index');
    }

    public function export_pdf(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $data = Transaction::with(['detail', 'detail.product'])
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();



        $pdf = Pdf::loadView('pdf.barang-keluar', compact('data'));
        return $pdf->stream('invoice.pdf');
    }
}
