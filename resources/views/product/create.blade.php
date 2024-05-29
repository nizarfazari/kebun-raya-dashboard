@extends('layouts.master')
@section('title', 'Laravel')

@section('header')
    <div class="section-header">
        <h1>Prodcuts</h1>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <form class="card" method="POST" enctype="multipart/form-data" action="{{ route('product.store') }}">
            @csrf
            <div class="card-header">
                <h4>Form Table Product</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control ">
                    @error('name')
                        <small>{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="summernote form-control" placeholder="Type a reply ..." name="description"></textarea>
                    @error('name')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control ">
                    @error('name')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Berat</label>
                    <input type="number" name="berat" class="form-control ">
                    @error('berat')
                        <small>{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" multiple name="cateogries[]">
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control ">
                    @error('name')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label class="">Product Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="image">
                        <label class="custom-file-label" for="customFile">Choose file</label>
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


@push('before-script')
    <script src="{{ asset('/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script lang="js">
        const form = document.querySelector('form');
        const fileInput = document.getElementById('customFile');

        form.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (event) => {
            const selectedFile = event.target.files[0];

            if (selectedFile) {
                console.log('Selected File:', selectedFile);
            } else {
                console.log('No file selected');
            }
        });
    </script>
@endpush
