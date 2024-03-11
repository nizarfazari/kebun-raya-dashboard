<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResources;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{


    public function get_products(Request $request)
    {
        $data = Product::with('categories')->get();
        return response()->json($data);
    }

    public function show($slug)
    {
        $product = Product::with('categories')->where('slug', $slug)->first();
        return new ProductResources(true, 'Detail Data Post!', $product);
    }
}
