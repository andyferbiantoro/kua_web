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
use App\Cities;
use App\Provinces;
use Auth;
use File;
use PDF;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

   public function index()
   {

    return view('admin.index');
}


public function calon_pengantin()
   {

    $catin = CalonPengantin::orderBy('id','DESC')->get();

    $cities = Cities::orderBy('city_name','ASC')->get();
    $provinces = Provinces::all();


    return view('admin.calon_pengantin.index',compact('catin','provinces','cities'));
}



public function calon_pengantin_add(Request $request){


    $data = ([
      'email' => $request['email_calon_suami'],
      'role' => $request['role']="calon_pengantin",
      'password' => Hash::make($request['password']),

  ]);


    $lastid = User::create($data)->id;

    $cekemail = User::where('email', $request->email)->first();

    if ($cekemail) {
         return redirect()->back()->with('error', 'Data Jadwal Sudah Ditambahkan');
    }else{

     $data_add = new CalonPengantin();

     $data_add->nik_calon_suami = $request->input('nik_calon_suami');
     $data_add->nama_calon_suami = $request->input('nama_calon_suami');
     $data_add->no_hp_calon_suami = $request->input('no_hp_calon_suami');
     $data_add->email_calon_suami = $request->input('email_calon_suami');
     $data_add->alamat_calon_suami = $request->input('alamat_calon_suami');
     $data_add->nik_calon_istri = $request->input('nik_calon_istri');
     $data_add->nama_calon_istri = $request->input('nama_calon_istri');
     $data_add->no_hp_calon_istri = $request->input('no_hp_calon_istri');
     $data_add->email_calon_istri = $request->input('email_calon_istri');
     $data_add->alamat_calon_istri = $request->input('alamat_calon_istri');
     $data_add->tempat_lahir_calon_suami = $request->input('tempat_lahir_calon_suami');
     $data_add->tempat_lahir_calon_istri = $request->input('tempat_lahir_calon_istri');
     $data_add->tanggal_lahir_calon_suami = $request->input('tanggal_lahir_calon_suami');
     $data_add->tanggal_lahir_calon_istri = $request->input('tanggal_lahir_calon_istri');
     $data_add->tanggal_rencana_menikah = $request->input('tanggal_rencana_menikah');
     $data_add->id_user = $lastid;

           
          
        if($request->hasFile('foto_calon_suami')){
            $file = $request->file('foto_calon_suami');
            $filename = $file->getClientOriginalName();
            $file->move('uploads/foto_calon_suami/', $filename);
            $data_add->foto_calon_suami = $filename;


        }else{
            echo "Gagal upload gambar";
        }


         if($request->hasFile('foto_calon_istri')){
            $file = $request->file('foto_calon_istri');
            $filename = $file->getClientOriginalName();
            $file->move('uploads/foto_calon_istri/', $filename);
            $data_add->foto_calon_istri = $filename;


        }else{
            echo "Gagal upload gambar";
        }
          
    $data_add->save();
    
    }
   

   return redirect('/calon_pengantin')->with('success', 'Data calon pengantin Baru Berhasil Ditambahkan');
}

public function calon_pengantin_update(Request $request, $id)
{

  $data_update = CalonPengantin::where('id', $id)->first();

  $input = [
     'nik_calon_suami' => $request->nik_calon_suami,
     'nama_calon_suami' => $request->nama_calon_suami,
     'no_hp_calon_suami' => $request->no_hp_calon_suami,
     'email_calon_suami' => $request->email_calon_suami,
     'alamat_calon_suami' => $request->alamat_calon_suami,
     'nik_calon_istri' => $request->nik_calon_istri,
     'nama_calon_istri' => $request->nama_calon_istri,
     'no_hp_calon_istri' => $request->no_hp_calon_istri,
     'email_calon_istri' => $request->email_calon_istri,
     'alamat_calon_istri' => $request->alamat_calon_istri,
     'tempat_lahir_calon_suami' => $request->tempat_lahir_calon_suami,
     'tempat_lahir_calon_istri' => $request->tempat_lahir_calon_istri,
     'tanggal_lahir_calon_suami' => $request->tanggal_lahir_calon_suami,
     'tanggal_lahir_calon_istri' => $request->tanggal_lahir_calon_istri,
     'tanggal_rencana_menikah' => $request->tanggal_rencana_menikah,

  ];

   $data_update->update($input);

   return redirect('/calon_pengantin')->with('success', 'Data calon pengantin Berhasil Diupdate');
}


public function calon_pengantin_delete($id)
{
  $delete = CalonPengantin::findOrFail($id);
  $delete->delete();

  return redirect('/calon_pengantin')->with('success', 'Data calon pengantin Berhasil Dihapus');
}

//==================================================================================================================================

