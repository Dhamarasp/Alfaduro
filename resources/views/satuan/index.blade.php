@extends('app')

@section('title', 'Satuan')
@section('content')

<section class="section">
    <div class="section-header">
      <h1>Satuan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Kelola</a></div>
        <div class="breadcrumb-item">Satuan</div>
      </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card shadow">
                <form action="{{ route('satuan.store') }}" method="POST">
                @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label>Tambah Satuan Baru</label>
                      <input type="text" class="form-control" name="namaSatuan" required="" placeholder="Masukkan Satuan Baru">
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
              <h4>Daftar Satuan</h4>
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
                    <th>Nama Satuan</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($satuan as $satuan)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $satuan->namaSatuan }}</td>
                    <td>
                        <a href="#" class="btn btn-icon btn-info"><i class="fas fa-info-circle"></i></a>
                        <a href="#" class="btn btn-icon btn-warning"><i class="far fa-edit"></i></a>
                        <!-- Delete Button -->
                        <button class="btn btn-icon btn-danger" onclick="confirmDelete({{ $satuan->id }})">
                            <i class="fas fa-trash"></i>
                        </button>

                        <!-- Delete Form (hidden) -->
                        <form id="delete-form-{{ $satuan->id }}" action="{{ route('satuan.destroy', $satuan->id) }}" method="POST" style="display: none;">
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