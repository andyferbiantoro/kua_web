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
use Carbon\Carbon;
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



public function penyuluh_selesaikan_bimbingan(Request $request, $id)
{
   $jadwal = Jadwal::where('id',$id)->first();
   $id_catin = CalonPengantin::where('id', $jadwal->id_calon_pengantin)->first();
   $count_sertifikat = Sertifikat::count();
   $tanggal_akhir = Carbon::now();


 //tambah sertifikat
   $data_add = new Sertifikat();

   $data_add->nomor = $count_sertifikat+1;
   $data_add->tanggal_awal = $jadwal->tanggal;
   $data_add->tanggal_akhir = $tanggal_akhir;
   $data_add->tanggal_terbit = $tanggal_akhir;
   $data_add->nama_kepala_kua = 'MUTAIN HAKIM, S.Ag, M.HI';
   $data_add->nip = '123123123213';
   $data_add->id_calon_pengantin = $id_catin->id;
   $data_add->status = 0 ;

   $data_add->save();

//ubah status_penyuluhan
   $data_update = Jadwal::where('id', $id)->first();

   $input =([
    'status_penyuluhan' => 1,
]);  

   $data_update->update($input);

// //upload bukti
 if ($file = $request->file('bukti_penyuluhan')) {
     if ($data_update->bukti_penyuluhan) {
        File::delete('uploads/bukti_penyuluhan/' . $data_update->bukti_penyuluhan);
    }
    $nama_file = $file->getClientOriginalName();
    $file->move(public_path() . '/uploads/bukti_penyuluhan/', $nama_file);
    $input['bukti_penyuluhan'] = $nama_file;
}

   $data_update->update($input);


 //return $catin;

return  redirect()->back()->with('success', 'Data Jadwal Berhasil Diselesaikan');
}

public function penyuluh_upload_bukti(Request $request, $id)
{

    
 $data_update = Jadwal::where('id',$id)->first();

  if ($file = $request->file('bukti_penyuluhan')) {
     if ($data_update->bukti_penyuluhan) {
        File::delete('uploads/bukti_penyuluhan/' . $data_update->bukti_penyuluhan);
    }
    $nama_file = $file->getClientOriginalName();
    $file->move(public_path() . '/uploads/bukti_penyuluhan/', $nama_file);
    $input['bukti_penyuluhan'] = $nama_file;
    }

    $data_update->update($input);

return  redirect()->back()->with('success', 'Bukti Penyuluhan Berhasil Diupload');
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

  $id_catin = Jadwal::where('id', $id)->pluck('id_calon_pengantin');
  $this->received($id_catin);

  return redirect()->back()->with('success', 'Data Jadwal Berhasil Verifikasi');
}


public function received($id_catin)
    {
        
        $catin= DB::table('calon_pengantin')
        ->join('users', 'calon_pengantin.id_user', '=', 'users.id')
        ->select('calon_pengantin.*','users.email')
        ->where('calon_pengantin.id', $id_catin)
        ->orderBy('calon_pengantin.id','DESC')
        ->first();

        //$catin = CalonPengantin::where('id',$id_catin)->first();

        $this->_sendEmail($catin);

    }

    public function _sendEmail($catin)
    {
        $message = new \App\Mail\CatinMail($catin);
        \Mail::to($catin->email)->send($message);
    }

}
