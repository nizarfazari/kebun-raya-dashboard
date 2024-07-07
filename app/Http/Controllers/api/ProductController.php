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
        $perPage = $request->query('per_page', 10);
        $searchName = $request->query('name', '');
        $category = $request->query('category', '');

        $products = Product::with('categories')
            ->where('name', 'like', '%' . $searchName . '%');

        if (!empty($category)) {
            $products = $products->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }

        $products = $products->paginate($perPage);

        return new ResponseResource(true, 'Data Product!', $products);
    }
}
