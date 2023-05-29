<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingModel extends Model
{
    protected $table = 'marketing';
    protected $primaryKey = 'id';
    protected $fillable = ["name"];
    public $timestamps = false;
}
