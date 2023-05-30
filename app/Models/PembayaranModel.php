<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $fillable = ["penjualan_id","jenis","dp","angsuran_bulanan","jatuh_tempo","bunga","sisa_bayar","total_bayar"];
    public $timestamps = false;

    function penjualan(): HasOne
    {
        return $this->hasOne(PenjualanModel::class, "id", "penjualan_id");
    }
}
