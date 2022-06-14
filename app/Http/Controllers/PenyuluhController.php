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
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PenyuluhController extends Controller
{

    public function index()
    {

        $pengantin = CalonPengantin::orderBy('id', 'DESC')->get();
        $materi = MateriBimbingan::all();
        //$materi = MateriBimbingan::where('id_user_penyuluh',Auth::user()->id)->get();
        //$bimbingan = Bimbingan::orderBy('id','DESC')->get();
        $bimbingan = DB::table('bimbingan')
           ->join('calon_pengantin', 'bimbingan.id_calon_pengantin', '=', 'calon_pengantin.id')
           ->select('bimbingan.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
           ->orderBy('bimbingan.id','DESC')
           ->where('bimbingan.id_user_penyuluh',Auth::user()->id)
           ->get();

        foreach ($bimbingan as $key => $value) {
           $detail_bimbingan = DB::table('detail_bimbingan')
           ->join('bimbingan', 'detail_bimbingan.id_bimbingan', '=', 'bimbingan.id')
           ->join('materi_bimbingan', 'detail_bimbingan.id_materi_bimbingan', '=', 'materi_bimbingan.id')
           ->join('calon_pengantin', 'bimbingan.id_calon_pengantin', '=', 'calon_pengantin.id')
           ->select('materi_bimbingan.nama_materi','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
           ->where('id_bimbingan', $value->id)
           ->orderBy('detail_bimbingan.id','DESC')
           ->get();

            $list_nama_materi = collect($detail_bimbingan)->implode('nama_materi', ', ');
            $value->list_nama_materi =$list_nama_materi;
        }

        //return $bimbingan;
        // $data_bimbingan = DB::table('detail_bimbingan')
        // ->join('calon_pengantin' , 'materi_bimbingan.id_calon_pengantin', '=' , 'calon_pengantin.id')
        // ->select('materi_bimbingan.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
        // ->orderBy('materi_bimbingan.id','DESC')
        // ->where('id_user_penyuluh', Auth::user()->id)
        // ->get();

        return view('penyuluh.index',compact('materi','pengantin','bimbingan'));
    }

    public function penyuluh_materi_add(Request $request){

     
      $data = ([
      'id_calon_pengantin' => $request->id_calon_pengantin,
      'id_user_penyuluh' => $request->id_user_penyuluh,
      'status' => 1,


  ]);

    $lastid = Bimbingan::create($data)->id;


    foreach ($request->id_materi_bimbingan as $key => $value) {

      $data_detail = DetailBimbingan::create([
          'id_bimbingan' => $lastid,
          'id_materi_bimbingan' => $value,

      ]);
  }

     return redirect()->back()->with('success', 'Data materi Baru Berhasil Ditambahkan');
 }

 public function penyuluh_materi_update(Request $request, $id)
 {

   // $data_update = Bimbingan::where('id', $id)->first();

   //  $input = [
   //     'nama_personel' => $request->nama_personel,
   //     'hasil_sebelum' => $request->hasil_sebelum,
   //     'hasil_saat' => $request->hasil_saat,
   //     'hasil_setelah' => $request->hasil_setelah,
   // ];

   // $data_update->update($input);

   $delete = DetailBimbingan::where('id_bimbingan',$id);
   $delete->delete();

   foreach ($request->id_materi_bimbingan as $key => $value) {

      $data_detail = DetailBimbingan::create([
          'id_materi_bimbingan' => $value,
          'id_bimbingan' => $id,
      ]);
  }

 return redirect()->back()->with('success', 'Data Jadwal Berhasil Diupdate');
}


public function penyuluh_materi_delete($id)
{
  $detail_bimbingan = DetailBimbingan::where('id_bimbingan',$id)->get();
  foreach ($detail_bimbingan as $delete_detail) {
        $delete_detail->delete();
        
    }

    $delete = Bimbingan::findOrFail($id);
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
   $data_add->nip = '197501252000031001';
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
