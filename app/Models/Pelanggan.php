<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'pelanggan_id';
    public $incrementing = true;
    public $timestamps = false;
    public $guarded = ['pelanggan_id'];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id')->withDefault([
            'username' => 'no data'
        ]);
    }
    function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'kota', 'city_id')->withDefault([
            'city' => 'no data'
        ]);
    }
    function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'provinsi', 'province_id')->withDefault([
            'province' => 'no data'
        ]);
    }
}
