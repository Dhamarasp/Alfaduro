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
        $items = Item::with("brand", "category")->get();

        return view("barang.index", compact("items"));
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view("barang.create", compact("brands","categories"));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->hasFile('image')) {
            // Move the image to 'public/images' directory with a unique name
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images/items'), $imageName);
        }else {
            $imageName = 'default.png';
        }

        Item::create([
            "category_id" => $request->category_id,
            "brand_id" => $request->brand_id,
            "nameItem" => $request->nameBarang,
            "price" => $request->price,
            "stock" => $request->stock,
            "image" => $imageName,
        ]);

        return redirect()->route("barang.index")->with("success", "Berhasil Tambah Barang");
    }

    public function show($id)
    {
        $item = Item::with("brand", "category")->findOrFail($id);
        $categories = Category::all(); // Fetch categories for the dropdown
        $brands = Brand::all(); // Fetch brands for the dropdown
        return view("barang.edit", compact("item", "categories", "brands"));
    }
    

    public function update(Request $request, $id)
    {   
        $item = Item::findOrFail($id);
        $imageName = $item->image;
    
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($imageName != 'default.png' && file_exists(public_path('images/items/' . $imageName))) {
                unlink(public_path('images/items/' . $imageName));
            }
    
            // Save new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/items/'), $imageName);
        }
    
        $item->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'nameItem' => $request->nameBarang,
            'image' => $imageName,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
    
        return redirect()->route('barang.index')->with('success', 'Berhasil Update Barang');
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
