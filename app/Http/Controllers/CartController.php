<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request){

        $quantity = 1;
        
        $item = Item::findOrFail($request->item_id);
        $qty = ($item->stock) - $quantity;

        $item->update([
            'stock' => $qty
        ]);

        Cart::create([
            'item_id'=> $request->item_id,
            'qty'=> $quantity,
        ]);

        return redirect()->route("transaksi.index");
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:carts,id',
            'item_id' => 'required|exists:items,id', // Ensure the item exists
            'qty' => 'required|integer|min:1'
        ]);
    
        // Find the cart and associated item
        $cart = Cart::findOrFail($request->id);
        $item = Item::findOrFail($request->item_id);
    
        // Calculate the difference in quantity
        $quantityDifference = $request->qty - $cart->qty;
    
        // Check if the item has sufficient stock
        if ($item->stock < $quantityDifference) {
            session()->flash('error', 'Stock tidak mencukupi!');
            return response()->json([
                'success' => false,
                'message' => 'Stock tidak mencukupi!'
            ], 400);
            
        }
    
        // Update the cart quantity
        $cart->qty = $request->qty;
        $cart->save();
    
        // Update the item stock
        $item->stock -= $quantityDifference;
        $item->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Quantity updated successfully!',
            'price' => $item->price,
            'subtotal' => $item->price * $request->qty,
        ]);
    }
    
    public function destroy(Cart $cart)
    {
        $item = Item::findOrFail($cart->item_id);
        $stock = $item->stock + $cart->qty;

        $item->update(['stock' => $stock]);

        $cart->delete();

        return redirect()->route('transaksi.index');
    }
}
