<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResponseResource;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    public function addToProduct(Request $request, $id)
    {
        $duplicate = Cart::where("product_id", $id)
        ->where("user_id", Auth::user()->id)
        ->first();

        
        if ($duplicate) {
            return new ResponseResource(301, "Product has already been added to the cart", $duplicate);
        }

        $cart = Cart::create([
            "user_id" => Auth::user()->id,
            'product_id' => $id,
            "qty" => 1
        ]);

        return new ResponseResource(true, "Successfully added product to cart", $cart);
    }

    public function show()
    {
        $carts = Cart::with(['product'])->where('user_id', Auth::user()->id)->get();
        return new ResponseResource(true, "List Carts", $carts);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where("id", $id)->update([
            'qty' => $request->quantity
        ]);

        return new ResponseResource(true, "Succesfully updated product to cart", $cart);
    }


    public function checkout(Request $request)
    {

        $carts = Cart::with(['product'])->where('user_id', Auth::user()->id)->get();
        $transactions = Transaction::create([
            'user_id' => Auth::user()->id,
            'status' => 'PENDING',
            "total_biaya_product" => $request->total_biaya_product,
            "no_transaction" => "NO-TRS-".Str::random(10)
        ]);

        $transactions->transaction_buyer()->create($request->data_buyer);

        foreach ($carts as $cart) {
            $transactions->detail()->create([
                'product_id' => $cart->product->id,
                'qty' => $cart->qty
            ]);
        };

        Cart::where('user_id', Auth::user()->id)->delete();
        return new ResponseResource(true, "Success to added in order", $cart);
    }


    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return new ResponseResource(true, "Success to delete cart", $cart);
    }
}
