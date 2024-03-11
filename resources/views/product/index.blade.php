@extends('layouts.master')
@section('title', 'Laravel')

@section('header')
    <div class="section-header">
        <h1>Products</h1>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Simple Table</h4>
                <a class="btn btn-primary" href="{{ route('product.create') }}">Tambah data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Stock</th>
                                <th>Harga</th>
                                <th>Image</th>
                                <th>Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->name }} </td>
                                    <td>{!! $d->description !!}</td>
                                    <td>{{ $d->stock }} </td>
                                    <td>{{ $d->harga }} </td>
                                    <td>
                                        <img src="{{ asset('storage/product/' . $d->image) }}" alt=""
                                            width="50">
                                    </td>
                                    <td>
                                        @foreach ($d->categories as $category)
                                            <div class="badge badge-success">{{ $category->name }}</div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('category.edit', ['id' => $d->id]) }}"
                                            class="btn btn-secondary">Edit</a>
                                        <a href="#" class="btn btn-secondary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                    class="sr-only">(current)</span></a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
