<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = Transaction::with(['pegawai', 'detail'])->get();
    
        foreach ($riwayat as $transaksi) {
            $transaksi->jumlahProduk = $transaksi->detail->count();
        }
    
        return view("riwayat.index", compact('riwayat'));
    }


    public function show($id)
    {
        $data = Transaction::with('pegawai', 'jenispembayaran', 'layananpemesanan', 'detail.barang')->findOrFail($id);
        $total = 0;
        foreach ($data->detail as $detail) {
            $total += $detail->barang->hargaJual * $detail->jumlahBarang;
        }
        return view('riwayat.show', compact('data', 'total'));
    }
}