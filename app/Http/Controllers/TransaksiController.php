<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\jenisPembayaran;
use App\Models\layananPemesanan;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $layanan = layananPemesanan::all();
        $pembayaran = jenisPembayaran::all();
        $pegawai = User::all();
        $items = Item::doesntHave('cart')->with('kategori')->get();
        $carts = Item::has('cart')->get();
        $val_sum=$carts->sum(function($item){
            return $item->hargaJual * $item->cart->quantity;
            }); 
        return view('transaksi.index', compact('items', 'carts', 'val_sum', 'pegawai', 'layanan', 'pembayaran'));
    }

    public function store(Request $request)
    {
        Cart::create([
            'id_barang' => $request->id_barang,
            'quantity' => $request->quantity,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Find the cart item
        $cart = Cart::findOrFail($id);
        
        // Update the quantity
        $cart->quantity = $request->quantity;
        $cart->save();
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Quantity updated successfully.');
    }

    public function checkout(Request $request)
    {
        //dd($request->all());

        if($request->uang < $request->totalHarga) {
            return redirect()->back()->with('error', 'Uang Tidak Cukup');
        }

        Transaction::create([
            'id_pegawai' => $request->id_pegawai,
            'id_pembayaran' => $request->id_pembayaran,
            'id_layanan' => $request->id_layanan,
            'totalHarga' => $request->totalHarga,
            'uangKembali' => $request->uang - $request->totalHarga,
            'uang' => $request->uang,
            'tanggalTransaksi' => now(),
        ]);

        $id_transaksi = Transaction::latest()->first()->id;

        foreach(Cart::all() as $item){
            TransactionDetail::create([
                'id_transaksi' => $id_transaksi,
                'id_barang' => $item->id_barang,
                'jumlahBarang' => $item->quantity,
                'subTotal' => $item->hargaJual * $item->quantity
            ]);
        }

        Cart::truncate();

        return redirect()->route('transaksi.show', $id_transaksi)->with('success', 'Checkout Berhasil');
    }
    
    
    public function destroy(Cart $id)
    {
        $id->delete();
        return redirect()->back();
    }
}
