<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'kategori_id';
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = ['kategori_id'];

    function produk(): HasMany
    {
        return  $this->hasMany(Produk::class, 'kategori_id', 'kategori_id');
    }

    function countProduk()
    {
        return $this->produk()->count();
    }
}
