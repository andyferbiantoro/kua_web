<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBimbingan extends Model
{
    protected $table = "detail_bimbingan";
    protected $fillable = [
        'id_bimbingan','id_materi_bimbingan','status'
    ];
}
