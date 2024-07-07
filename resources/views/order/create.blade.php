@extends('layouts.master')
@section('title', 'Laravel')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pesanan</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">List Produk</h2>

            <div class="row">
                @foreach ($data as $item)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <article class="article" style="min-height: 400px">
                            <div class="article-header">
                                <div class="article-image" data-background={{ $item->image }}>
                                </div>
                                <div class="article-title">
                                    <h2><a href="#">{{ $item->name }}</a></h2>
                                </div>
                            </div>
                            <div class="article-details">
                                <p>{{ $item->description }}</p>
                                <form action="{{ route('order.addToCart', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Tambah Ke Keranjang</button>
                                </form>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <h2 class="section-title">Cart</h2>
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
                        <tr data-id="{{ $item['id'] }}">
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->harga }}</td>
                            <td>
                                <button class="btn btn-sm btn-secondary decrease-quantity" data-key="{{ $key }}">-</button>
                                <span class="quantity">{{ $item['qty'] }}</span>
                                <button class="btn btn-sm btn-secondary increase-quantity" data-key="{{ $key }}">+</button>
                            </td>
                            <td class="total">{{ $item['qty'] * $item->product->harga }}</td>
                            <td>
                                <button class="btn btn-sm btn-danger remove-item" data-key="{{ $key }}">Remove</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td>Total:</td>
                        <td id="cart-total"> <!-- Total harga cart bisa ditampilkan disini --> </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <form id="checkout-form"  method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Checkout</button>
                            </form>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>
@endsection

@push('page-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan event listener untuk tombol penambahan qty
            document.querySelectorAll('.increase-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    let key = button.getAttribute('data-key');
                    let quantityElement = document.querySelector(`tr[data-id="${key}"] .quantity`);
                    let quantity = parseInt(quantityElement.textContent);
                    quantityElement.textContent = quantity + 1;

                    updateTotal(key, quantity + 1);
                });
            });

            // Tambahkan event listener untuk tombol pengurangan qty
            document.querySelectorAll('.decrease-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    let key = button.getAttribute('data-key');
                    let quantityElement = document.querySelector(`tr[data-id="${key}"] .quantity`);
                    let quantity = parseInt(quantityElement.textContent);
                    if (quantity > 1) {
                        quantityElement.textContent = quantity - 1;

                        updateTotal(key, quantity - 1);
                    }
                });
            });

            // Tambahkan event listener untuk tombol remove item
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    let key = button.getAttribute('data-key');
                    let row = document.querySelector(`tr[data-id="${key}"]`);
                    row.remove();

                    updateTotal(key, 0); // Hapus item dari perhitungan total
                });
            });

            // Fungsi untuk mengupdate total harga cart
            function updateTotal(key, newQuantity) {
                let price = parseFloat(document.querySelector(`tr[data-id="${key}"] td:nth-child(2)`).textContent);
                let totalElement = document.querySelector(`tr[data-id="${key}"] .total`);
                let total = price * newQuantity;
                totalElement.textContent = total;

                // Update total harga keseluruhan
                updateCartTotal();
            }

            // Fungsi untuk mengupdate total harga keseluruhan
            function updateCartTotal() {
                let total = 0;
                document.querySelectorAll('.total').forEach(totalElement => {
                    total += parseFloat(totalElement.textContent);
                });

                document.getElementById('cart-total').textContent = total;
            }

            // Submit form checkout
            document.getElementById('checkout-form').addEventListener('submit', function(event) {
                event.preventDefault();
                // Lakukan sesuatu sebelum mengirim form, misalnya validasi atau lainnya
                this.submit(); // Submit form
            });
        });
    </script>
@endpush
