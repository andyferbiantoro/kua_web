<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalonPengantin extends Model
{
    protected $table = "calon_pengantin";
    protected $fillable = [
        'nik_calon_suami','nama_calon_suami','no_hp_calon_suami','email_calon_suami','alamat_calon_suami','nik_calon_istri','nama_calon_istri','no_hp_calon_istri','email_calon_istri','alamat_calon_istri','tanggal_rencana_menikah','id_user','ttl_calon_suami','ttl_calon_istri'
    ];
}
