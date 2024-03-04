@extends('layouts.master')
@section('title', 'Laravel')

@section('header')
    <div class="section-header">
        <h1>Categories</h1>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <form class="card" method="POST" enctype="multipart/form-data" action="{{ route('category.update', ['id' => $data->id]) }}">
            @csrf
            @method('PUT')
            <div class="card-header">
                <h4>Form Table Category</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ $data->name }}">
                    @error('name')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <img src="{{ asset('storage/category/' . $data->image) }}" class="mb-4" alt="" width="150">
                </div>
                <div>
                    <div class="custom-file">
                        <label for="formFile" class="form-label">Kategori Gambar</label>
                        <input class="form-control" type="file" name="image" id="formFile" value="{{ $data->image }}">
                    </div>
                    @error('images')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
