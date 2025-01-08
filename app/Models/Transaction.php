<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{

    protected $table = 'transaksi';

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pegawai');
    }
    public function jenispembayaran(): BelongsTo
    {
        return $this->belongsTo(jenisPembayaran::class, 'id_pembayaran');
    }
    public function layananpemesanan(): BelongsTo
    {
        return $this->belongsTo(layananPemesanan::class, 'id_layanan');
    }
    public function detail (){
        return $this->hasMany(TransactionDetail::class, 'id_transaksi');
    }

}
