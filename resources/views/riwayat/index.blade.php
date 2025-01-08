@extends('app')

@section('title', 'Riwayat')
@section('content')




<section class="section">
    <div class="section-header">
        <h1>Riwayat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pengadaan</a></div>
            <div class="breadcrumb-item active"><a href="#">Rencana</a></div>
            <div class="breadcrumb-item">Show</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card-header-form">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Daftar Riwayat Transaksi</h4>
                            <div class="card-header-form">
                                {{-- <div class="input-group">
                                    <a href="{{ route('rencana.create', $rencana->id) }}" class="btn btn-primary">Tambah
                                        Barang</a>
                                </div> --}}
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Kasir</th>
                                        <th>Tanggal</th>
                                        <th>Nominal Pembelian</th>
                                        <th>Jumlah Produk</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($riwayat as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->pegawai->name }}</td>
                                        <td>{{ $data->tanggalTransaksi }}</td>
                                        <td>{{ 'Rp ' . number_format( $data->totalHarga , 0, ',', '.') }}</td>
                                        <td>{{ $data->jumlahProduk }}</td>
                                        <td>
                                            <a href="{{ route('transaksi.show', $data->id) }}" class="btn btn-icon btn-info"><i
                                                    class="fas fa-info-circle"></i></a>
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


