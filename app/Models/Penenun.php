<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penenun extends Model
{
    protected $table = 'penenun';
    protected $primaryKey = 'penenun_id';
    public $guarded = ['penenun_id'];
    public $timestamps = false;

    function produk(): HasMany
    {
        return  $this->hasMany(Produk::class, 'penenun_id', 'penenun_id');
    }
}
