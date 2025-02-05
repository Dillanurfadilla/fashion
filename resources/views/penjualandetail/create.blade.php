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
        <h6 class="mb-0">Add Penjualandetail</h6>
    </div>
    <div class="card-body">
        @if(session('status'))
            <div id="alert" class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
            <script>
                // Timeout function to hide the alert after 3 seconds
                setTimeout(function() {
                    document.getElementById('alert').style.display = 'none';
                }, 2000); 
            </script>
        @endif
        <form action="{{ route('penjualandetail.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
            <div class="mb-3">
                <label class="form-label">penjualan_id:&nbsp;{{ $id }}</label>
                <input type="hidden" name="penjualan_id" class="form-control" placeholder="penjualan_id" value="{{ $id }}">
                @error('penjualan_id')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="search">Search:</label>
                <input type="text" id="search" name="search" class="form-control" autocomplete="off">
                <div id="suggestions" class="autocomplete-suggestions"></div>
            </div>
            <div class="mb-3">
                <label class="form-label">kode_fashion:</label>
                <input type="text" name="kode_fashion" id="kode_fashion" class="form-control" autocomplete="off">
                @error('kode_fashion')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">nama_fashion:</label>
                <input type="text" name="nama_fashion" id="nama_fashion" class="form-control" autocomplete="off">
                @error('nama_fashion')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">harga:</label>
                <input type="text" name="harga" id="harga" class="form-control" placeholder="harga" value="0">
                @error('harga')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Quantity:</label>
                <div class="col-1">
                    <input type="number" name="qty" id="qty" class="form-control" placeholder="qty" value="1" required min="1" onchange="calculateSubtotal()">
                </div>
                @error('qty')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">subtotal:</label>
                <input type="text" name="subtotal" id="subtotal" class="form-control" placeholder="subtotal">
                @error('subtotal')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function calculateSubtotal() {
        // Get the value of harga and qty
        let harga = parseFloat(document.getElementById('harga').value);
        let qty = parseInt(document.getElementById('qty').value);

        // Calculate subtotal
        let subtotal = harga * qty;

        // Display subtotal in the subtotal input field
        document.getElementById('subtotal').value = subtotal.toFixed(2); // Using toFixed to format to 2 decimal places
    }

    $(document).ready(function() {
        $('#search').on('input', function() {
            var query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: '{{ route("search.fashion") }}',
                    method: 'GET',
                    data: { query: query },
                    success: function(data) {
                        var suggestions = '';
                        
                        data.forEach(function(fsh) {
                            suggestions += '<div class="autocomplete-suggestion" ' +
                                        'data-kode_fashion="' + fsh.kode_fashion + '" ' +
                                        'data-harga="' + fsh.harga + '" ' +
                                        'data-nama_fashion="' + fsh.nama_fashion + '">' +
                                        fsh.kode_fashion + ' - ' + fsh.nama_fashion + 
                                        '</div>';
                        });
                        $('#suggestions').html(suggestions);
                    }
                });
            } else {
                $('#suggestions').html('');
            }
        });

        $(document).on('click', '.autocomplete-suggestion', function() {
            var kode_fashion = $(this).data('kode_fashion');
            var nama_fashion = $(this).data('nama_fashion');
            var harga = $(this).data('harga');
                
            // Now kode_fashion and nama_fashion contain the respective values
            console.log('kode_fashion: ' + kode_fashion);
            console.log('nama_ashion: ' + nama_fashion);
            console.log('harga: ' + harga);
            
            // Put the combined text in the input fields
            $('#kode_fashion').val(kode_fashion);
            $('#nama_fashion').val(nama_fashion);
            $('#harga').val(harga);
            $('#subtotal').val(harga);
            
            // Clear the search field and suggestions
            $('#search').val('');
            $('#suggestions').html('');
        });
    });
</script>
@endpush
