<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::count();
        $products = Product::count();
        $transaction = Transaction::orderBy('created_at', 'desc')->get();
        $totalCostForCurrentMonth = $this->sumTotalCostForCurrentMonth($transaction);
        $totalProfit = $this->sumTotalProfit($transaction);


        
        return view('dashboard.index', compact('categories', 'products', 'transaction', 'totalCostForCurrentMonth', 'totalProfit'));
    }

    private function sumTotalCostForCurrentMonth($data)
    {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $totalCost = 0;

        foreach ($data as $item) {
            $createdMonth = date('m', strtotime($item['created_at']));
            $createdYear = date('Y', strtotime($item['created_at']));

            if ($createdMonth == $currentMonth && $createdYear == $currentYear) {
                $totalCost += (int)$item['total_biaya_product'] + (int)$item['biaya_pengiriman'];
            }
        }

        return $totalCost;
    }

    private function sumTotalProfit($data) {
        $totalProfit = 0;

        foreach ($data as $item) {
            $totalProfit += (int)$item['total_biaya_product'] + (int)$item['biaya_pengiriman'];
        }

        return $totalProfit;
    }
}
