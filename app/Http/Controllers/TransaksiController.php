<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;


class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::doesntHave('cart')->with("brand", "category")->get();
        $carts = Cart::with("item")->get();
        $total = $carts->sum(function($cart){
            return $cart->item->price * $cart->qty;
        });

        return view("transaksi.index", compact("items", "carts", "total"));
    }


}
