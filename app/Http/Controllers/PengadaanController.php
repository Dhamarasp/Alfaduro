<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\DetailPengadaanBarang;
use App\Models\DetailPengembalianBarang;
use App\Models\Item;
use App\Models\Pengadaan;
use App\Models\Pengembalian;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    public function indexRencana()
    {
        $pegawai = User::all();
        $supplier = Supplier::all();
        $rencana = Pengadaan::with('pegawai', 'supplier')->get();
        return view('rencana.index', compact('pegawai', 'supplier', 'rencana'));
    }

    public function createRencana()
    {
        return view('rencana.create');
    }

    public function createBarangRencana($id)
    {
        $kategori = Category::all();
        $merek = Brand::all();
        $satuan = Satuan::all();
        $barang = Item::all();
        return view('rencana.create', compact('id','barang', 'kategori', 'merek', 'satuan'));
    }

    public function storeRencana(Request $request)
    {
        $rencana = Pengadaan::create([
            'id_pegawai' => $request->id_pegawai,
            'id_supplier' => $request->id_supplier,
            'tanggalRencana' => $request->tanggalRencana,
            'anggaranRencana' => 0,
            'jumlahRencana' => 0,
        ]);

        return redirect()->route('rencana.show', $rencana->id)
                     ->with('success', 'Data successfully created!');

    }

    public function storeBarangRencana(Request $request)
    {
        //dd($request->all());
        Item::create([
            'namaBarang' => $request->namaBarang,
            'id_kategori' => $request->id_kategori,
            'id_merek' => $request->id_merek,
            'id_satuan' => $request->id_satuan,
        ]);

        return redirect()->back()->with('success', 'Barang Baru Berhasil DiTambahkan');

    }

