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

class CatinController extends Controller
{

public function catin_lihat_jadwal()
  {

   $jadwal = DB::table('jadwal')
   ->join('penyuluh' , 'jadwal.id_user_penyuluh', '=' , 'penyuluh.id_user')
   ->join('calon_pengantin' , 'jadwal.id_calon_pengantin', '=' , 'calon_pengantin.id')
   ->join('users' , 'calon_pengantin.id_user', '=' , 'users.id')
   ->select('jadwal.*','penyuluh.nama_pegawai','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
   ->orderBy('jadwal.id','DESC')
   ->where('users.id', Auth::user()->id)
   ->where('jadwal.status',1)
   ->get();


   return view('catin.index',compact('jadwal'));
}


public function sertifikat_catin()
  {


   $sertifikat = DB::table('sertifikat')
   ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
   ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.ttl_calon_suami','calon_pengantin.ttl_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri')
   ->orderBy('sertifikat.id','DESC')
   ->where('calon_pengantin.id_user',  Auth::user()->id)
   ->where('sertifikat.status', 1)
   ->get();

   $cek_pengantin = CalonPengantin::where('id_user',Auth::user()->id)->first();
   $cek_sertifikat = Sertifikat::where('id_calon_pengantin',$cek_pengantin->id)->first();

   $materi = DB::table('materi_bimbingan')
   ->join('calon_pengantin', 'materi_bimbingan.id_calon_pengantin', '=', 'calon_pengantin.id')
   ->select('materi_bimbingan.*')
   ->where('materi_bimbingan.id_calon_pengantin', $cek_sertifikat->id_calon_pengantin)
   ->orderBy('materi_bimbingan.id','DESC')
   ->get();

   return view('catin.sertifikat_catin',compact('sertifikat','materi'));
}


public function catin_cetak_sertifikat_suami()
{

  $sertifikat = DB::table('sertifikat')
      ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.ttl_calon_suami','calon_pengantin.ttl_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri')
      ->orderBy('sertifikat.id','DESC')
      ->where('calon_pengantin.id_user',  Auth::user()->id)
      ->where('sertifikat.status', 1)
      ->get();


      $cek_pengantin = CalonPengantin::where('id_user',Auth::user()->id)->first();
      $cek_sertifikat = Sertifikat::where('id_calon_pengantin',$cek_pengantin->id)->first();

      $materi = DB::table('materi_bimbingan')
      ->join('calon_pengantin', 'materi_bimbingan.id_calon_pengantin', '=', 'calon_pengantin.id')
      ->select('materi_bimbingan.*')
      ->where('materi_bimbingan.id_calon_pengantin', $cek_sertifikat->id_calon_pengantin)
      ->orderBy('materi_bimbingan.id','DESC')
      ->get();

//return $sertifikat;
      view()->share('sertifikat', $sertifikat);
      view()->share('materi', $materi);


  $pdf = PDF::loadview('catin.cetak_sertifikat_suami', ['sertifikat' => $sertifikat],['materi' => $materi])->setPaper('A4','landscape');

  return $pdf->stream('sertifikat_suami.pdf');

    
}


}
