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
            "nameBrand" => $request->nameBrand,
            "image" => $imageName,
        ]);

        return redirect()->route("brand.index")->with("success", "Berhasil Tambah Brand");
    }

    public function destroy(Brand $brand)
    {
        if($brand->image != 'default.png'){
            
            $imagePath = public_path('images/brands/' . $brand->image);
    
            if (file_exists($imagePath) && $brand->image) {
                unlink($imagePath);
            }

        }

        $brand->delete();
        return redirect()->route("brand.index")->with("success", "Berhasil Hapus Brand");
    }
}
