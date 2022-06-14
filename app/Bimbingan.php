<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    protected $table = "bimbingan";
    protected $fillable = [
        'id_calon_pengantin','id_user_penyuluh','status'
    ];
}
