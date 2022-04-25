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

    return view('admin.calon_pengantin.index',compact('catin'));
}



public function calon_pengantin_add(Request $request){


    $data = ([
      'email' => $request['email_calon_suami'],
      'role' => $request['role']="calon_pengantin",
      'password' => Hash::make($request['password']),

  ]);


    $lastid = User::create($data)->id;


    $data_add = CalonPengantin::create([
     'nik_calon_suami' => $request->nik_calon_suami,
     'nama_calon_suami' => $request->nama_calon_suami,
     'no_hp_calon_suami' => $request->no_hp_calon_suami,
     'email_calon_suami' => $request->email_calon_suami,
     'alamat_calon_suami' => $request->alamat_calon_suami,
     'ttl_calon_suami' => $request->ttl_calon_suami,
     'nik_calon_istri' => $request->nik_calon_istri,
     'nama_calon_istri' => $request->nama_calon_istri,
     'no_hp_calon_istri' => $request->no_hp_calon_istri,
     'email_calon_istri' => $request->email_calon_istri,
     'alamat_calon_istri' => $request->alamat_calon_istri,
     'ttl_calon_istri' => $request->ttl_calon_istri,
     'tanggal_rencana_menikah' => $request->tanggal_rencana_menikah,
     'id_user' => $lastid,
     

      ]);


   // $data_add = new CalonPengantin();

   // $data_add->nik_calon_suami = $request->input('nik_calon_suami');
   // $data_add->nama_calon_suami = $request->input('nama_calon_suami');
   // $data_add->no_hp_calon_suami = $request->input('no_hp_calon_suami');
   // $data_add->email_calon_suami = $request->input('email_calon_suami');
   // $data_add->alamat_calon_suami = $request->input('alamat_calon_suami');
   // $data_add->ttl_calon_suami = $request->input('ttl_calon_suami');
   // $data_add->nik_calon_istri = $request->input('nik_calon_istri');
   // $data_add->nama_calon_istri = $request->input('nama_calon_istri');
   // $data_add->no_hp_calon_istri = $request->input('no_hp_calon_istri');
   // $data_add->email_calon_istri = $request->input('email_calon_istri');
   // $data_add->alamat_calon_istri = $request->input('alamat_calon_istri');
   // $data_add->ttl_calon_istri = $request->input('ttl_calon_istri');
   // $data_add->tanggal_rencana_menikah = $request->input('tanggal_rencana_menikah');

  
   // $data_add->save();

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
     'ttl_calon_suami' => $request->ttl_calon_suami,
     'nik_calon_istri' => $request->nik_calon_istri,
     'nama_calon_istri' => $request->nama_calon_istri,
     'no_hp_calon_istri' => $request->no_hp_calon_istri,
     'email_calon_istri' => $request->email_calon_istri,
     'alamat_calon_istri' => $request->alamat_calon_istri,
     'ttl_calon_istri' => $request->ttl_calon_istri,
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

    return view('admin.wali_nikah.index',compact('wali_nikah'));
}



public function wali_nikah_add(Request $request){

   $data_add = new WaliNikah();

   $data_add->nama_lengkap = $request->input('nama_lengkap');
   $data_add->ttl = $request->input('ttl');
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
     'ttl' => $request->ttl,
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

    return view('admin.penyuluh.index',compact('penyuluh'));
}



