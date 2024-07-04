<?php

namespace App\Http\Controllers\web;

use App\Charts\MonthlyTransactionChart;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(MonthlyTransactionChart $chart)
    {
        $totalCostForCurrentMonth = Transaction::with('transaction_buyer')
            ->whereYear('transactions.created_at', date('Y'))
            ->where('transactions.status', 'DITERIMA')
            ->whereMonth('transactions.created_at', date('m'))
            ->join('transaction_buyers', 'transactions.id', '=', 'transaction_buyers.transaction_id')
            ->selectRaw('SUM(transactions.total_biaya_product + transaction_buyers.cost_courier) as total_biaya')
            ->value('total_biaya');

        $totalProfit = Transaction::with('transaction_buyer')
            ->whereYear('transactions.created_at', date('Y'))
            ->where('transactions.status', 'DITERIMA')
            ->join('transaction_buyers', 'transactions.id', '=', 'transaction_buyers.transaction_id')
            ->selectRaw('SUM(transactions.total_biaya_product + transaction_buyers.cost_courier) as total_biaya')
            ->value('total_biaya');
        $categories = Category::count();
        $products = Product::count();
        $transaction = Transaction::orderBy('created_at', 'desc')->get();
        $chart =  $chart->build();


        return view('dashboard.index', compact('categories', 'products', 'transaction', 'totalCostForCurrentMonth', 'totalProfit', 'chart'));
    }
}
