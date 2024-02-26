@extends('layouts.master')
@section('title', 'Laravel')

@section('header')
    <div class="section-header">
        <h1>Categories</h1>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Form Tambah Category</h4>
              </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control">
                </div>
                <div>
                    <label class="">Category Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
@endsection
