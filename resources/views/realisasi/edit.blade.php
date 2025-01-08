@extends('app')

@section('title', 'Realisasi')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Detail Realisasi Barang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pengadaan</a></div>
            <div class="breadcrumb-item active"><a href="#">Realisasi</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Detail Rencana {{ $realisasi->barang->namabarang }} <span class="text-info">Satuan {{ $realisasi->barang->satuan->namaSatuan }}</span></h4>
                    </div>
                    <div class="card-body">
                        <h3>Perencanaan</h3>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Jumlah Barang</label>
                                <input type="text" class="form-control" id="inputEmail4" disabled value="{{ $realisasi->jumlahBarangRencana }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Harga Barang Satuan <span class="text-info">per {{ $realisasi->barang->satuan->namaSatuan }}</span></label>
                                <input type="text" class="form-control" id="inputPassword4" disabled value="{{ 'Rp ' . number_format( $realisasi->hargaBarangRencana, 0, ',', '.') }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4">Total</label>
                                <input type="text" class="form-control" id="inputPassword4" disabled value="{{ 'Rp ' . number_format( $realisasi->hargaBarangRencana *  $realisasi->jumlahBarangRencana, 0, ',', '.') }}">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Detail Realisasi {{ $realisasi->barang->namabarang }} <span class="text-info">Satuan {{ $realisasi->barang->satuan->namaSatuan }}</span></h4>
                    </div>
                    <form action="{{ route('realisasi.update', $realisasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <h3>Realisasi</h3>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="">Nama Barang</label>
                                    <input type="text" class="form-control" id="" readonly value="{{ $realisasi->barang->namabarang }}">
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="">Gambar Barang</label>
                                    <input type="file" class="form-control" id="" name="gambarBarang">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Harga Beli</label>
                                    <input type="number" class="form-control" value="{{ $realisasi->hargaBarangRealisasi }}" id="" required name="hargaBeli" placeholder="Masukkan Harga Beli">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Harga Jual</label>
                                    <input type="number" class="form-control" value="{{ $realisasi->barang->hargaJual }}" id="" required name="hargaJual" placeholder="Masukkan Harga Jual">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Jumlah Barang</label>
                                    <input type="number" class="form-control" value="{{ $realisasi->jumlahBarangRealisasi }}" id="" required name="jumlahBarangRealisasi" placeholder="Masukkan Jumlah Barang">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Tanggal Realisasi / Masuk</label>
                                    <input type="date" class="form-control" id="" value="{{ $realisasi->barang->tanggalMasuk }}" required name="tanggalMasuk">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Tanggal Expire</label>
                                    <input type="date" class="form-control" id="" value="{{ $realisasi->barang->tanggalExpire }}" required name="tanggalExpire">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">Submit</button>
                            <a href="{{ route('realisasi.show', $realisasi->id_pengadaan) }}" class="btn btn-info">Kembali</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
