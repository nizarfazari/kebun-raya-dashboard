@extends('layouts.master')
@section('title', 'Laravel')

@section('header')
    <div class="section-header">
        <h1>Categories</h1>
    </div>
@endsection
@section('content')
    <div class="section-body">
        <form class="card" method="POST" enctype="multipart/form-data" action="{{ route('category.store') }}">
            @csrf
            <div class="card-header">
                <h4>Form Table Category</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control ">
                    @error('name')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label class="">Category Image</label>
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
