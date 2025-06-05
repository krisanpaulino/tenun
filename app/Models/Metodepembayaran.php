<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metodepembayaran extends Model
{
    protected $table = 'metodepembayaran';
    protected $primaryKey = 'metodepembayaran_id';
    public $guarded = ['metodepembayaran_id'];
    public $timestamps = false;
}
