@extends('layouts.default')
@section('content')
<!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Master Data</div>
        <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
            
            <li class="breadcrumb-item active" aria-current="page">Delete Data</li>
            </ol>
        </nav>
        </div>
        
    </div>
    <!--end breadcrumb-->


    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Delete Penjualan</h6>
        </div>
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('penjualan.destroy',$penjualan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            
                <div class="mb-3">
                    <label class="form-label">nomor_bukti:</label>
                    <input type="text" name="nomor_bukti" value="{{ $penjualan->nomor_bukti }}" class="form-control" 
                    placeholder="nomor_bukti" disabled="" readonly="">
                    @error('nomor_bukti')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">tanggal:</label>
                    <input type="text" name="tanggal" value="{{ $penjualan->tanggal }}" class="form-control" 
                    placeholder="tanggal" disabled="" readonly="">
                    @error('tanggal')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">total_pembelian:</label>
                    <input type="text" name="total_pembelian" value="{{ $penjualan->total_pembelian }}" class="form-control" 
                    placeholder="total_pembelian" disabled="" readonly="">
                    @error('total_pembelian')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">status_pembayaran:</label>
                    <select name="status_pembayaran" class="form-select mb-3" 
                        aria-label="Default select example" disabled=\"\" readonly=\"\">
                        <option value="{{ $penjualan->status_pembayaran }}">{{ $penjualan->status_pembayaran }}</option>
                        <option value="PIUTANG">PIUTANG</option>
                        <option value="LUNAS">LUNAS</option>
                        
                    </select>
                    @error('status_pembayaran')       
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-danger ml-3">Delete</button>
                </div>

            </form>
        </div>
    </div>
@endsection