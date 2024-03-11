<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Models\Category;


class CategoryController extends Controller
{
    function get_category()
    {   
        $data = Category::all();
        return new ResponseResource(true, 'List Category data', $data);
    }

    public function show($slug)
    {
        $category = Category::with('products')->where('slug', $slug)->first();
        return new ResponseResource(true, 'Detail Data Category!', $category);
    }
}
