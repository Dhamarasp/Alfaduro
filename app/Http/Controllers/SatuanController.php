<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        $satuan = Satuan::all();
        return view('satuan.index', compact('satuan'));
    }

    public function store(Request $request)
    {
        Satuan::create([
            'namaSatuan' => $request->namaSatuan,
        ]);

        return redirect()->route('satuan.index')->with("success","Berhasil Tambah Kategori");
    }

    public function destroy(Satuan $satuan)
    {   
        $satuan->delete();
        // Redirect with a success message
        return redirect()->route('satuan.index')->with("success", "Berhasil Hapus Satuan");
    }
}
