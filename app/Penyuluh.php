<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyuluh extends Model
{
    protected $table = "penyuluh";
    protected $fillable = [
        'nik_penyuluh','nama_pegawai','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','pendidikan_formal','alamat_rumah','no_telp','alamat_email','id_user','created_at','updated_at'
    ];
}
