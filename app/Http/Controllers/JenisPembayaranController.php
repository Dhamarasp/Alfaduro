<?php

namespace App\Http\Controllers;

use App\Models\jenisPembayaran;
use Illuminate\Http\Request;

class JenisPembayaranController extends Controller
{
    public function index()
    {
        $jenisPembayaran = jenisPembayaran::all();
        return view('jenispembayaran.index', compact('jenisPembayaran'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        jenisPembayaran::create([
            'jenisPembayaran' => $request->jenisPembayaran,
            'kode' => $request->kode,
            'gambar' =>$request->gambar ,
        ]);

        return redirect()->route("jenispembayaran.index")->with("success","Berhasil Tambah Jenis Pembayaran");
    }
    
    public function destroy(jenisPembayaran $id)
    {
        $id->delete();
        return redirect()->route("jenispembayaran.index")->with("success","Berhasil Hapus Jenis Pembayaran");
    }
}
