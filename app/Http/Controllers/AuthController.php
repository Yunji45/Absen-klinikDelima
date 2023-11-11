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
            return redirect()->intended('/home')->with('success', 'INFORMASI GEMBIRA !!! Kami Informasikan Kepada Seluruh Pegawai Klinik Mitra Delima, Silahkan Cek Slip Insentif Bulan Ini. Jika Terdapat Masalah Mohon Informasikan Kpd Pihak Informatic Enginerr. TERIMAKASIH :=)');
            // $role = Auth::user()->role;
            // if ($role == 'admin'){
            //     return redirect()->intended('/dashboard');
            // }elseif ($role == 'kasir'){
            //     return redirect()->intended('/dashboard');
            // }elseif ($role == 'customer'){
            //     return redirect()->intended('/customer');
            // }
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
