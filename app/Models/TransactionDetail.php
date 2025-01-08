<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'detail_transaksi';

    public function barang()
    {
        return $this->belongsTo(Item::class, 'id_barang');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi');
    }
}
