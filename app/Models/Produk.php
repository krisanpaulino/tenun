<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'produk_id';
    public $timestamps = false;
    public $guarded = ['produk_id'];

    function penenun(): BelongsTo
    {
        return $this->belongsTo(Penenun::class, 'penenun_id', 'penenun_id')->withDefault([
            'nama_penenun' => 'deleted'
        ]);
    }
    function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id')->withDefault([
            'nama_kategori' => 'deleted'
        ]);
    }
}
