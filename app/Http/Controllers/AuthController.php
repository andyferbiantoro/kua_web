<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function proses_login(Request $request){
        //remember
        $ingat = $request->remember ? true : false; //jika di ceklik true jika tidak gfalse
        //akan ingat selama 5 tahun jika tidak logout

        //auth()->attempt buat proses login  request input username dan password,  request input  sama kayak $request->password dan usernamenya, ditambah $ingat jika pengen ingat
        if(auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $ingat)){
            //auth->user() untuk memanggil data user yang sudah login
        if(auth()->user()->role == "admin"){
            return redirect()->route('admin')->with('success', 'Anda Berhasil Login');
        }else if(auth()->user()->role == "penyuluh"){
            return redirect()->route('penyuluh')->with('success', 'Anda Berhasil Login');
        }else if(auth()->user()->role == "calon_pengantin"){
            return redirect()->route('catin_lihat_jadwal')->with('success', 'Anda Berhasil Login');
        }else if(auth()->user()->role == "kepala_kua"){
            return redirect()->route('kepala_kua_lihat_sertifikat')->with('success', 'Anda Berhasil Login');
        }
    }else{
       
            return redirect()->route('login')->with('error', 'Email / Password anda salah'); //route itu isinya name dari route di web.php

        }
    }

    public function register()
    {
        return view('auth.register');
    }


    public function proses_register(Request $request){
        $messages = [
            'required' => ':attribute wajib diisi',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'same' => ':attribute harus sama dengan konfirmasi password',
        ];

            //validasi
        $this->validate($request, [
            //pasword validasinya repassword
            'password' => 'min:5|required_with:repassword|same:repassword',
            'repassword' => 'min:5'
        ], $messages);

        $cekemail = User::where('email', $request->email)->where('role','calon_pengantin')->first();

        if ($cekemail) {

            return redirect()->back()->with('error', 'Email Sudah Digunakan');
        }else{

         User::create([
            'email' => $request['email'],
            'role' => $request['role']="calon_pengantin",
            'password' => Hash::make($request['password']),
            
        ]);


         return redirect('/login')->with('success', 'Anda Berhasil Register, Silakan Login');
         }       
     }





     public function logout(){

        auth()->logout(); //logout
        
        return redirect()->route('login')->with('success', 'Anda Berhasil Logout');
        
    }
}
