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

           @livewire('form-carts', ['carts' => $carts])
        </div>
    </section>
@endsection

@push('page-script')
@endpush
