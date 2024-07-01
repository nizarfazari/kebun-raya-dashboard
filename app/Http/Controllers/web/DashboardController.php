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
        $transaction = Transaction::all();


        return view('dashboard.index', compact('categories', 'transaction'));
    }
}
