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

class PenyuluhController extends Controller
{

public function index()
    {

        $pengantin = CalonPengantin::orderBy('id', 'DESC')->get();
        //$materi = MateriBimbingan::where('id_user_penyuluh',Auth::user()->id)->get();

        $materi = DB::table('materi_bimbingan')
        ->join('calon_pengantin' , 'materi_bimbingan.id_calon_pengantin', '=' , 'calon_pengantin.id')
        ->select('materi_bimbingan.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
        ->orderBy('materi_bimbingan.id','DESC')
        ->where('id_user_penyuluh', Auth::user()->id)
        ->get();

        return view('penyuluh.index',compact('materi','pengantin'));
    }

public function penyuluh_materi_add(Request $request){

   $data_add = new MateriBimbingan();

   $data_add->nama_materi = $request->input('nama_materi');
   $data_add->id_calon_pengantin = $request->input('id_calon_pengantin');
   $data_add->id_user_penyuluh = Auth::user()->id;
   $data_add->status = 1;




     $data_add->save();

     return redirect('/jadwal')->with('success', 'Data Jadwal Baru Berhasil Ditambahkan');
 }

 public function penyuluh_materi_update(Request $request, $id)
 {

  $data_update = MateriBimbingan::where('id', $id)->first();

  $input = [
   'nama_materi' => $request->nama_materi,
   



];

$data_update->update($input);

return redirect()->back()->with('success', 'Data Jadwal Berhasil Diupdate');
}


public function penyuluh_materi_delete($id)
{
  $delete = MateriBimbingan::findOrFail($id);
  $delete->delete();

  return  redirect()->back()->with('success', 'Data Jadwal Berhasil Dihapus');
}

//============================================================================================================================================

public function lihat_jadwal()
{

   $jadwal = DB::table('jadwal')
      ->join('penyuluh' , 'jadwal.id_user_penyuluh', '=' , 'penyuluh.id_user')
      ->join('calon_pengantin' , 'jadwal.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('jadwal.*','penyuluh.nama_pegawai','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
      ->orderBy('jadwal.id','DESC')
      ->where('id_user_penyuluh', Auth::user()->id)
      ->get();


    return view('penyuluh.lihat_jadwal',compact('jadwal'));
}


public function penyuluh_verifikasi_jadwal($id)
{

  $data_update = Jadwal::where('id', $id)->first();

  $input =([
            'status' => 1,
        ]);  

 $data_update->update($input);

 return redirect()->back()->with('success', 'Data Jadwal Berhasil Verifikasi');
}

}
