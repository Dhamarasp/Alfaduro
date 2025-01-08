<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'barang';

    public function merek()     
    {
        return $this->belongsTo(Brand::class, 'id_merek');
    }

    public function kategori()     
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }

    public function satuan()     
    {
        return $this->belongsTo(Satuan::class, 'id_satuan');
    }

    public function keranjang()
    {
        return $this->hasMany(Cart::class, 'id_keranjang');
    }
    public function cart()
    {
        return $this->hasone(Cart::class, 'id_barang');
    }

    public function transaksi(){
        return $this->hasManyThrough(Transaction::class, TransactionDetail::class);
    }
}
