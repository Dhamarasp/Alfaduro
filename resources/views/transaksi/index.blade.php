@extends('app')

@section('content')
@include('layouts/toast')
<div class="container-fluid">
    <div class="row">
        <!-- Daftar Barang -->
        <div class="col-md-7">
            <div class="card shadow-lg border-3">
                <div class="card-header text-center py-2 border-2">
                    <h3>Daftar Barang</h3>
                </div>
                <div class="card-body">
                    @if ($items->isempty())
                    <h3 class="text-center">Barang Kosong</h3>
                        
                    @else
                    <input id="search-bar" class="form-control me-2 border-dark border-1 shadow-sm mb-2" type="search" placeholder="Cari Barang" aria-label="Search">
                    <div id="items-container" class="row row-cols-2 row-cols-md-2 row-cols-lg-3 g-3">
                        <!-- Mulai perulangan barang -->
                        
                        <!-- Akhir perulangan barang -->
                    </div>
                        
                    @endif
                </div>
            </div>
        </div>

        <!-- Keranjang -->
        <div class="col-md-5 mt-4 mt-md-0">
            <div class="card shadow-lg border-3">
                <div class="card-header text-center border-2">
                    <h3>Keranjang</h3>
                </div>
                @if ($carts->isempty())
                    <div class="text-center"><i class="bi bi-cart-plus fs-1"></i></div>
                    <h4 class="text-center">Kosong</h4>
                @else
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="fw-bold text-center">
                                    <tr>
                                        <td>No</td>
                                        <td>Barang</td>
                                        <td>Sub Total</td>
                                        <td>Qty</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody class="text-center align-middle">
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td data-price="{{ $cart->item->price }}">
                                                {{ $cart->item->nameItem }}
                                            </td>
                                            
                                            <td class="subtotal">
                                                {{ 'Rp ' . number_format($cart->qty * $cart->item->price, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <input 
                                                    type="number" 
                                                    value="{{ $cart->qty }}" 
                                                    max="{{ $cart->item->stock }} + {{ $cart->qty }}" 
                                                    data-id="{{ $cart->id }}" 
                                                    data-item-id="{{ $cart->item_id }}" 
                                                    class="form-control     update-qty"
                                                    style="width: 100px;">
                                            </td>
                                            <td>
                                                <form action="{{ route('keranjang.destroy', $cart->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end">Total</td>
                                        <td colspan="3"><input class="form-control" type="text" disabled value="Rp. 100.000"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">Pembayaran</td>
                                        <td colspan="3">
                                            <input type="number" class="form-control bg-body-secondary">
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="text-end">
                                <div class="btn btn-warning">Reset</div>
                                <div class="btn btn-primary">Bayar</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
@endsection
