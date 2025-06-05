<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Symfony\Component\Console\Helper\Helper;
class Detailtransaksi extends Model
{
    protected $table = 'detailtransaksi';
    protected $primaryKey = 'detailtransaksi_id';
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = ['detailtransaksi_id'];

    function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }
}
