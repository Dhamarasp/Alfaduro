@extends('app')

@section('content')
@include('layouts/toast')
<div class="card shadow-lg border-3">
    <div class="card-header text-center border-2">
        <h3>Daftar Kategori</h3>
    </div>
    <div class="card-body">
        <div class="mb-1">
            <a href="{{ route('kategori.create') }}" class="btn btn-success" role="button">Tambah Kategori</a>
        </div>
        @if ($categories->isempty())
        <h3 class="text-center">Kategori Kosong</h3>
        @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="fw-bold text-center">
                    <tr>
                        <td>No</td>
                        <td>Nama Kategori</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->nameCategory }}</td>
                        <td>
                            <div class="text-nowrap d-inline-flex align-items-center">
                                <button class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i></button>
                                <form action="{{ route('kategori.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
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