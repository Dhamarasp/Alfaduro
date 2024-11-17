<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("kategori.index", compact("categories"));
    }

    public function create()
    {
        return view("kategori.create");
    }

    public function store(Request $request)
    {
        Category::create([
            "nameCategory" => $request->nameCategory,
        ]);

        return redirect()->route("kategori.index")->with("success","Berhasil Tambah Kategori");
    }

    public function destroy(Category $category)
    {
        if ($category->id) {
            Log::info("Deleting category ID: " . $category->id);
        } else {
            Log::info("Category ID is missing");
        }
        
        $category->delete();
        // Redirect with a success message
        return redirect()->route("kategori.index")->with("success", "Berhasil Hapus Kategori");
    }
}