public function storeDetailBarangRencana(Request $request)
{
    $detail = DetailPengadaanBarang::create([
        'id_pengadaan' => $request->id_pengadaan,
        'id_barang' => $request->id_barang,
        'jumlahBarangRencana' => $request->jumlahBarangRencana,
        'hargaBarangRencana' => $request->hargaRencana,
        'status' => 0
    ]);

    $totalHargaRencana = DetailPengadaanBarang::where('id_pengadaan', $detail->id_pengadaan)
        ->select(DB::raw('SUM(hargaBarangRencana * jumlahBarangRencana) as total'))
        ->value('total');

    $jumlahRencana = DetailPengadaanBarang::where('id_pengadaan', $detail->id_pengadaan)->count();

    $pengadaan = Pengadaan::find($request->id_pengadaan);

    if (!$pengadaan) {
        return redirect()->route('rencana.index')->with('error', 'Data Pengadaan tidak ditemukan.');
    }

    $pengadaan->update([
        'anggaranRencana' => $totalHargaRencana,
        'jumlahRencana' => $jumlahRencana
    ]);

    return redirect()->route('rencana.show', $request->id_pengadaan)->with('success', 'Berhasil Menambahkan Barang');
}


    public function showRencana($id)
    {
        $rencana = Pengadaan::with('pegawai', 'supplier')->findOrFail($id); // Find the record or throw 404
        $detailBarang = DetailPengadaanBarang::with('barang')->where('id_pengadaan', $id)->get();
        return view('rencana.show', compact('rencana', 'detailBarang')); // Pass data to the view
    }

    public function destroyRencana(Pengadaan $rencana)
    {
        $rencana->delete();
        return redirect()->route('rencana.index')->with('success', 'Berhasil Hapus Perencanaan');
    }
    public function destroyRencanaBarang(DetailPengadaanBarang $id)
    {
        $id->delete();
        return redirect()->back()->with('success', 'Berhasil Hapus Detail Barang');
    }




    public function indexRealisasi()
    {
        $pegawai = User::all();
        $supplier = Supplier::all();
        $rencana = Pengadaan::with('pegawai', 'supplier')->get();
        return view('realisasi.index', compact('pegawai', 'supplier', 'rencana'));
    }

    public function showRealisasi($id)
    {
        $rencana = Pengadaan::with('pegawai', 'supplier')->findOrFail($id); // Find the record or throw 404
        $detailBarang = DetailPengadaanBarang::with('barang')->where('id_pengadaan', $id)->get();
        return view('realisasi.show', compact('rencana', 'detailBarang')); // Pass data to the view
    }

    public function editRealisasi(DetailPengadaanBarang $id)
    {
        $realisasi = $id;
        return view('realisasi.edit', compact('realisasi'));
    }

    public function updateRealisasi(DetailPengadaanBarang $id, Request $request)
    {
        if ($request->hasFile('gambarBarang')) {
            // Move the image to 'public/images' directory with a unique name
            $imageName = time() . '.' . $request->file('gambarBarang')->extension();
            $request->file('gambarBarang')->move(public_path('images\items'), $imageName);
        }else {
            $imageName = 'default.png';
        }
        
        $id->update([
            'hargaBarangRealisasi' => $request->hargaBeli,
            'jumlahBarangRealisasi' => $request->jumlahBarangRealisasi,
            'status' => 1
        ]);

        $totalHargaRealisasi = DetailPengadaanBarang::where('id_pengadaan', $id->id_pengadaan)
        ->select(DB::raw('SUM(hargaBarangRealisasi * jumlahBarangRealisasi) as total'))
        ->value('total');

        $jumlahRealisasi = DetailPengadaanBarang::where('id_pengadaan', $id->id_pengadaan)->Where('status', 1)->count();

        $pengadaan = Pengadaan::find($id->id_pengadaan);

        if (!$pengadaan) {
            return redirect()->route('rencana.index')->with('error', 'Data Pengadaan tidak ditemukan.');
        }

        $pengadaan->update([
            'anggaranRealisasi' => $totalHargaRealisasi,
            'jumlahRealisasi' => $jumlahRealisasi
        ]);

        
        $barang = Item::find( $id->id_barang);
        $barang->update([
            'stokBarang' => $barang->stokBarang + $request->jumlahBarangRealisasi,
            'gambarBarang' => $imageName,
            'hargaBeli' => $request->hargaBeli,
            'hargaJual' => $request->hargaJual,
            'laba' => $request->hargaJual - $request->hargaBeli,
            'tanggalMasuk' => $request->tanggalMasuk,
            'tanggalExpire' => $request->tanggalExpire,

        ]);

        return redirect()->route('realisasi.show', $id->id_pengadaan)->with('success', 'Berhasil Update Data');
        //dd($request->all());
    }


    public function indexReturn()
    {
        $pegawai = User::all();
        $supplier = Supplier::all();
        $rencana = Pengembalian::with('pegawai', 'supplier')->get();
        return view('return.index', compact('pegawai', 'supplier', 'rencana'));
    }

    public function storeReturn(Request $request)
    {
        $rencana = Pengembalian::create([
            'id_pegawai' => $request->id_pegawai,
            'id_supplier' => $request->id_supplier,
            'tanggalPengembalian' => $request->tanggalRencana,
            'jumlahPengembalian' => 0,
        ]);

        return redirect()->route('return.show', $rencana->id)
                     ->with('success', 'Data successfully created!');

    }

    public function showReturn($id)
    {
        $rencana = Pengembalian::with('pegawai', 'supplier')->findOrFail($id); // Find the record or throw 404
        $detailBarang = DetailPengembalianBarang::with('barang')->where('id_pengembalian', $id)->get();
        return view('return.show', compact('rencana', 'detailBarang')); // Pass data to the view
    }

    public function createBarangReturn($id)
    {
        $barang = Item::with('kategori', 'merek', 'satuan')->get();
        return view('return.create', compact('id','barang'));
    }

    public function storeDetailBarangReturn(Request $request)
    {
        //dd($request->all());
        $barang = Item::find($request->id_barang);

        if($barang->stokBarang < $request->jumlahBarangKembali){
            return redirect()->back()->with('error', 'Nominal Barang Melebihi Stok');
        }

        $barang->update([
            'stokBarang' => $barang->stokBarang - $request->jumlahBarangKembali
        ]);

        $detail = DetailPengembalianBarang::create([
            'id_pengembalian' => $request->id_pengembalian,
            'id_barang' => $request->id_barang,
            'jumlahBarangKembali' => $request->jumlahBarangKembali,
            'alasan' => $request->alasan,
            'status' => 1
        ]);

        $jumlahPengembalian = DetailPengembalianBarang::where('id_pengembalian', $detail->id_pengembalian)->orWhere('status', 1)->count();

        $pengembalian = Pengembalian::find($request->id_pengembalian);

        if (!$pengembalian) {
            return redirect()->route('return.index')->with('error', 'Data Pengembalian tidak ditemukan.');
        }

        $pengembalian->update([
            'jumlahPengembalian' => $jumlahPengembalian
        ]);

        return redirect()->route('return.show', $request->id_pengembalian)->with('success', 'Berhasil Melakukan Return Barang');
    }
}
