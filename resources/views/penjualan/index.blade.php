@extends("layouts.default")
@section("content")
<!--start breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Master Data</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
            
            <li class="breadcrumb-item active" aria-current="page">Tampil Data</li>
            </ol>
        </nav>
    </div>
    
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0">Data Penjualan</h5>
            <form class="ms-auto position-relative">
                <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                    <ion-icon name="search-sharp"></ion-icon>
                </div>
                <input class="form-control ps-5" type="text" placeholder="search">
            </form>
        </div>
        @if ($message = Session::get("success"))
            <div id="alert" class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            <script>
                    // Timeout function to hide the alert after 3 seconds
                    setTimeout(function() {
                        document.getElementById('alert').style.display = 'none';
                    }, 2000); 
                </script>
        @endif
        <div class="table-responsive mt-3">
            <a class="btn btn-sm btn-success px-2" style="margin-bottom:10px" 
            href="{{ route("penjualan.create") }}"><ion-icon name="add"></ion-icon> Tambah Data</a>
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>id</th>
                        <th>nomor_bukti</th>
                        <th>tanggal</th>
                        <th align="center">total_pembelian</th>
                        <th align="center">status_pembayaran</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($penjualan as $penjualan)
                    
                    <tr>
                        <td>{{ $penjualan->id }}</td>
                        <td>{{ $penjualan->nomor_bukti }}</td>
                        <td>{{ $penjualan->tanggal }}</td>
                        <td align="right">{{ number_format($penjualan->total_pembelian) }}</td>
                        <td align="center">{{ $penjualan->status_pembayaran }}</td>
                        <td>
                        <a class="btn btn-info" href="{{ route('penjualandetail.list', ['id' => $penjualan->id]) }}">
                        <ion-icon name="bag-handle-sharp"></ion-icon> Detail</a>
                            @if($penjualan->total_pembelian==0)
                            <a class="btn btn-primary" href="{{ route('penjualan.edit',$penjualan->id) }}">
                                <ion-icon name="pencil-sharp"></ion-icon> Edit</a>
                            <a class="btn btn-danger" href="{{ route('penjualan.show',$penjualan->id) }}">
                                <ion-icon name="trash-outline"></ion-icon> Delete</a>
                            @endif
  
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
            <div class="btn-group" style="margin-top:10px; float:right">
                @php
                    for($i=1;$i<=$totalpages;$i++){
                        echo("<a href='/penjualan?page=$i' class='btn btn-sm btn-outline-primary'>$i</a>");
                    }   
                @endphp
            </div>
        </div>
    </div>
</div>
@endsection