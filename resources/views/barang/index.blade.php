@extends('app')

@section('title', 'Barang')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Barang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Kelola</a></div>
            <div class="breadcrumb-item">Barang</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Daftar Barang</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Merek</th>
                                    <th>Satuan</th>
                                    <th>Stok</th>
                                    <th>Active</th>
                                    <th>Tanggal Expire</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($items as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->namabarang }}</td>
                                    <td>
                                        {{ $data->kategori->namaKategori }}
                                    </td>
                                    <td>{{ $data->merek->namaMerek }}</td>
                                    <td>{{ $data->satuan->namaSatuan }}</td>
                                    <td>{{ $data->stokBarang }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>{{ $data->tanggalExpire }}</td>
                                    <td>
                                        <a href="#" class="btn btn-icon btn-info"><i class="fas fa-info-circle"></i></a>
                                        <a href="#" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                                        <!-- Delete Button -->
                                        <button class="btn btn-icon btn-danger" id="swal-6"
                                            onclick="confirmDelete({{ $data->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Delete Form (hidden) -->
                                        <form id="delete-form-{{ $data->id }}"
                                            action="{{ route('barang.destroy', $data->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span
                                            class="sr-only">(current)</span></a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection