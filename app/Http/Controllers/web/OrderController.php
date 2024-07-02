<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{


    public function index()
    {


        $datas = Transaction::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total_transactions')
        )
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'), 'asc')->get();


        return view('order.index', compact('datas'));
    }

    public function detail_order(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $data = Transaction::with(['detail', 'transaction_buyer', 'receipt'])
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        return view('order.detail', compact('data'));
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

    public function export_pdf()  {
        
    }
}
