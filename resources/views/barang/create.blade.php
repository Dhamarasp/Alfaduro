@extends('app')

@section('content')
    
<div class="card shadow-lg">
    <div class="card-header text-center">
        <h3>Tambah Barang</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="mb-3">
                    <label for="category" class="form-label">Pilih Kategori</label>
                    <select id="category" name="category_id" class="form-select" aria-label="Default select example" required>
                        <option selected disabled value="">Lihat Kategori</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nameCategory }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="brand" class="form-label">Pilih Brand</label>
                    <select id="brand" name="brand_id" class="form-select" aria-label="Default select example" required>
                        <option selected disabled value="">Lihat Brand</option>
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->nameBrand }}</option>
                        @endforeach
                        <option value="">No Brand</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Barang</label>
                    <input id="name" name="nameBarang" type="text" class="form-control" placeholder="Masukkan Nama Barang" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input id="image" name="image" type="file" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input id="price" name="price" type="number" class="form-control" placeholder="Masukkan Nominal Harga" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stok</label>
                    <input id="stock" name="stock" type="number" class="form-control" placeholder="Masukkan Jumlah Stok" required>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-success" type="submit">Tambah</button>
                <button class="btn btn-sm btn-danger" type="reset">Reset</button>
                <a href="{{ route('barang.index') }}" class="btn btn-sm btn-warning text-light">Kembali</a>
            </div>
        </form>
    </div>
</div>



@endsection