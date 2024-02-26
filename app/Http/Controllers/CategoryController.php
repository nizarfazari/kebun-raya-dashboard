<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {

        $data = new Category;

        $data = $data->get();


        return view('category.index', compact('data'));
    }

    public function create()
    {
        return view('category.create');
    }


    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $image = $request->file('image');
        $filename = date('Y-m-d') . '-' . $image->getClientOriginalName();
        $path = 'category/' . $filename;
        Storage::disk('public')->put($path, file_get_contents($image));

        $data['name'] = $request->name;
        $data['image'] = $filename;

        Category::create($data);

        return redirect()->route('category.index');
    }


    public function edit(Request $request, $id)
    {
        $data = Category::find($id);

        dd($data);
    }
}
