@extends('app')

@section('content')
<div class="card shadow-lg">
    <div class="card-header text-center">
        <h3>Edit Barang</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('barang.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="mb-3">
                    <label for="category" class="form-label">Pilih Kategori</label>
                    <select id="category" name="category_id" class="form-select" aria-label="Default select example" required>
                        <option selected disabled value="">Lihat Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->nameCategory }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="brand" class="form-label">Pilih Brand</label>
                    <select id="brand" name="brand_id" class="form-select" aria-label="Default select example" required>
                        <option selected disabled value="">Lihat Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $item->brand_id == $brand->id ? 'selected' : '' }}>
                                {{ $brand->nameBrand }}
                            </option>
                            <option value="" {{ $item->brand_id == null ? 'selected' : '' }}>No Brand</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Masukkan Nama Barang</label>
                    <input id="name" name="nameBarang" type="text" class="form-control" value="{{ $item->nameItem }}" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Masukkan Gambar</label>
                    <input id="image" name="image" type="file" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Masukkan Harga</label>
                    <input id="price" name="price" type="number" class="form-control" value="{{ $item->price }}" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Masukkan Stok</label>
                    <input id="stock" name="stock" type="number" class="form-control" value="{{ $item->stock }}" required>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-success" type="submit">Update</button>
                <button class="btn btn-sm btn-danger" type="reset">Reset</button>
                <a href="{{ route('barang.index') }}" class="btn btn-sm btn-warning text-light">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
