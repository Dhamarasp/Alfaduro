<?php

namespace App\Livewire;


use App\Models\Cart as ModelsCart;
use App\Models\Item as ModelsItem;
use Livewire\Component;
use Livewire\WithPagination;

class Transaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $query, $quantity = [];

    public function mount()
    {
        $cartItems = ModelsCart::all(); // Fetch all cart items
        foreach ($cartItems as $cart) {
            $this->quantity[$cart->id] = $cart->qty; // Initialize quantity for each cart item
        }
    }

    public function store($id)
    {
        $item = ModelsItem::find($id);
    
        if ($item->stock > 0) {
            $item->update([
                'stock' => $item->stock - 1
            ]);
    
            $cart = ModelsCart::create([
                'item_id' => $id,
                'qty' => 1
            ]);
    
            $this->quantity[$cart->id] = 1;
        } else {

        }
    }
    

   public function increaseQty(ModelsCart $id)
    {
        $itemStock = ModelsItem::find($id->item_id);

        if ($itemStock->stock != 0) {
            $id->update([
                'qty' => $id->qty + 1
            ]);

            $itemStock->update([
                'stock' => $itemStock->stock - 1
            ]);

            $this->quantity[$id->id] = $id->qty;
        } else {
            return redirect()->route('transaksi.index')->with('error','Stock Maksimal');
        }
    }

    public function decreaseQty(ModelsCart $id)
    {
        $itemStock = ModelsItem::find($id->item_id);

        if ($id->qty > 1) {
            $id->update([
                'qty' => $id->qty - 1
            ]);

            $itemStock->update([
                'stock' => $itemStock->stock + 1
            ]);

            $this->quantity[$id->id] = $id->qty;
        } else {
            return redirect()->route('transaksi.index')->with('error','Quantity Minimal 1');
        }
    }

    public function destroy(ModelsCart $id)
    {
        $item = ModelsItem::find($id->item_id);
    
        $item->update([
            'stock' => $item->stock + $id->qty
        ]);
    
        $id->delete();
    
        unset($this->quantity[$id->id]);
    }

    public function render()
    {
        $paginate = 9;

        if ($this->query != null) {
            # code...
            $dataItems = ModelsItem::doesntHave('cart')->where('nameItem', 'like', '%' . $this->query . '%')
            ->with('category', 'brand')->paginate($paginate);
        } else {
            # code...
            $dataItems = ModelsItem::doesntHave('cart')->with('category', 'brand')->paginate($paginate);
        }

        $dataCarts = ModelsCart::with('item')->get();

        $total = $dataCarts->sum(function($item){
            return $item->qty * $item->item->price;
        });
        
        return view('livewire.transaksi', ['items' => $dataItems, 'carts' => $dataCarts, 'total' => $total]);
    }
}
