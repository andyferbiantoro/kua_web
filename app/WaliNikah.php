<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaliNikah extends Model
{
    protected $table = "wali_nikah";
    protected $fillable = [
        'nama_lengkap','ttl','nik','kewarganegaraan','agama','pekerjaan','alamat','id_calon_pengantin'
    ];
}
