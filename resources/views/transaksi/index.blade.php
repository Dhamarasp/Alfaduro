@extends('app')

@section('title', 'Transaksi')
@section('content')

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1>Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Pengadaan</a></div>
            <div class="breadcrumb-item"><a href="#">Rencana</a></div>
            <div class="breadcrumb-item">Detail</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4>Buat Pesanan</h4>
                    </div>
                    <div class="card-body">
                        @if ($carts->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-3x text-muted"></i>
                            <p class="mt-3">Keranjang kosong</p>
                        </div>
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Barang</th> 
                                        <th>Quantity    </th>
                                        <th>Sub Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cart->namabarang }}</td>
                                
                                        <!-- Form for Updating Quantity -->
                                        <td>
                                            <form id="update-form-{{ $cart->cart->id }}" action="{{ route('transaksi.update', $cart->cart->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group">
                                                    <input type="number" name="quantity" class="form-control form-control-sm text-center"
                                                        value="{{ $cart->cart->quantity }}" min="1" max="{{ $cart->stokBarang }}"
                                                        onchange="updateQuantity({{ $cart->cart->id }})">
                                                </div>
                                            </form>
                                        </td>
                                
                                        <!-- Display Total Price -->
                                        <td>{{ 'Rp ' . number_format($cart->cart->quantity * $cart->hargaJual, 0, ',', '.') }}</td>
                                
                                        <!-- Action Buttons -->
                                        <td>
                                            <div class="">
                                                <form action="{{ route('transaksi.destroy', $cart->cart->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                                {{-- Checkout --}}
                                <tfoot>
                                    <form action="{{ route('checkout') }}" method="POST">
                                        @csrf
                                        <tr>
                                            <td colspan="3" class="text-right font-weight-bold">Pilih Pegawai</td>
                                            <td colspan="2">
                                                <select class="form-control" name="id_pegawai">
                                                    <option disabled selected>Pilih Pegawai</option>
                                                    @foreach ($pegawai as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right font-weight-bold">Opsi Pembayaran</td>
                                            <td colspan="2">
                                                <select class="form-control" name="id_pembayaran">
                                                    <option disabled selected>Pilih Pembayaran</option>
                                                    @foreach ($pembayaran as $item)
                                                        <option value="{{ $item->id }}">{{ $item->jenisPembayaran }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right font-weight-bold">Layanan Pemesanan</td>
                                            <td colspan="2">
                                                <select class="form-control" name="id_layanan">
                                                    <option disabled selected>Pilih Layanan</option>
                                                    @foreach ($layanan as $item)
                                                        <option value="{{ $item->id }}">{{ $item->jenisLayanan }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right font-weight-bold">Grand Total</td>
                                            <td colspan="2">
                                                <input type="text" name="totalHarga" class="form-control text-right" value="{{ $val_sum }}"
                                                readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-right font-weight-bold">Nominal Uang</td>
                                            <td colspan="2">
                                                <input type="number" name="uang" class="form-control">
                                            </td>
                                        </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="text-right mt-3">
                            <button type="reset" class="btn btn-warning"><i class="fas fa-sync"></i> Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Bayar</button>
                        </div>
                    </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Daftar Barang -->
            <div class="col-12">
                <div class="card card-primary shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Daftar Barang</h4>
                        <div class="input-group w-50">
                            <input type="text" class="form-control" placeholder="Cari Barang" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="items-container" class="row">
                            @foreach ($items as $item)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="card shadow-sm border-0 rounded-lg item-card hover-shadow">
                                    <div class="card-header text-center mx-auto bg-light rounded-top">
                                        <img src="{{ asset($item->gambarBarang ? 'images/items/' . $item->gambarBarang : 'images/items/default.png') }}"
                                            alt="Gambar Barang" class="img-fluid rounded"
                                            style="max-height: 120px; object-fit: cover;">
                                    </div>
                                    <div class="card-body text-center">
                                        <h6 class="font-weight-bold text-dark mb-1">{{ $item->namabarang }}</h6>
                                        <p class="text-muted small mb-2 text-nowrap">
                                            <span
                                                class="badge badge-light border">{{ $item->kategori->namaKategori }}</span>
                                            <span
                                                class="badge badge-light border">{{ $item->merek->namaMerek ?? 'No Brand' }}</span>
                                        </p>
                                        <p class="text-primary font-weight-bold mb-2">
                                            {{ 'Rp ' . number_format($item->hargaJual, 0, ',', '.') }}</p>
                                        <span
                                            class="badge {{ $item->stokBarang >= 100 ? 'badge-success' : ($item->stokBarang >= 50 ? 'badge-warning' : 'badge-danger') }}">
                                            Stok: {{ $item->stokBarang }}
                                        </span>
                                    </div>
                                    <div class="card-footer text-center bg-light rounded-bottom">
                                        <form action="{{ route('transaksi.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="id_barang">
                                            <input type="hidden" value="1" name="quantity">
                                            <button type="submit" class="btn btn-sm btn-primary w-100"
                                                {{ $item->stokBarang == 0 ? 'disabled' : '' }}>
                                                <i class="fas fa-cart-plus"></i>Keranjang
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function updateQuantity(cartId) {
        // Submit the form for the given cart ID
        document.getElementById('update-form-' + cartId).submit();
    }
</script>


@endsection
