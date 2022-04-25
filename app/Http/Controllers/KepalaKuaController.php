<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CalonPengantin;
use App\WaliNikah;
use App\Penyuluh;
use App\Jadwal;
use App\Sertifikat;
use App\MateriBimbingan;
use App\User;
use Auth;
use File;
use PDF;
use DB;
use Illuminate\Support\Facades\Storage;

class KepalaKuaController extends Controller
{

    public function kepala_kua_lihat_sertifikat()
   {

    //$sertifikat = sertifikat::all();
    // $penyuluh = Penyuluh::all();
     //$pengantin = CalonPengantin::all();

    $sertifikat = DB::table('sertifikat')
      ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.ttl_calon_suami','calon_pengantin.ttl_calon_istri')
      ->orderBy('sertifikat.id','DESC')
      ->get();

    return view('kepala_kua.index',compact('sertifikat'));
}


public function verifikasi_sertifikat($id)
{

  $data_update = Sertifikat::where('id', $id)->first();

  $input =([
            'status' => 1,
        ]);  

 $data_update->update($input);

 return redirect()->back()->with('success', 'Data Sertifikat Berhasil Verifikasi');
}


public function lihat_laporan()
   {

      $laporan = DB::table('sertifikat')
     ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
     ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri')
     ->orderBy('sertifikat.id','DESC')
     ->get();

    return view('kepala_kua.laporan',compact('laporan'));
}


public function kepala_kua_lihat_sertifikat_suami($id)
   {


    $sertifikat = DB::table('sertifikat')
      ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.ttl_calon_suami','calon_pengantin.ttl_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri')
      ->orderBy('sertifikat.id','DESC')
      ->where('sertifikat.id',$id)
      ->get();

      $cek_sertifikat = Sertifikat::where('id',$id)->first();

      $materi = DB::table('materi_bimbingan')
      ->join('calon_pengantin', 'materi_bimbingan.id_calon_pengantin', '=', 'calon_pengantin.id')
      ->select('materi_bimbingan.*')
      ->where('materi_bimbingan.id_calon_pengantin', $cek_sertifikat->id_calon_pengantin)
      ->orderBy('materi_bimbingan.id','DESC')
      ->get();

    return view('kepala_kua.lihat_sertifikat_suami',compact('sertifikat','materi'));
}

public function kepala_kua_lihat_sertifikat_istri($id)
   {


    $sertifikat = DB::table('sertifikat')
      ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.ttl_calon_suami','calon_pengantin.ttl_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri')
      ->orderBy('sertifikat.id','DESC')
      ->where('sertifikat.id',$id)
      ->get();


      $cek_sertifikat = Sertifikat::where('id',$id)->first();

      $materi = DB::table('materi_bimbingan')
      ->join('calon_pengantin', 'materi_bimbingan.id_calon_pengantin', '=', 'calon_pengantin.id')
      ->select('materi_bimbingan.*')
      ->where('materi_bimbingan.id_calon_pengantin', $cek_sertifikat->id_calon_pengantin)
      ->orderBy('materi_bimbingan.id','DESC')
      ->get();

    return view('kepala_kua.lihat_sertifikat_istri',compact('sertifikat','materi'));
}

}
