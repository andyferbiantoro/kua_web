<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CalonPengantin;
use App\WaliNikah;
use App\Penyuluh;
use App\Jadwal;
use App\Sertifikat;
use App\MateriBimbingan;
use App\Bimbingan;
use App\DetailBimbingan;
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


public function sertifikat_catin_suami()
  {


   $sertifikat = DB::table('sertifikat')
   ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
   ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri')
   ->orderBy('sertifikat.id','DESC')
   ->where('calon_pengantin.id_user',  Auth::user()->id)
   ->where('sertifikat.status', 1)
   ->get();
   

   $cek_pengantin = CalonPengantin::where('id_user',Auth::user()->id)->first();
   $cek_sertifikat = Sertifikat::where('id_calon_pengantin',$cek_pengantin->id)->first();

  if ($cek_sertifikat) {
    $materi_bimbingan = Bimbingan::where('id_calon_pengantin',$cek_sertifikat->id_calon_pengantin)->get();
  }else{
    $materi_bimbingan = Bimbingan::where('id',0)->get();
  }

  if ($cek_sertifikat) {
        // code...
   foreach ($materi_bimbingan as $key => $value) {
     $detail_bimbingan = DB::table('detail_bimbingan')
     ->join('bimbingan', 'detail_bimbingan.id_bimbingan', '=', 'bimbingan.id')
     ->join('materi_bimbingan', 'detail_bimbingan.id_materi_bimbingan', '=', 'materi_bimbingan.id')
     ->join('calon_pengantin', 'bimbingan.id_calon_pengantin', '=', 'calon_pengantin.id')
     ->select('materi_bimbingan.nama_materi','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
     ->where('id_bimbingan', $value->id)
     ->orderBy('detail_bimbingan.id','DESC')
     ->get();

   }
 }else{
  $detail_bimbingan = DetailBimbingan::where('id',0)->get();
}


   return view('catin.sertifikat_catin_suami',compact('sertifikat','detail_bimbingan'));
}


public function sertifikat_catin_istri()
  {


   $sertifikat = DB::table('sertifikat')
   ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
   ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri')
   ->orderBy('sertifikat.id','DESC')
   ->where('calon_pengantin.id_user',  Auth::user()->id)
   ->where('sertifikat.status', 1)
   ->get();
   

   $cek_pengantin = CalonPengantin::where('id_user',Auth::user()->id)->first();

   $cek_sertifikat = Sertifikat::where('id_calon_pengantin',$cek_pengantin->id)->first();

   //return $cek_sertifikat;
   if ($cek_sertifikat) {
    $materi_bimbingan = Bimbingan::where('id_calon_pengantin',$cek_sertifikat->id_calon_pengantin)->get();
  }else{
    $materi_bimbingan = Bimbingan::where('id',0)->get();
  }

  if ($cek_sertifikat) {
        // code...
   foreach ($materi_bimbingan as $key => $value) {
     $detail_bimbingan = DB::table('detail_bimbingan')
     ->join('bimbingan', 'detail_bimbingan.id_bimbingan', '=', 'bimbingan.id')
     ->join('materi_bimbingan', 'detail_bimbingan.id_materi_bimbingan', '=', 'materi_bimbingan.id')
     ->join('calon_pengantin', 'bimbingan.id_calon_pengantin', '=', 'calon_pengantin.id')
     ->select('materi_bimbingan.nama_materi','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
     ->where('id_bimbingan', $value->id)
     ->orderBy('detail_bimbingan.id','DESC')
     ->get();

   }
 }else{
  $detail_bimbingan = DetailBimbingan::where('id',0)->get();
}

   return view('catin.sertifikat_catin_istri',compact('sertifikat','detail_bimbingan'));
}


public function catin_cetak_sertifikat_suami()
{

  $sertifikat = DB::table('sertifikat')
      ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri')
      ->orderBy('sertifikat.id','DESC')
      ->where('calon_pengantin.id_user',  Auth::user()->id)
      ->where('sertifikat.status', 1)
      ->get();


      $cek_pengantin = CalonPengantin::where('id_user',Auth::user()->id)->first();
      $cek_sertifikat = Sertifikat::where('id_calon_pengantin',$cek_pengantin->id)->first();

       if ($cek_sertifikat) {
    $materi_bimbingan = Bimbingan::where('id_calon_pengantin',$cek_sertifikat->id_calon_pengantin)->get();
  }else{
    $materi_bimbingan = Bimbingan::where('id',0)->get();
  }

  if ($cek_sertifikat) {
        // code...
   foreach ($materi_bimbingan as $key => $value) {
     $detail_bimbingan = DB::table('detail_bimbingan')
     ->join('bimbingan', 'detail_bimbingan.id_bimbingan', '=', 'bimbingan.id')
     ->join('materi_bimbingan', 'detail_bimbingan.id_materi_bimbingan', '=', 'materi_bimbingan.id')
     ->join('calon_pengantin', 'bimbingan.id_calon_pengantin', '=', 'calon_pengantin.id')
     ->select('materi_bimbingan.nama_materi','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
     ->where('id_bimbingan', $value->id)
     ->orderBy('detail_bimbingan.id','DESC')
     ->get();

   }
 }else{
  $detail_bimbingan = DetailBimbingan::where('id',0)->get();
}

//return $sertifikat;
      view()->share('sertifikat', $sertifikat);
      view()->share('detail_bimbingan', $detail_bimbingan);


  $pdf = PDF::loadview('catin.cetak_sertifikat_suami', ['sertifikat' => $sertifikat],['detail_bimbingan' => $detail_bimbingan])->setPaper('A4','landscape');

  return $pdf->stream('sertifikat_suami.pdf');

    
}

public function catin_cetak_sertifikat_istri()
{

  $sertifikat = DB::table('sertifikat')
      ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri')
      ->orderBy('sertifikat.id','DESC')
      ->where('calon_pengantin.id_user',  Auth::user()->id)
      ->where('sertifikat.status', 1)
      ->get();


      $cek_pengantin = CalonPengantin::where('id_user',Auth::user()->id)->first();
      $cek_sertifikat = Sertifikat::where('id_calon_pengantin',$cek_pengantin->id)->first();

       if ($cek_sertifikat) {
    $materi_bimbingan = Bimbingan::where('id_calon_pengantin',$cek_sertifikat->id_calon_pengantin)->get();
  }else{
    $materi_bimbingan = Bimbingan::where('id',0)->get();
  }

  if ($cek_sertifikat) {
        // code...
   foreach ($materi_bimbingan as $key => $value) {
     $detail_bimbingan = DB::table('detail_bimbingan')
     ->join('bimbingan', 'detail_bimbingan.id_bimbingan', '=', 'bimbingan.id')
     ->join('materi_bimbingan', 'detail_bimbingan.id_materi_bimbingan', '=', 'materi_bimbingan.id')
     ->join('calon_pengantin', 'bimbingan.id_calon_pengantin', '=', 'calon_pengantin.id')
     ->select('materi_bimbingan.nama_materi','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
     ->where('id_bimbingan', $value->id)
     ->orderBy('detail_bimbingan.id','DESC')
     ->get();

   }
 }else{
  $detail_bimbingan = DetailBimbingan::where('id',0)->get();
}

//return $sertifikat;
      view()->share('sertifikat', $sertifikat);
      view()->share('detail_bimbingan', $detail_bimbingan);


  $pdf = PDF::loadview('catin.cetak_sertifikat_istri', ['sertifikat' => $sertifikat],['detail_bimbingan' => $detail_bimbingan])->setPaper('A4','landscape');

  return $pdf->stream('sertifikat_istri.pdf');

    
}


}
