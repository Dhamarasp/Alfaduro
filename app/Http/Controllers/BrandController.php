<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view("brand.index", compact("brands"));
    }

    public function create()
    {
        return view("brand.create");
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            // Move the image to 'public/images' directory with a unique name
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/brands'), $imageName);
        }else {
            $imageName = 'default.png';
        }

        Brand::create([
            'namaMerek' => $request->namaMerek,
            'gambarMerek' => $imageName,
        ]);

        return redirect()->route("merek.index")->with("success", "Berhasil Tambah Merek");
    }

    public function destroy(Brand $merek)
    {
        if($merek->gambarMerek != 'default.png'){
            
            $imagePath = public_path('images/brands/' . $merek->gambarMerek);
    
            if (file_exists($imagePath) && $merek->gambarMerek) {
                unlink($imagePath);
            }

        }
        $merek->delete();
        return redirect()->route("merek.index")->with("success", "Berhasil Hapus Merek");
    }
}
