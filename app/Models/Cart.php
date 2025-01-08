<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'keranjang';

    public function barang()
    {
        return $this->belongsTo(Item::class, 'id_barang');
    }
}
