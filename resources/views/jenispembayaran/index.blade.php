@extends('app')

@section('title', 'Jenis Pembayaran')
@section('content')

<section class="section">
    <div class="section-header">
      <h1>Jenis Pembayaran</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Kelola</a></div>
        <div class="breadcrumb-item">Jenis Pembayaran</div>
      </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <form action="{{ route('jenispembayaran.store') }}" method="POST">
                @csrf
                <div class="card-header">
                    <h4>Tambah Jenis Pembayaran Baru</h4>
                </div>
                  <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                          <label>Jenis</label>
                          <input type="text" class="form-control " name="jenisPembayaran" required="" placeholder="Masukkan Jenis Pembayaran">
                        </div>
                        <div class="form-group col-md-4">
                          <label>Kode</label>
                          <input type="text" class="form-control " name="kode" placeholder="Masukkan No Kode">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Gambar</label>
                            <input type="file" class="form-control " name="gambar" placeholder="Pilih Gambar Kode/Qris">
                        </div>
                    </div>
                    <button class="btn btn-primary text-right">Submit</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
      <div class="row">
        <div class="col-12">
          <div class="card shadow">
              <div class="card-header">
                  <h4>Daftar Jenis Pembayaran</h4>
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
                    <th>Kode</th>
                    <th>Gambar</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($jenisPembayaran as $sup)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sup->jenisPembayaran }}</td>
                    <td>{{ $sup->kode }}</td>
                    <td>{{ $sup->gambar }}</td>
                    <td>
                        <a href="#" class="btn btn-icon btn-info"><i class="fas fa-info-circle"></i></a>
                        <a href="#" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                        <!-- Delete Button -->
                        <button class="btn btn-icon btn-danger" onclick="confirmDelete({{ $sup->id }})">
                            <i class="fas fa-trash"></i>
                        </button>

                        <!-- Delete Form (hidden) -->
                        <form id="delete-form-{{ $sup->id }}" action="{{ route('jenispembayaran.destroy', $sup->id) }}" method="POST" style="display: none;">
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
                  <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
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