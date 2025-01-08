@extends('app')

@section('title', 'Nota Pembelian')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Nota Pembelian</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transaksi</a></div>
            <div class="breadcrumb-item active">Nota</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4>Nota Transaksi</h4>
                <button class="btn btn-warning btn-sm" onclick="window.print()">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>
            <div class="card-body">
                <!-- Header Nota -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="font-weight-bold">Toko Madura Keintang</h5>
                        <p>
                            Alamat: Ketintang Nomor 2<br>
                            Telepon: 0897567453
                        </p>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <h5 class="font-weight-bold">Nota #{{ $data->id }}</h5>
                        <p>
                            Tanggal: {{ $data->tanggalTransaksi }}<br>
                            Kasir: {{ $data->pegawai->name }}
                        </p>
                    </div>
                </div>

                <!-- Tabel Nota -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->detail as $detail)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->barang->namabarang }}</td>
                                <td>{{ 'Rp ' . number_format($detail->barang->hargaJual, 0, ',', '.') }}</td>
                                <td>{{ $detail->jumlahBarang }}</td>
                                <td>{{ 'Rp ' . number_format($detail->barang->hargaJual * $detail->jumlahBarang, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right font-weight-bold">Total</td>
                                <td class="text-center">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Footer Nota -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6 class="font-weight-bold">Catatan:</h6>
                        <p>{{ $note ?? 'Terima kasih atas pembelian Anda.' }}</p>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <h6 class="font-weight-bold">Metode Pembayaran:</h6>
                        <p>{{ $data->jenispembayaran->jenisPembayaran }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center text-muted">
                &copy; {{ now()->year }} {{ $store_name ?? 'Nama Toko' }} - Semua Hak Dilindungi.
            </div>
        </div>
    </div>
</section>
@endsection
