<?php

namespace App\Http\Controllers;

use App\Rules\LoginRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
                return redirect()->intended('/statis')->with('success', 'Selamat Datang !! Silahkan Lakukan Analysa Performa.');
            }elseif ($role == 'keuangan'){
                return redirect()->intended('/biznet')->with('success', 'Selamat Datang !! Silahkan Lakukan Presensi.');
            }elseif ($role == 'pegawai'){
                return redirect()->intended('/biznet')->with('success', 'Selamat Datang !! Silahkan Lakukan Presensi.');
            }elseif($role == 'evaluator'){
                return redirect()->intended('/biznet')->with('success', 'Selamat Datang !! Silahkan Lakukan Presensi.');
            }elseif($role == 'hrd'){
                return redirect()->intended('/biznet')->with('success', 'Selamat Datang !! Silahkan Lakukan Presensi.');
            }
        }else{
            return redirect('/')->with('error','ERORR !! Mohon Periksa Kembali NIP dan Password Anda.');
        }

        // return redirect('/home');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('auth.index')->with('success', 'Terimakasih Sudah Absen');
    }
}
