@extends('app')

@section('title', 'Tambah Barang')
@section('content')

<section class="section">
    <div class="section-header">
        <h1>Pengembalian Barang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pengadaan</a></div>
            <div class="breadcrumb-item active"><a href="#">Return</a></div>
            <div class="breadcrumb-item active"><a href="#">Show</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <form action="{{ route('return.store.detailBarang') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Pilih Barang</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Barang</label>
                                    <input type="hidden" value="{{ $id }}" name="id_pengembalian">
                                    <select name="id_barang" id="" required class="form-control">
                                        <option value="" selected disabled>Pilih Barang</option>
                                        @foreach ($barang as $data)
                                        <option value="{{ $data->id }}">{{ $data->namabarang }} - {{ $data->merek->namaMerek }} - {{ $data->satuan->namaSatuan }}(Satuan)</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Jumlah Barang</label>
                                    <input type="number" class="form-control" required name="jumlahBarangKembali" required=""
                                        placeholder="Masukkan Jumlah Barang">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Alasan Pengembalian</label>
                                    <textarea name="alasan" id="" cols="30" rows="10" class="form-control">

                                    </textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary text-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