public function kelola_penyuluh_add(Request $request){


    $data = ([
      'email' => $request['alamat_email'],
      'role' => $request['role']="penyuluh",
      'password' => Hash::make($request['password']),

  ]);


    $lastid = User::create($data)->id;

    $data_add = Penyuluh::create([
     'jenis_penyuluh' => $request->jenis_penyuluh,
     'nik_penyuluh' => $request->nik_penyuluh,
     'nama_pegawai' => $request->nama_pegawai,
     'gelar_depan' => $request->gelar_depan,
     'gelar_belakang' => $request->gelar_belakang,
     'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
     'jenis_kelamin' => $request->jenis_kelamin,
     'agama' => $request->agama,
     'status_keluarga' => $request->status_keluarga,
     'pendidikan_formal' => $request->pendidikan_formal,
     'bidang_keahlian' => $request->bidang_keahlian,
     'unit_kerja' => $request->unit_kerja,
     'tempat_tugas' => $request->tempat_tugas,
     'wilayah_kerja' => $request->wilayah_kerja,
     'diklat_fungsional' => $request->diklat_fungsional,
     'jenjang_jabatan' => $request->jenjang_jabatan,
     'tanggal_sk_cpns' => $request->tanggal_sk_cpns,
     'masa_kerja_berdasarkan_skpp' => $request->masa_kerja_berdasarkan_skpp,
     'alamat_rumah' => $request->alamat_rumah,
     'kabupaten' => $request->kabupaten,
     'provinsi' => $request->provinsi,
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
     'jenis_penyuluh' => $request->jenis_penyuluh,
     'nik_penyuluh' => $request->nik_penyuluh,
     'nama_pegawai' => $request->nama_pegawai,
     'gelar_depan' => $request->gelar_depan,
     'gelar_belakang' => $request->gelar_belakang,
     'tempat_tanggal_lahir' => $request->tempat_tanggal_lahir,
     'jenis_kelamin' => $request->jenis_kelamin,
     'agama' => $request->agama,
     'status_keluarga' => $request->status_keluarga,
     'pendidikan_formal' => $request->pendidikan_formal,
     'bidang_keahlian' => $request->bidang_keahlian,
     'unit_kerja' => $request->unit_kerja,
     'tempat_tugas' => $request->tempat_tugas,
     'wilayah_kerja' => $request->wilayah_kerja,
     'diklat_fungsional' => $request->diklat_fungsional,
     'jenjang_jabatan' => $request->jenjang_jabatan,
     'tanggal_sk_cpns' => $request->tanggal_sk_cpns,
     'masa_kerja_berdasarkan_skpp' => $request->masa_kerja_berdasarkan_skpp,
     'alamat_rumah' => $request->alamat_rumah,
     'kabupaten' => $request->kabupaten,
     'provinsi' => $request->provinsi,
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
      ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.ttl_calon_suami','calon_pengantin.ttl_calon_istri')
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


    return view('admin.sertifikat.sertifikat_suami',compact('sertifikat','materi'));
}

public function lihat_sertifikat_istri($id)
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


    return view('admin.sertifikat.sertifikat_istri',compact('sertifikat','materi'));
}



public function cetak_sertifikat_suami($id)
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

//return $sertifikat;
  view()->share('sertifikat', $sertifikat);
  view()->share('materi', $materi);
  
  $pdf = PDF::loadview('admin.sertifikat.cetak.cetak_sertifikat_suami', ['sertifikat' => $sertifikat],['materi' => $materi])->setPaper('A4','landscape');

  return $pdf->stream('sertifikat_suami.pdf');

    
}

public function cetak_sertifikat_istri($id)
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

//return $sertifikat;
  view()->share('sertifikat', $sertifikat);
  view()->share('materi', $materi);

  $pdf = PDF::loadview('admin.sertifikat.cetak.cetak_sertifikat_istri', ['sertifikat' => $sertifikat],['materi' => $materi])->setPaper('A4','landscape');

  return $pdf->stream('sertifikat_istri.pdf');

    
}

//===================================================================================================================================

public function materi()
   {

      $materi = DB::table('materi_bimbingan')
      ->join('penyuluh' , 'materi_bimbingan.id_user_penyuluh', '=' , 'penyuluh.id_user')
      ->join('calon_pengantin' , 'materi_bimbingan.id_calon_pengantin', '=' , 'calon_pengantin.id')
      ->select('materi_bimbingan.*','penyuluh.nama_pegawai','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri')
      ->orderBy('materi_bimbingan.id','DESC')
      ->get();

     // return $materi;
    return view('admin.materi.index',compact('materi'));
}


public function laporan()
   {

      $laporan = DB::table('sertifikat')
     ->join('calon_pengantin' , 'sertifikat.id_calon_pengantin', '=' , 'calon_pengantin.id')
     ->select('sertifikat.*','calon_pengantin.nama_calon_suami','calon_pengantin.nama_calon_istri','calon_pengantin.nik_calon_suami','calon_pengantin.nik_calon_istri','calon_pengantin.alamat_calon_suami','calon_pengantin.alamat_calon_istri')
     ->orderBy('sertifikat.id','DESC')
     ->get();

    return view('admin.laporan.index',compact('laporan'));
}


}
