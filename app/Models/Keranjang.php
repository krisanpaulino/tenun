<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'keranjang_id';
    public $guarded = ['keranjang_id'];
    public $timestamps = false;

    function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }
}
