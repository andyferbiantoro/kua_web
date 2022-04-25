<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = "jadwal";
    protected $fillable = [
        'id_penyuluh','id_user_penyuluh','id_calon_pengantin','id_user_calon_pengantin','tanggal','jam','lokasi','status'
    ];
}
