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

class KepalaKuaController extends Controller
{

  public function kepala_kua_lihat_sertifikat()
  {

    //$sertifikat = sertifikat::all();
    // $penyuluh = Penyuluh::all();
     //$pengantin = CalonPengantin::all();

    $sertifikat = DB::table('sertifikat')
    ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
    ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri')
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


  public function lihat_laporan(Request $request)
  {

    $from = $request->from;
    $to = $request->to;

    if ($from == null && $to == null) {
      $laporan = DB::table('jadwal')
      ->join('calon_pengantin' , 'jadwal.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('jadwal.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri')
      ->orderBy('jadwal.id','DESC')
      ->get();

      
    }else{
      $laporan = DB::table('jadwal')
      ->join('calon_pengantin' , 'jadwal.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('jadwal.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri')
      ->orderBy('jadwal.id','DESC')
      ->whereBetween('jadwal.tanggal', [$from, $to])
      ->get();
    }
    $jml_daftar = Jadwal::whereBetween('tanggal', [$from, $to])->count();
    $jml_terlaksana = Jadwal::where('status_penyuluhan','1')->whereBetween('tanggal', [$from, $to])->count();
    $jml_tdk_terlaksana = Jadwal::where('status_penyuluhan','0')->whereBetween('tanggal', [$from, $to])->count();

    return view('kepala_kua.laporan',compact('laporan','from','to','jml_daftar','jml_terlaksana','jml_tdk_terlaksana'));
  }


  public function kepala_kua_lihat_sertifikat_suami($id)
  {


    $sertifikat = DB::table('sertifikat')
    ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
    ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri')
    ->orderBy('sertifikat.id','DESC')
    ->where('sertifikat.id',$id)
    ->get();

    $cek_sertifikat = Sertifikat::where('id',$id)->first();

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

  return view('kepala_kua.lihat_sertifikat_suami',compact('sertifikat','detail_bimbingan'));
}

public function kepala_kua_lihat_sertifikat_istri($id)
{


  $sertifikat = DB::table('sertifikat')
  ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
  ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri')
  ->orderBy('sertifikat.id','DESC')
  ->where('sertifikat.id',$id)
  ->get();


  $cek_sertifikat = Sertifikat::where('id',$id)->first();

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

return view('kepala_kua.lihat_sertifikat_istri',compact('sertifikat','detail_bimbingan'));
}

}
