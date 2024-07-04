<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{


    public function get_products(Request $request)
    {
        $data = Product::with('categories')->get();
        return new ResponseResource(true, 'Detail Data Product!', $data);
    }

    public function show($slug)
    {
        $product = Product::with('categories')->where('slug', $slug)->first();
        return new ResponseResource(true, 'Detail Data Product!', $product);
    }


    public function find(Request $request)
    {
        $perPage = $request->input('per_page', 10);


        $products = Product::with('categories')
            ->where('name', 'like', '%' . $request->name . '%')
            ->paginate($perPage);


        return new ResponseResource(true, 'Data Product!', $products);
    }
}
