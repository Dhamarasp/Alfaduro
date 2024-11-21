<?php

namespace App\Livewire;

use \App\Models\Item as ModelsItem;
use Livewire\Component;
use Livewire\WithPagination;

class Item extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $queryBarang;

    public function render()
    {
        $paginate = 10;
        $relation = ModelsItem::with('category', 'brand');

        if ($this->queryBarang != null) {
            $dataItems = $relation
                ->where('nameItem', 'like', '%' . $this->queryBarang . '%')
                ->orWhereHas('category', function ($query) {
                    $query->where('nameCategory', 'like', '%' . $this->queryBarang . '%');
                })
                ->orWhereHas('brand', function ($query) {
                    $query->where('nameBrand', 'like', '%' . $this->queryBarang . '%'); // Assuming your brand table has a `nameBrand` column.
                })
                ->paginate($paginate);
        } else {
            $dataItems = $relation->paginate($paginate);
        }

        return view('livewire.item', ['items' => $dataItems]);

    }
}
