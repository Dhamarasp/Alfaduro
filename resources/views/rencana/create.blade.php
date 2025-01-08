@extends('app')

@section('title', 'Tambah Barang')
@section('content')

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Barang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('rencana.store.barang') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" required name="namaBarang" required=""
                                    placeholder="Masukkan Nama Barang">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pilih Kategori</label>
                                <select name="id_kategori" id="" class="form-control">
                                    <option value="" selected disabled>Pilih Salah Satu Kategori</option>
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->namaKategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pilih Merek</label>
                                <select name="id_merek" id="" class="form-control">
                                    <option value="" selected disabled>Pilih Salah Satu Merek</option>
                                    @foreach ($merek as $data)
                                        <option value="{{ $data->id }}">{{ $data->namaMerek }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Pilih Satuan</label>
                                <select name="id_satuan" id="" class="form-control">
                                    <option value="" selected disabled>Pilih Salah Satu Satuan</option>
                                    @foreach ($satuan as $data)
                                        <option value="{{ $data->id }}">{{ $data->namaSatuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary text-right">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="section-header">
        <h1>Tambah Barang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Pengadaan</a></div>
            <div class="breadcrumb-item active"><a href="#">Rencana</a></div>
            <div class="breadcrumb-item active"><a href="#">Show</a></div>
            <div class="breadcrumb-item">Create</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <form action="{{ route('rencana.store.detailBarang') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4>Pilih / Tambah Barang</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Barang - <span class="text-danger">Jika Barang Tidak Ada Silahkan Menambahkan
                                            Barang Baru</span></label>
                                    <select name="id_barang" id="" required class="form-control">
                                        <option value="" selected disabled>Pilih Barang</option>
                                        @foreach ($barang as $data)
                                        <option value="{{ $data->id }}">{{ $data->namabarang }} - {{ $data->satuan->namaSatuan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Jumlah Barang</label>
                                    <input type="hidden" name="id_pengadaan" value="{{ $id }}">
                                    <input type="number" class="form-control" required name="jumlahBarangRencana" required=""
                                        placeholder="Masukkan Jumlah Barang">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Harga</label>
                                    <input type="text" class="form-control" required name="hargaRencana" required=""
                                        placeholder="Masukkan Harga Berdasarkan Satuan Barang">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary text-right">Submit</button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info text-start " data-toggle="modal"
                                data-target="#staticBackdrop">
                                Tambah Barang
                            </button>
                        </div>
                    </form>
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
