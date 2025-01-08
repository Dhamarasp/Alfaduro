<div class="card shadow-lg border-3">
    <div class="card-header text-center border-2">
        <h3>Daftar Barang</h3>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="{{ route('barang.create') }}" class="btn btn-success" role="button">Tambah Barang</a>
            </div>
            <div class="col-md-6">
                <input type="search" class="form-control" placeholder="Cari Barang" wire:model.live="queryBarang">
            </div>
        </div>
        @if ($items->isempty())
            <h3 class="text-center">Barang Kosong</h3>
        @else
        <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="fw-bold text-center">
                        <tr>
                            <td>No</td>
                            <td>Kategori</td>
                            <td>Brand</td>
                            <td>Nama Barang</td>
                            <td>Gambar</td>
                            <td>Harga</td>
                            <td>Stok</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody class="align-middle text-center">
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->category->nameCategory }}</td>
                            <td>
                                {{ $item->brand_id ? $item->brand->nameBrand : '' }}
                                @if (!$item->brand_id)
                                    <span class="badge rounded-pill text-bg-danger">No Brand</span>
                                @endif
                            </td>
                            <td>{{ $item->nameItem }}</td>
                            <td>
                                <img class="img-thumbnail product-image" src="{{ asset('images/items/'. $item->image) }}" alt="">
                            </td>
                            <td>{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</td>
                            <td>
                                @if ($item->stock >= 100)
                                    <span class="badge rounded-pill text-bg-success">{{ $item->stock }}</span>
                                    @elseif($item->stock >= 50)
                                    <span class="badge rounded-pill text-bg-warning">{{ $item->stock }}</span>
                                    @elseif($item->stock >= 1)
                                    <span class="badge rounded-pill text-bg-danger">{{ $item->stock }}</span>
                                    @else
                                    <span class="badge rounded-pill text-bg-danger">Habis</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-nowrap d-inline-flex align-items-center">
                                    <a href="{{ route('barang.show', $item->id) }}" class="btn btn-sm btn-primary me-2"><i class="bi bi-pencil-square"></i></a>
                                    <form action="{{ route('barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this barang?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links() }}
            </div>
        @endif
    </div>
</div>
