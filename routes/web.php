<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});


Route::get('/login', 'AuthController@login')->name('login');
Route::get('/register', 'AuthController@register')->name('register');


//proses register
Route::post('proses-register', 'AuthController@proses_register')->name('proses-register')->middleware('guest');

//proses login
Route::post('proses-login','AuthController@proses_login')->name('proses-login')->middleware('guest');


Route::group(['middleware' => ['auth', 'admin']],function(){
    Route::get('/admin', 'AdminController@index')->name('admin');


    Route::get('/calon_pengantin', 'AdminController@calon_pengantin')->name('calon_pengantin');
    Route::post('/calon_pengantin_add', 'AdminController@calon_pengantin_add')->name('calon_pengantin_add');
    Route::post('/calon_pengantin_update/{id}', 'AdminController@calon_pengantin_update')->name('calon_pengantin_update');
    Route::post('/calon_pengantin_delete/{id}', 'AdminController@calon_pengantin_delete')->name('calon_pengantin_delete');


    Route::get('/wali_nikah', 'AdminController@wali_nikah')->name('wali_nikah');
    Route::post('/wali_nikah_add', 'AdminController@wali_nikah_add')->name('wali_nikah_add');
    Route::post('/wali_nikah_update/{id}', 'AdminController@wali_nikah_update')->name('wali_nikah_update');
    Route::post('/wali_nikah_delete/{id}', 'AdminController@wali_nikah_delete')->name('wali_nikah_delete');



    Route::get('/kelola_penyuluh', 'AdminController@kelola_penyuluh')->name('kelola_penyuluh');
    Route::post('/kelola_penyuluh_add', 'AdminController@kelola_penyuluh_add')->name('kelola_penyuluh_add');
    Route::post('/kelola_penyuluh_update/{id}', 'AdminController@kelola_penyuluh_update')->name('kelola_penyuluh_update');
    Route::post('/kelola_penyuluh_delete/{id}', 'AdminController@kelola_penyuluh_delete')->name('kelola_penyuluh_delete');


    Route::get('/jadwal', 'AdminController@jadwal')->name('jadwal');
    Route::post('/jadwal_add', 'AdminController@jadwal_add')->name('jadwal_add');
    Route::post('/jadwal_update/{id}', 'AdminController@jadwal_update')->name('jadwal_update');
    Route::post('/jadwal_delete/{id}', 'AdminController@jadwal_delete')->name('jadwal_delete');


    Route::get('/sertifikat', 'AdminController@sertifikat')->name('sertifikat');
    Route::post('/sertifikat_add', 'AdminController@sertifikat_add')->name('sertifikat_add');
    Route::post('/sertifikat_update/{id}', 'AdminController@sertifikat_update')->name('sertifikat_update');
    Route::post('/sertifikat_delete/{id}', 'AdminController@sertifikat_delete')->name('sertifikat_delete');

    Route::get('/lihat_sertifikat_suami{id}', 'AdminController@lihat_sertifikat_suami')->name('lihat_sertifikat_suami');
    Route::get('/lihat_sertifikat_istri{id}', 'AdminController@lihat_sertifikat_istri')->name('lihat_sertifikat_istri');


    Route::get('/cetak_sertifikat_suami{id}', 'AdminController@cetak_sertifikat_suami')->name('cetak_sertifikat_suami');
    Route::get('/cetak_sertifikat_istri{id}', 'AdminController@cetak_sertifikat_istri')->name('cetak_sertifikat_istri');
   

    Route::get('/materi', 'AdminController@materi')->name('materi');

    Route::get('/laporan', 'AdminController@laporan')->name('laporan');
    
});


Route::group(['middleware' => ['auth', 'penyuluh']],function(){

    Route::get('/penyuluh', 'PenyuluhController@index')->name('penyuluh');
    Route::post('/penyuluh_materi_add', 'PenyuluhController@penyuluh_materi_add')->name('penyuluh_materi_add');
    Route::post('/penyuluh_materi_update/{id}', 'PenyuluhController@penyuluh_materi_update')->name('penyuluh_materi_update');
    Route::post('/penyuluh_materi_delete/{id}', 'PenyuluhController@penyuluh_materi_delete')->name('penyuluh_materi_delete');


    Route::get('/lihat_jadwal', 'PenyuluhController@lihat_jadwal')->name('lihat_jadwal');
    Route::post('/penyuluh_verifikasi_jadwal/{id}', 'PenyuluhController@penyuluh_verifikasi_jadwal')->name('penyuluh_verifikasi_jadwal');
});


Route::group(['middleware' => ['auth', 'calon_pengantin']],function(){

    Route::get('/catin_lihat_jadwal', 'CatinController@catin_lihat_jadwal')->name('catin_lihat_jadwal');

    Route::get('/sertifikat_catin_suami', 'CatinController@sertifikat_catin_suami')->name('sertifikat_catin_suami');
    Route::get('/catin_cetak_sertifikat_suami', 'CatinController@catin_cetak_sertifikat_suami')->name('catin_cetak_sertifikat_suami');

    Route::get('/sertifikat_catin_istri', 'CatinController@sertifikat_catin_istri')->name('sertifikat_catin_istri');
    Route::get('/catin_cetak_sertifikat_istri', 'CatinController@catin_cetak_sertifikat_istri')->name('catin_cetak_sertifikat_istri');

});



Route::group(['middleware' => ['auth', 'kepala_kua']],function(){

    Route::get('/kepala_kua_lihat_sertifikat', 'KepalaKuaController@kepala_kua_lihat_sertifikat')->name('kepala_kua_lihat_sertifikat');
    Route::post('/verifikasi_sertifikat/{id}', 'KepalaKuaController@verifikasi_sertifikat')->name('verifikasi_sertifikat');


    Route::get('/kepala_kua_lihat_sertifikat_suami{id}', 'KepalaKuaController@kepala_kua_lihat_sertifikat_suami')->name('kepala_kua_lihat_sertifikat_suami');
    Route::get('/kepala_kua_lihat_sertifikat_istri{id}', 'KepalaKuaController@kepala_kua_lihat_sertifikat_istri')->name('kepala_kua_lihat_sertifikat_istri');

    Route::get('/lihat_laporan', 'KepalaKuaController@lihat_laporan')->name('lihat_laporan');
});


Route::get('logout-admin', 'AuthController@logout')->name('logout-admin')->middleware(['admin', 'auth']);
Route::get('logout-penyuluh', 'AuthController@logout')->name('logout-penyuluh')->middleware(['penyuluh', 'auth']);
Route::get('logout-calon_pengantin', 'AuthController@logout')->name('logout-calon_pengantin')->middleware(['calon_pengantin', 'auth']);
Route::get('logout-kepala_kua', 'AuthController@logout')->name('logout-kepala_kua')->middleware(['kepala_kua', 'auth']);