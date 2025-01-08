<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPengembalianBarang extends Model
{
    protected $table = 'detail_pengembalian_barang';

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'id_barang');
    }
}
