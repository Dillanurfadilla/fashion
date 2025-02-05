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
            <h5 class="mb-0">Data Fashion</h5>
            <form class="ms-auto position-relative" method="GET" action="{{ route('search.fashion') }}">
                <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                    <ion-icon name="search-sharp"></ion-icon>
                </div>
                <input class="form-control ps-5" type="text" name="query" placeholder="search">
            </form>
        </div>
        @if ($message = Session::get("success"))
            <div id="alert" class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            <script>
                // Timeout function to hide the alert after 2 seconds
                setTimeout(function() {
                    document.getElementById('alert').style.display = 'none';
                }, 2000);
            </script>
        @endif
        <div class="table-responsive mt-3">
            <a class="btn btn-sm btn-success px-2" style="margin-bottom:10px"
            href="{{ route("fashion.create") }}"><ion-icon name="add"></ion-icon> Tambah Data</a>
            <a class="btn btn-sm btn-success px-2" style="margin-bottom:10px" 
            href="{{ route("fashion.printpdf") }}"><ion-icon name="add"></ion-icon> Print PDF</a>
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>id</th>
                        <th>kode_fashion</th>
                        <th>nama_fashion</th>
                        <th>harga</th>
                        <th>photo</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($fashion as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->kode_fashion }}</td>
                        <td>{{ $item->nama_fashion }}</td>
                        <td>{{ number_format($item->harga, 2, '.', ',') }}</td>
                        <td>
                            @if($item->photo)
                                <img src="{{ asset('images/'.$item->photo) }}" alt="{{ $item->nama_fashion }}" style="max-width: 100px;">
                            @else
                                No photo
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('fashion.edit', $item->id) }}">
                                <ion-icon name="pencil-sharp"></ion-icon> Edit</a>
                            <a class="btn btn-danger" href="{{ route('fashion.show', $item->id) }}">
                                <ion-icon name="trash-outline"></ion-icon> Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="btn-group" style="margin-top:10px; float:right">
                @for($i = 1; $i <= $totalpages; $i++)
                    <a href="{{ url('fashion?page='.$i) }}" class="btn btn-sm btn-outline-primary">{{ $i }}</a>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection
