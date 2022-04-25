<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyuluh extends Model
{
    protected $table = "penyuluh";
    protected $fillable = [
        'jenis_penyuluh','nik_penyuluh','nama_pegawai','gelar_depan','gelar_belakang','tempat_tanggal_lahir','jenis_kelamin','agama','status_keluarga','pendidikan_formal','bidang_keahlian','unit_kerja','tempat_tugas','wilayah_kerja','diklat_fungsional','jenjang_jabatan','tanggal_sk_cpns','masa_kerja_berdasarkan_skpp','alamat_rumah','kabupaten','provinsi','no_telp','alamat_email','id_user','created_at','updated_at'
    ];
}
