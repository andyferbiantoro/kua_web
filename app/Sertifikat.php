<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = "sertifikat";
    protected $fillable = [
        'nomor','tanggal_awal','tanggal_akhir','tanggal_terbit','nama_kepala_kua','nip','foto_calon_pengantin','id_calon_pengantin','status'
    ];
}
