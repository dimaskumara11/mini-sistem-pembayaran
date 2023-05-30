<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PembayaranKreditModel extends Model
{
    protected $table = 'pembayaran_kredit';
    protected $primaryKey = 'id';
    protected $fillable = ["pembayaran_id","tanggal_bayar","nilai_bayar"];
    public $timestamps = false;

    function pembayaran(): HasOne
    {
        return $this->hasOne(PembayaranModel::class, "id", "pembayaran_id");
    }
}
