@extends('layouts.default')
@section('content')
<!--start breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Master Data</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
                <li class="breadcrumb-item active" aria-current="page">Entry Data</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<div class="card">
    <div class="card-header">
        <h6 class="mb-0">Add Fashion</h6>
    </div>
    <div class="card-body">
        @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('fashion.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kode Fashion:</label>
                <input type="text" name="kode_fashion" class="form-control" placeholder="kode_fashion">
                @error('kode_fashion')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Fashion:</label>
                <input type="text" name="nama_fashion" class="form-control" placeholder="nama_fashion">
                @error('nama_fashion')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Harga:</label>
                <input type="text" name="harga" class="form-control" placeholder="Harga">
                @error('harga')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Foto:</label>
                <input type="file" id="foto" name="photo" class="form-control">
                @error('photo')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div id="imagePreviewContainer" style="display:none;">
                <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 200px;">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#foto').change(function(){
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreviewContainer').show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    });
});
</script>
