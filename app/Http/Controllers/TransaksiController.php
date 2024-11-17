<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;


class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $items = Item::doesntHave('cart')
                ->with("brand", "category")
                ->when($query, function ($queryBuilder) use ($query) {
                    $queryBuilder->where('nameItem', 'like', "%{$query}%")
                        ->orWhereHas('category', function ($q) use ($query) {
                            $q->where('nameCategory', 'like', "%{$query}%");
                        })
                        ->orWhereHas('brand', function ($q) use ($query) {
                            $q->where('nameBrand', 'like', "%{$query}%");
                        });
                })
                ->get();

            return response()->json(['items' => $items]);
        }

        $items = Item::doesntHave('cart')->with("brand", "category")->get();
        $carts = Cart::with("item")->get();
        return view("transaksi.index", compact("items", "carts"));
    }


}
