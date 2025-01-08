@extends('app')

@section('title', 'Pegawai')
@section('content')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('pegawai.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                          </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword4">Password</label>
                          <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Masukkan Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="Alamat" placeholder="Contoh : Jl. Ketintang No 123">
                      </div>
                      
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputCity">No Telepon</label>
                          <input type="number" placeholder="Contoh : 081296371647" name="noTelp" class="form-control" id="inputCity">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputState">Jabatan</label>
                          <select id="inputState" class="form-control" name="id_jabatan">
                            <option selected>Pilih Jabatan</option>
                            @foreach ($jabatan as $choose)
                                <option value="{{ $choose->id }}">{{ $choose->namaJabatan }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
      </div>
    </div>
  </div>

<section class="section">
    <div class="section-header">
      <h1>Pegawai</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Kelola</a></div>
        <div class="breadcrumb-item">Pegawai</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card-header-form">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Tambah pegawai    
          </button>
          <div class="card shadow">
              <div class="card-header">
                  <h4>Daftar Pegawai</h4>
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
                    <th>Jabatan</th>
                    <th>email</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($pegawai as $pegawai)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pegawai->name }}</td>
                    <td>{{ $pegawai->jabatan->namaJabatan }}</td>
                    <td>{{ $pegawai->email }}</td>
                    <td>{{ $pegawai->noTelp }}</td>
                    <td>{{ $pegawai->alamat }}</td>
                    <td>
                        <a href="#" class="btn btn-icon btn-info"><i class="fas fa-info-circle"></i></a>
                        <a href="#" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                        <!-- Delete Button -->
                        <button class="btn btn-icon btn-danger" onclick="confirmDelete({{ $pegawai->id }})">
                            <i class="fas fa-trash"></i>
                        </button>

                        <!-- Delete Form (hidden) -->
                        <form id="delete-form-{{ $pegawai->id }}" action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" style="display: none;">
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