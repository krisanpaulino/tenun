<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPengiriman extends Model
{
    protected $table = 'logpengiriman';
    protected $primaryKey = 'logpengiriman_id';
    public $guarded = ['logpengiriman_id'];
    public $timestamps = false;
}
