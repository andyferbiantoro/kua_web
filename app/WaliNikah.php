<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaliNikah extends Model
{
    protected $table = "wali_nikah";
    protected $fillable = [
        'nama_lengkap','tempat_lahir','tanggal_lahir','nik','kewarganegaraan','agama','pekerjaan','alamat','id_calon_pengantin'
    ];
}
