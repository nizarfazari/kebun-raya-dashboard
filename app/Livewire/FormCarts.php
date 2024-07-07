<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class FormCarts extends Component
{
    public $carts;
    public $total_biaya_product = 0;

    public function mount()
    {
        $this->updateCartsAndTotal();
    }

    public function decrementQuantity($cartId, $currentQty)
    {
        $cart = Cart::find($cartId);

        if ($currentQty > 1) {
            $cart->qty = $currentQty - 1;
            $cart->save();
        } else {
            session()->flash('error', 'Kuantitas tidak bisa kurang dari 1.');
        }

        $this->updateCartsAndTotal();
    }

    public function deleteCart($itemId)
    {
        $cart = Cart::find($itemId);

        if (!$cart) {
            session()->flash('error', 'Tidak ditemukan item ini');
        }

        $cart->delete();
        $this->updateCartsAndTotal();
    }

    public function incrementQuantity($cartId, $currentQty)
    {
        $cart = Cart::find($cartId);
        $cart->qty = $currentQty + 1;
        $cart->save();

        $this->updateCartsAndTotal();
    }

    public function checkout()
    {
        $this->updateCartsAndTotal(); 

        $carts = Cart::with(['product'])->where('user_id', Auth::user()->id)->get();

        $transactions = Transaction::create([
            'user_id' => Auth::user()->id,
            'status' => 'DITERIMA',
            'total_biaya_product' => $this->total_biaya_product,
            'no_transaction' => "NO-TRS-" . Str::random(10)
        ]);

        foreach ($carts as $cart) {
            $transactions->detail()->create([
                'product_id' => $cart->product->id,
                'qty' => $cart->qty
            ]);
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        session()->flash('message', 'Checkout berhasil dilakukan!');
        return redirect()->to('/order/create');
    }

    private function calculateTotalBiayaProduct()
    {
        $total = 0;
        foreach ($this->carts as $cart) {
            $total += $cart->qty * $cart->product->harga;
        }
        $this->total_biaya_product = $total;
    }

    private function updateCartsAndTotal()
    {
        $this->carts = Cart::with(['product'])->where('user_id', Auth::user()->id)->get();
        $this->calculateTotalBiayaProduct(); // Hitung ulang total biaya produk
    }

    public function render()
    {
        return view('livewire.form-carts');
    }
}
