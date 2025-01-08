<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('kategori', 'merek', 'satuan')->get();

        return view("barang.index", compact("items"));
    }

    public function show($id)
    {
        $item = Item::with("brand", "category")->findOrFail($id);
        $categories = Category::all(); // Fetch categories for the dropdown
        $brands = Brand::all(); // Fetch brands for the dropdown
        return view("barang.edit", compact("item", "categories", "brands"));
    }

    public function destroy(item $item)
    {
        if($item->image != 'default.png'){

            $imagePath = public_path('images/items/' . $item->image);
    
            if (file_exists($imagePath) && $item->image) {
                unlink($imagePath);
            }

        }

        $item->delete();
        return redirect()->route("barang.index")->with("success", "Berhasil Hapus Barang");
    }
}
