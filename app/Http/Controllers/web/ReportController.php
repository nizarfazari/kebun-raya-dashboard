<?php

namespace App\Http\Controllers\web;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
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


        return view('report-month.index', compact('datas'));
    }

    public function show(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $data = Transaction::with(['detail', 'transaction_buyer'])
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        return view('report-month.detail', compact('data'));
    }
}
