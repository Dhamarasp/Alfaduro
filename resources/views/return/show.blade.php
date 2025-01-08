@extends('app')

@section('title', 'Detail Pengembalian')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Pengembalian Barang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pengadaan</a></div>
            <div class="breadcrumb-item active"><a href="#">Pengembalian</a></div>
            <div class="breadcrumb-item">Show</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama">Nama Pegawai</label>
                                <input type="text" class="form-control" disabled value="{{ $rencana->pegawai->name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama">Supllier</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $rencana->supplier->namaSupplier }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama">Jumlah Barang</label>
                                <input type="text" class="form-control" disabled value="{{ $rencana->jumlahPengembalian }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" disabled value="{{ $rencana->tanggalPengembalian }}"
                                name="tanggalRencana" id="Alamat" placeholder="Contoh : Jl. Ketintang No 123">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-header-form">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Detail Barang</h4>
                            <div class="card-header-form">
                                <div class="input-group">
                                    <a href="{{ route('return.create', $rencana->id) }}" class="btn btn-primary">Tambah
                                        Barang</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Barang Kembali</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($detailBarang as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->barang->namabarang }}</td>
                                        <td>{{ $data->jumlahBarangKembali }}</td>
                                        <td>
                                            @if ($data->status == 1)
                                            <span class="badge badge-success"><i class="fas fa-check"></i></i></span>
                                            @else
                                            <span class="badge badge-danger"><i class="fas fa-times"></i></span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-icon btn-info"><i
                                                    class="fas fa-info-circle"></i></a>
                                            <a href="#" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                                            <!-- Delete Button -->
                                            <button class="btn btn-icon btn-danger"
                                                onclick="confirmDelete({{ $data->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <!-- Delete Form (hidden) -->
                                            <form id="delete-form-{{ $data->id }}"
                                                action="{{ route('rencana.destroy.detailBarang', $data->id) }}"
                                                method="POST" style="display: none;">
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
                                        <a class="page-link" href="#" tabindex="-1"><i
                                                class="fas fa-chevron-left"></i></a>
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
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Anda Yakin ?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form programmatically
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }

</script>
@endsection
