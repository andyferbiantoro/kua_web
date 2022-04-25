<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriBimbingan extends Model
{
     protected $table = "materi_bimbingan";
    protected $fillable = [
        'nama_materi','id_user_penyuluh','status'
    ];
}
