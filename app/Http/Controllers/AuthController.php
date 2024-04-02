<?php

namespace App\Http\Controllers;

use App\Rules\LoginRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('template.auth.login');
    }

    public function login(Request $request)
    {
        $cek_login = $request->only('nik', 'password');
        if(Auth::attempt($cek_login)) {
            // return redirect()->intended('/home')->with('success', 'Selamat Datang !! Silahkan Lakukan Presensi.');
            $role = Auth::user()->role;
            if ($role == 'admin'){
                return redirect()->intended('/kehadiran')->with('success', 'Selamat Datang !! Silahkan Lakukan Analysa Performa.');
            }elseif ($role == 'keuangan'){
                return redirect()->intended('/daftar-hadir')->with('success', 'Selamat Datang !! Silahkan Lakukan Presensi Di Menu Home.');
            }elseif ($role == 'pegawai'){
                return redirect()->intended('/daftar-hadir')->with('success', 'Selamat Datang !! Silahkan Lakukan Presensi Di Menu Home.');
            }elseif($role == 'evaluator'){
                return redirect()->intended('/daftar-hadir')->with('success', 'Selamat Datang !! Silahkan Lakukan Presensi Di Menu Home.');
            }elseif($role == 'hrd'){
                return redirect()->intended('/daftar-hadir')->with('success', 'Selamat Datang !! Silahkan Lakukan Presensi Di Menu Home.');
            }
        }else{
            return redirect('/login')->with('error','ERORR !! Mohon Periksa Kembali NIP dan Password Anda.');
        }

        // return redirect('/home');
    }

    public function logout()
    {
        auth()->logout();
        Session::forget('face_verification_result');
        return redirect()->route('frontend')->with('success', 'Terimakasih Sudah Absen');
        // return redirect()->route('auth.index')->with('success', 'Terimakasih Sudah Absen');
    }
}
