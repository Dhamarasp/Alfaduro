@extends('app')

@section('content')
    
<div class="card shadow-lg">
    <div class="card-header text-center">
        <h3>Tambah Brand</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
            <div class="mb-3">
                    <label for="brand" class="form-label">Masukkan Gambar Brand</label>
                    <input id="brand" type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="brand" class="form-label">Masukkan Nama Brand</label>
                    <input id="brand" type="text" name="nameBrand" class="form-control" placeholder="Brand Baru">
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-success" type="submit">Tambah</button>
                <button class="btn btn-sm btn-danger" type="reset">Reset</button>
                <a href="{{ route('brand.index') }}" class="btn btn-sm btn-warning text-light">Kembali</a>
            </div>
        </form>
    </div>
</div>

@endsection