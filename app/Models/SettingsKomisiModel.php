<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingsKomisiModel extends Model
{
    protected $table = 'settings_komisi';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}
