<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = new Product();
        $data = $data->get();


        return view('product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        $category = $category->get();
        return view('product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
        // $validator = $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        //     'stock' => 'required',
        //     'cateogries' => 'required',
        //     'harga' => 'required',
        //     'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        // ]);

        // dd($validator);
        // if ($validator) return redirect()->back()->withInput()->withErrors($validator);

        $image = $request->file('image');
        $filename = time() . '-' . $image->getClientOriginalName();
        $path = 'product/' . $filename;
        Storage::disk('public')->put($path, file_get_contents($image));

        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['stock'] = $request->stock;
        $data['harga'] = $request->harga;
        $data['image'] = $filename ;

        $product = Product::create($data);
        $product->categories()->sync($request->input('cateogries'));
        return redirect()->route('product.index');



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function get_products() {
        $data = Product::with('categories')->get();
        return response()->json($data);
    }
}
