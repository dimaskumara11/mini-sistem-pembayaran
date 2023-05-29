<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PenjualanModel extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id';
    protected $fillable = ["transaction_number","marketing_id","date","cargo_fee","total_balance","grand_total"];
    public $timestamps = false;

    function marketing(): HasOne
    {
        return $this->hasOne(MarketingModel::class, "id", "marketing_id");
    }
}
