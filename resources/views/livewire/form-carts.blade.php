<div>
    <h2 class="section-title">Cart</h2>
    <form id="checkout-form" wire:submit.prevent="checkout">
        <table id="cart-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $key => $item)
                total_biaya_product = {{ $item['qty'] * $item->product->harga }}
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->product->harga }}</td>
                        <td>
                            <button class="btn btn-sm btn-secondary" type="button"
                                wire:click="decrementQuantity({{ $item->id }}, {{ $item->qty }})">-</button>
                            <span class="quantity">{{ $item->qty }}</span>
                            <button class="btn btn-sm btn-secondary" type="button"
                                wire:click="incrementQuantity({{ $item->id }}, {{ $item->qty }})">+</button>
                        </td>
                        <td class="total">{{ $item['qty'] * $item->product->harga }}</td>
                        <td>
                            <button class="btn btn-sm btn-danger remove-item" type="button" wire:click="deleteCart({{ $item->id }})">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td>Total:</td>
                    <td>{{ $total_biaya_product }}</td>
                </tr>
                <tr>
                    <td colspan="5">
                        @csrf
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>