public function wali_nikah()
   {

    $wali_nikah = WaliNikah::all();
    $cities = Cities::orderBy('city_name','ASC')->get();


    return view('admin.wali_nikah.index',compact('wali_nikah','cities'));
}



public function wali_nikah_add(Request $request){

   $data_add = new WaliNikah();

   $data_add->nama_lengkap = $request->input('nama_lengkap');
   $data_add->tempat_lahir = $request->input('tempat_lahir');
   $data_add->tanggal_lahir = $request->input('tanggal_lahir');
   $data_add->nik = $request->input('nik');
   $data_add->kewarganegaraan = $request->input('kewarganegaraan');
   $data_add->agama = $request->input('agama');
   $data_add->pekerjaan = $request->input('pekerjaan');
   $data_add->alamat = $request->input('alamat');
   $data_add->id_calon_pengantin = $request->input('id_calon_pengantin');
  

  
   $data_add->save();

   return redirect('/wali_nikah')->with('success', 'Data wali nikah Baru Berhasil Ditambahkan');
}

public function wali_nikah_update(Request $request, $id)
{

  $data_update = WaliNikah::where('id', $id)->first();

  $input = [
     'nama_lengkap' => $request->nama_lengkap,
     'tempat_lahir' => $request->tempat_lahir,
     'tanggal_lahir' => $request->tanggal_lahir,
     'nik' => $request->nik,
     'kewarganegaraan' => $request->kewarganegaraan,
     'agama' => $request->agama,
     'pekerjaan' => $request->pekerjaan,
     'alamat' => $request->alamat,
     'id_calon_pengantin' => $request->id_calon_pengantin,
    

  ];

   $data_update->update($input);

   return redirect('/wali_nikah')->with('success', 'Data wali nikah Berhasil Diupdate');
}


public function wali_nikah_delete($id)
{
  $delete = WaliNikah::findOrFail($id);
  $delete->delete();

  return redirect('/wali_nikah')->with('success', 'Data wali nikah Berhasil Dihapus');
}


//==============================================================================================================================

public function kelola_penyuluh()
   {

    $penyuluh = Penyuluh::all();
    $cities = Cities::orderBy('city_name','ASC')->get();

    return view('admin.penyuluh.index',compact('penyuluh','cities'));
}



public function kelola_penyuluh_add(Request $request){


    $data = ([
      'email' => $request['alamat_email'],
      'role' => $request['role']="penyuluh",
      'password' => Hash::make($request['password']),

  ]);


    $lastid = User::create($data)->id;

    $data_add = Penyuluh::create([
     'nik_penyuluh' => $request->nik_penyuluh,
     'nama_pegawai' => $request->nama_pegawai,
     'tempat_lahir' => $request->tempat_lahir,
     'tanggal_lahir' => $request->tanggal_lahir,
     'jenis_kelamin' => $request->jenis_kelamin,
     'agama' => $request->agama,
     'pendidikan_formal' => $request->pendidikan_formal,
     'alamat_rumah' => $request->alamat_rumah,
     'no_telp' => $request->no_telp,
     'alamat_email' => $request->alamat_email,
     'id_user' => $lastid,

      ]);




   return redirect('/penyuluh')->with('success', 'Data penyuluh Baru Berhasil Ditambahkan');
}


public function kelola_penyuluh_update(Request $request, $id)
{

  $data_update = Penyuluh::where('id', $id)->first();

  $input = [
     'nik_penyuluh' => $request->nik_penyuluh,
     'nama_pegawai' => $request->nama_pegawai,
     'tempat_lahir' => $request->tempat_lahir,
     'tanggal_lahir' => $request->tanggal_lahir,
     'jenis_kelamin' => $request->jenis_kelamin,
     'agama' => $request->agama,
     'pendidikan_formal' => $request->pendidikan_formal,
     'alamat_rumah' => $request->alamat_rumah,
     'no_telp' => $request->no_telp,
     'alamat_email' => $request->alamat_email,
     'id_user' => $request->id_user,
     
    

  ];

   $data_update->update($input);

   return redirect('/penyuluh')->with('success', 'Data penyuluh Berhasil Diupdate');
}


public function kelola_penyuluh_delete($id)
{
  $delete = Penyuluh::findOrFail($id);
  $delete->delete();

  return redirect('/penyuluh')->with('success', 'Data penyuluh Berhasil Dihapus');
}


//============================================================================================================================

