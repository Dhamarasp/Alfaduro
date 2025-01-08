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
        $relation = ModelsItem::with('kategori', 'merek');

        if ($this->queryBarang != null) {
            $dataItems = $relation
                ->where('namaBarang', 'like', '%' . $this->queryBarang . '%')
                ->orWhereHas('kategori', function ($query) {
                    $query->where('namaKategori', 'like', '%' . $this->queryBarang . '%');
                })
                ->orWhereHas('merek', function ($query) {
                    $query->where('namaMerek', 'like', '%' . $this->queryBarang . '%'); // Assuming your brand table has a `nameBrand` column.
                })
                ->paginate($paginate);
        } else {
            $dataItems = $relation->paginate($paginate);
        }

        return view('livewire.item', ['items' => $dataItems]);

    }
}
