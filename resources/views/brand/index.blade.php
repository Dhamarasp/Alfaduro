@extends('app')

@section('content')
@include('layouts/toast')
<div class="card shadow-lg border-3">
    <div class="card-header text-center border-2">
        <h3>Daftar Brand</h3>
    </div>
    <div class="card-body">
        <div class="mb-1">
            <a href="{{ route('brand.create') }}" class="btn btn-success" role="button">Tambah Brand</a>
        </div>
        @if ($brands->isempty())
        <h3 class="text-center">Brand Kosong</h3>
        @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="fw-bold text-center">
                    <tr>
                        <td>No</td>
                        <td>Gambar</td>
                        <td>Nama Brand</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="align-middle text-center">
                    @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img class="img-thumbnail product-image" src="{{ asset('images/brands/'. $brand->image) }}" alt="">
                        </td>
                        <td>{{ $brand->nameBrand }}</td>
                        <td>
                            <div class="text-nowrap d-inline-flex align-items-center">
                                <button class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i></button>
                                <form action="{{ route('brand.destroy', $brand->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this brand?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @endif
    </div>
</div>
@endsection