public function jadwal()
   {

    //$jadwal = Jadwal::all();
    $penyuluh = Penyuluh::all();
    $pengantin = CalonPengantin::all();

    $jadwal = DB::table('jadwal')
      ->join('penyuluh' , 'jadwal.id_user_penyuluh', '=' , 'penyuluh.id_user')
      ->join('calon_pengantin' , 'jadwal.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('jadwal.*','penyuluh.nama_pegawai','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
      ->orderBy('jadwal.id','DESC')
      ->get();

    return view('admin.jadwal.index',compact('jadwal','penyuluh','pengantin'));
}



public function jadwal_add(Request $request){


        $cekjadwal = Jadwal::where('id_calon_pengantin', $request->id_calon_pengantin)->first();
        // $cekjadwal_selesai = Jadwal::where('id_calon_pengantin', $request->id_calon_pengantin)->where('status_selesai','1')->first();

        if ($cekjadwal) {

            return redirect()->back()->with('error', 'Data Jadwal Sudah Ditambahkan');

       }else{    
           $data_add = new Jadwal();

           $data_add->id_user_penyuluh = $request->input('id_user_penyuluh');
           $data_add->id_calon_pengantin = $request->input('id_calon_pengantin');
           $data_add->tanggal = $request->input('tanggal');
           $data_add->jam = $request->input('jam');
           $data_add->lokasi = $request->input('lokasi');
           $data_add->status = 0 ;
          
           $data_add->save();

   return redirect('/jadwal')->with('success', 'Data Jadwal Baru Berhasil Ditambahkan');
    }
}

public function jadwal_update(Request $request, $id)
{

  $data_update = Jadwal::where('id', $id)->first();

  $input = [
     'id_user_penyuluh' => $request->id_user_penyuluh,
     'id_calon_pengantin' => $request->id_calon_pengantin,
     'tanggal' => $request->tanggal,
     'jam' => $request->jam,
     'lokasi' => $request->lokasi,
    
    

  ];

   $data_update->update($input);

   return redirect('/jadwal')->with('success', 'Data Jadwal Berhasil Diupdate');
}


public function jadwal_delete($id)
{
  $delete = Jadwal::findOrFail($id);
  $delete->delete();

  return redirect('/jadwal')->with('success', 'Data Jadwal Berhasil Dihapus');
}


//===========================================================================================================================================


public function sertifikat()
   {

    //$sertifikat = sertifikat::all();
    // $penyuluh = Penyuluh::all();
    $pengantin = CalonPengantin::all();

    $sertifikat = DB::table('sertifikat')
      ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri')
      ->orderBy('sertifikat.id','DESC')
      ->get();

    return view('admin.sertifikat.index',compact('sertifikat','pengantin'));
}



public function sertifikat_add(Request $request){

   $data_add = new Sertifikat();

   $data_add->nomor = $request->input('nomor');
   $data_add->tanggal_awal = $request->input('tanggal_awal');
   $data_add->tanggal_akhir = $request->input('tanggal_akhir');
   $data_add->tanggal_terbit = $request->input('tanggal_terbit');
   $data_add->nama_kepala_kua = $request->input('nama_kepala_kua');
   $data_add->nip = $request->input('nip');
   $data_add->id_calon_pengantin = $request->input('id_calon_pengantin');
   $data_add->status = 0 ;

   if($request->hasFile('foto_calon_suami')){
        $file = $request->file('foto_calon_suami');
        $filename = $file->getClientOriginalName();
        $file->move('uploads/foto_calon_suami/', $filename);
        $data_add->foto_calon_suami = $filename;


    }else{
        echo "Gagal upload gambar";
    }


     if($request->hasFile('foto_calon_istri')){
        $file = $request->file('foto_calon_istri');
        $filename = $file->getClientOriginalName();
        $file->move('uploads/foto_calon_istri/', $filename);
        $data_add->foto_calon_istri = $filename;


    }else{
        echo "Gagal upload gambar";
    }
  
   $data_add->save();

   return redirect('/sertifikat')->with('success', 'Data sertifikat Baru Berhasil Ditambahkan');
}

public function sertifikat_update(Request $request, $id)
{

  $data_update = Sertifikat::where('id', $id)->first();

  $input = [
     'nomor' => $request->nomor,
     'tanggal_awal' => $request->tanggal_awal,
     'tanggal_akhir' => $request->tanggal_akhir,
     'tanggal_terbit' => $request->tanggal_terbit,
     'nama_kepala_kua' => $request->nama_kepala_kua,
     'nip' => $request->nip,
     'id_calon_pengantin' => $request->id_calon_pengantin,
     
  ];

  if ($file = $request->file('foto_calon_suami')) {
     if ($data_update->foto_calon_suami) {
        File::delete('uploads/foto_calon_suami/' . $data_update->foto_calon_suami);
    }
    $nama_file = $file->getClientOriginalName();
    $file->move(public_path() . '/uploads/foto_calon_suami/', $nama_file);
    $input['foto_calon_suami'] = $nama_file;
}

 if ($file = $request->file('foto_calon_istri')) {
     if ($data_update->foto_calon_istri) {
        File::delete('uploads/foto_calon_istri/' . $data_update->foto_calon_istri);
    }
    $nama_file = $file->getClientOriginalName();
    $file->move(public_path() . '/uploads/foto_calon_istri/', $nama_file);
    $input['foto_calon_istri'] = $nama_file;
}

   $data_update->update($input);

   return redirect('/sertifikat')->with('success', 'Data sertifikat Berhasil Diupdate');
}


public function sertifikat_delete($id)
{
  $delete = sertifikat::findOrFail($id);
  $delete->delete();

  return redirect('/sertifikat')->with('success', 'Data Sertifikat Berhasil Dihapus');
}


public function lihat_sertifikat_suami($id)
   {


    $sertifikat = DB::table('sertifikat')
      ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri')
      ->orderBy('sertifikat.id','DESC')
      ->where('sertifikat.id',$id)
      ->get();

       $cek_sertifikat = Sertifikat::where('id',$id)->first();
    
       $materi_bimbingan = Bimbingan::where('id_calon_pengantin',$cek_sertifikat->id_calon_pengantin)->get();

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


    return view('admin.sertifikat.sertifikat_suami',compact('sertifikat','detail_bimbingan'));
}

public function lihat_sertifikat_istri($id)
   {


    $sertifikat = DB::table('sertifikat')
      ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri')
      ->orderBy('sertifikat.id','DESC')
      ->where('sertifikat.id',$id)
      ->get();


      $cek_sertifikat = Sertifikat::where('id',$id)->first();
      

      $materi_bimbingan = Bimbingan::where('id_calon_pengantin',$cek_sertifikat->id_calon_pengantin)->get();

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
        //eturn $detail_bimbingan;


    return view('admin.sertifikat.sertifikat_istri',compact('sertifikat','detail_bimbingan'));
}



public function cetak_sertifikat_suami($id)
{

  $sertifikat = DB::table('sertifikat')
      ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri')
      ->orderBy('sertifikat.id','DESC')
      ->where('sertifikat.id',$id)
      ->get();

      $cek_sertifikat = Sertifikat::where('id',$id)->first();

       $materi_bimbingan = Bimbingan::where('id_calon_pengantin',$cek_sertifikat->id_calon_pengantin)->get();

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

//return $sertifikat;
  view()->share('sertifikat', $sertifikat);
  view()->share('detail_bimbingan', $detail_bimbingan);
  
  $pdf = PDF::loadview('admin.sertifikat.cetak.cetak_sertifikat_suami', ['sertifikat' => $sertifikat],['detail_bimbingan' => $detail_bimbingan])->setPaper('A4','landscape');

  return $pdf->stream('sertifikat_suami.pdf');

    
}

public function cetak_sertifikat_istri($id)
{

  $sertifikat = DB::table('sertifikat')
      ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.tempat_lahir_calon_suami','calon_pengantin.tempat_lahir_calon_istri','calon_pengantin.tanggal_lahir_calon_suami','calon_pengantin.tanggal_lahir_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri','calon_pengantin.foto_calon_suami','calon_pengantin.foto_calon_istri')
      ->orderBy('sertifikat.id','DESC')
      ->where('sertifikat.id',$id)
      ->get();

      $cek_sertifikat = Sertifikat::where('id',$id)->first();

       $materi_bimbingan = Bimbingan::where('id_calon_pengantin',$cek_sertifikat->id_calon_pengantin)->get();

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

//return $sertifikat;
  view()->share('sertifikat', $sertifikat);
  view()->share('detail_bimbingan', $detail_bimbingan);

  $pdf = PDF::loadview('admin.sertifikat.cetak.cetak_sertifikat_istri', ['sertifikat' => $sertifikat],['detail_bimbingan' => $detail_bimbingan])->setPaper('A4','landscape');

  return $pdf->stream('sertifikat_istri.pdf');

    
}

//===================================================================================================================================

public function materi()
   {

      // $materi = DB::table('materi_bimbingan')
      // ->join('penyuluh' , 'materi_bimbingan.id_user_penyuluh', '=' , 'penyuluh.id_user')
      // ->join('calon_pengantin' , 'materi_bimbingan.id_calon_pengantin', '=' , 'calon_pengantin.id')
      // ->select('materi_bimbingan.*','penyuluh.nama_pegawai','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
      // ->orderBy('materi_bimbingan.id','DESC')
      // ->get();

      $bimbingan = DB::table('bimbingan')
           ->join('calon_pengantin', 'bimbingan.id_calon_pengantin', '=', 'calon_pengantin.id')
           ->join('penyuluh', 'bimbingan.id_user_penyuluh', '=', 'penyuluh.id_user')
           ->select('bimbingan.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','penyuluh.nama_pegawai')
           ->orderBy('bimbingan.id','DESC')
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
   
    return view('admin.materi.index',compact('bimbingan'));
}


public function laporan(Request $request) 
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

    return view('admin.laporan.index',compact('laporan','from','to','jml_daftar','jml_terlaksana','jml_tdk_terlaksana'));
}


}
