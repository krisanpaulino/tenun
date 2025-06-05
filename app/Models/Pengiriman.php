<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';
    protected $primaryKey = 'pengiriman_id';
    public $guarded = ['pengiriman_id'];
    public $timestamps = false;

    function log(): HasMany
    {
        return $this->hasMany(LogPengiriman::class, 'pengiriman_id', 'pengiriman_id');
    }
}
