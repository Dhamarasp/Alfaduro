@extends('app')

@section('title', 'Perencanaan')
@section('content')

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Perencanaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('return.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama">Nama Pegawai</label>
                                <select class="form-control" name="id_pegawai">
                                    <option selected disabled value="">Pilih Pegawai</option>
                                    @foreach ($pegawai as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                            <div class="form-group col-md-6">
                                <label for="nama">Supllier</label>
                                <Select class="form-control" name="id_supplier">
                                    <option selected disabled value="">Pilih Supplier</option>
                                    @foreach ($supplier as $s)
                                        <option value="{{ $s->id }}">{{ $s->namaSupplier }}</option>
                                    @endforeach
                                </Select>
                              </div>
                        </div>
                      <div class="form-group">
                        <label for="Alamat">Tanggal Rencana</label>
                        <input type="date" class="form-control" name="tanggalRencana" id="Alamat" placeholder="Contoh : Jl. Ketintang No 123">
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
      <h1>Perencanaan Return Barang</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Pengadaan</a></div>
        <div class="breadcrumb-item">Return</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card-header-form">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Rencana    
            </button>
          <div class="card shadow">
              <div class="card-header">
                  <h4>Daftar Perencanaan</h4>
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
                    <th>Tanggal</th>
                    <th>Jumlah Barang</th>
                    <th>Supplier</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($rencana as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->pegawai->name }}</td>
                    <td>{{ $data->tanggalPengembalian }}</td>
                    <td>{{ $data->jumlahPengembalian }}</td>
                    <td>{{ $data->supplier->namaSupplier }}</td>
                    <td>
                        <a href="{{ route('return.show', $data->id) }}" class="btn btn-icon btn-info"><i class="fas fa-info-circle"></i></a>
                        <a href="#" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                        <!-- Delete Button -->
                        <button class="btn btn-icon btn-danger" onclick="confirmDelete({{ $data->id }})">
                            <i class="fas fa-trash"></i>
                        </button>

                        <!-- Delete Form (hidden) -->
                        <form id="delete-form-{{ $data->id }}" action="{{ route('rencana.destroy', $data->id) }}" method="POST" style="display: none;">
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