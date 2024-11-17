@extends('app')

@section('content')
    
<div class="card shadow-lg">
    <div class="card-header text-center">
        <h3>Tambah Kategori</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="mb-3">
                    <label for="category" class="form-label">Masukkan Nama Kategori</label>
                    <input id="category" name="nameCategory" type="text" class="form-control" placeholder="Kategori Baru">
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-success" type="submit">Tambah</button>
                <button class="btn btn-sm btn-danger" type="reset">Reset</button>
                <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-warning text-light">Kembali</a>
            </div>
        </form>
    </div>
</div>

@endsection