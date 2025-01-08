<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();
        return view('supplier.index', compact('supplier'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        Supplier::create([
            'namaSupplier' => $request->namaSupplier,
            'noTeleponSupplier' => $request->noTelpSupplier,
            'alamatSupplier' =>$request->alamatSupplier ,
        ]);

        return redirect()->route("supplier.index")->with("success","Berhasil Tambah Supplier");
    }
    
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route("supplier.index")->with("success","Berhasil Hapus Supplier");
    }
}
