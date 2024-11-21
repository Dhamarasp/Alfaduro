<div class="row">
    <!-- Daftar Barang -->
    <div class="col-md-7 mb-4 mb-md-0">
        <div class="card shadow-lg border-3">
            <div class="card-header text-center py-2 border-2">
                <h3>Daftar Barang</h3>
            </div>
            <div class="card-body">
                <input class="form-control me-2 border-dark border-1 shadow-sm mb-3" type="search" placeholder="Cari Barang" aria-label="Search" wire:model.live="query">
                @if ($items->isempty())
                <h3 class="text-center">Barang Kosong</h3>
                @else
                <div id="items-container" class="row row-cols-2 row-cols-md-2 row-cols-lg-3 g-3">
                    <!-- Mulai perulangan barang -->
                    @foreach ($items as $item)
                    <div class="col">
                        <div class="card h-100 border-1 border-dark shadow-lg">
                            <div class="d-flex justify-content-center align-items-center" style="height: 120px;">
                                <img src="{{ asset('images/items/'. $item->image) }}" class="card-img-top rounded" alt="Gambar Barang" style="object-fit: cover; width: 100px; height: 100px;">
                            </div>
                            <div class="card-body p-2">
                                <h6 class="fw-semibold mb-1 text-center">{{ $item->nameItem }}</h6>
                                <p class="text-muted small mb-2 text-center">
                                    <span class="badge bg-secondary">{{ $item->category->nameCategory }}</span> | 
                                    <span class="badge bg-dark">{{ $item->brand && $item->brand->nameBrand ? $item->brand->nameBrand : 'No Brand'}}</span>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-primary fw-bold">{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</span>
                                    @if ($item->stock >= 100)
                                    <span class="badge rounded-pill bg-success">Stok : {{ $item->stock }}</span>
                                    @elseif($item->stock >= 50)
                                    <span class="badge rounded-pill bg-warning">Stok : {{ $item->stock }}</span>
                                    @elseif($item->stock >= 1)
                                    <span class="badge rounded-pill bg-danger">Stok : {{ $item->stock }}</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Stok : Habis</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer p-2 bg-transparent border-0">
                                <button type="submit" {{ $item->stock == 0 ? 'disabled' : '' }} class="btn btn-outline-primary w-100 btn-sm" wire:click="store({{ $item->id }})">
                                        <i class="bi bi-cart-plus me-1"></i>Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- Akhir perulangan barang -->
                </div>
                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $items->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Keranjang -->
    <div class="col-md-5">
        <div class="card shadow-lg border-3">
            <div class="card-header text-center py-2 border-2">
                <h3>Keranjang</h3>
            </div>
            @if ($carts->isempty())
                <div class="text-center py-4">
                    <i class="bi bi-cart-plus fs-1"></i>
                    <h4 class="text-center">Kosong</h4>
                </div>
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
                                            <div class="input-group">
                                                <!-- Minus Button -->
                                                <button 
                                                  class="btn btn-outline-danger btn-sm" wire:click="decreaseQty({{ $cart->id }})" 
                                                  type="button" 
                                                  id="decreaseBtn">
                                                  <i class="bi bi-dash"></i>
                                                </button>
                                        
                                                <!-- Number Input -->
                                                <input 
                                                    type="number" 
                                                    class="form-control form-control-sm text-center"
                                                    wire:model="quantity.{{ $cart->id }}"
                                                    style="width: 50px;" 
                                                    readonly> <!-- Make it readonly to avoid invalid manual inputs -->
                                        
                                                <!-- Plus Button -->
                                                <button 
                                                  class="btn btn-outline-success btn-sm" wire:click="increaseQty({{ $cart->id }})" 
                                                  type="button" 
                                                  id="increaseBtn">
                                                  <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-danger" wire:click="destroy({{ $cart->id }})">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end">Total</td>
                                    <td colspan="2"><input class="form-control" type="text" disabled value="{{ 'Rp ' . number_format($total, 0, ',', '.') }}"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end">Opsi Pembayaran</td>
                                    <td colspan="2">
                                        <select name="" id="" class="form-control">
                                            <option value="" selected disabled>Pilih Opsi Pembayaran</option>
                                            <option value="">Cash</option>
                                            <option value="">Qris</option>
                                        </select>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="text-end mt-3">
                            <button class="btn btn-warning">Reset</button>
                            <button class="btn btn-primary">Bayar</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
