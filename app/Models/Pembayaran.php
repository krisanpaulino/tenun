<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'pembayaran_id';
    public $guarded = ['pembayaran_id'];
    public $timestamps = false;

    function metode(): BelongsTo
    {
        return $this->belongsTo(Metodepembayaran::class, 'metode_id', 'metodepembayaran_id');
    }
}
