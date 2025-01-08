<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPengadaanBarang extends Model
{
    protected $table = 'detail_pengadaan_barangs';

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'id_barang');
    }
    public function pengadaan(): BelongsTo
    {
        return $this->belongsTo(Pengadaan::class, 'id_pengadaan');
    }
}

