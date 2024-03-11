<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToProduct(Request $request, $id)
    {



        $cart = Cart::create([
            "user_id" => Auth::user()->id,
            'product_id' => $id
        ]);

        return new ResponseResource(true, "Successfully added product to cart", $cart);
    }

    public function show()
    {
        $carts = Cart::with(['product'])->where('user_id', Auth::user()->id)->get();
        return new ResponseResource(true, "List Carts", $carts);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return new ResponseResource(true, "Success to delete cart", $cart);
    }
}
