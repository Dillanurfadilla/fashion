<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete fashion</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Delete Fashion</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('fashion.destroy', $fashion->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="form-group row">
                                <label for="kode_fashion" class="col-md-4 col-form-label text-md-right">Kode fashion</label>
                                <div class="col-md-6">
                                    <input id="kode_fashion" type="text" class="form-control" name="kode_fashion" value="{{ $fashion->kode_fashion }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_fashion" class="col-md-4 col-form-label text-md-right">Nama Fashion</label>
                                <div class="col-md-6">
                                    <input id="nama_fashion" type="text" class="form-control" name="nama_fashion" value="{{ $fashion->nama_fashion}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga" class="col-md-4 col-form-label text-md-right">Harga</label>
                                <div class="col-md-6">
                                    <input id="harga" type="number" class="form-control" name="harga" value="{{ $fashion->harga }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="photo" class="col-md-4 col-form-label text-md-right">Photo</label>
                                <div class="col-md-6">
                                    @if($fashion->photo)
                                        <img src="{{ asset('images/'.$fashion->photo) }}" alt="Current Photo" style="max-width: 100px; margin-top: 10px;">
                                    @else
                                        <span>No photo available</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-danger">Delete fashion</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
