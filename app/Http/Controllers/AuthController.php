<?php

namespace App\Http\Controllers;

use App\Rules\LoginRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $cek_login = $request->only('nik', 'password');
        if(Auth::attempt($cek_login)) {
            return redirect()->intended('/home');
            // $role = Auth::user()->role;
            // if ($role == 'admin'){
            //     return redirect()->intended('/dashboard');
            // }elseif ($role == 'kasir'){
            //     return redirect()->intended('/dashboard');
            // }elseif ($role == 'customer'){
            //     return redirect()->intended('/customer');
            // }
        }else{
            return redirect('/login');
        }

        // return redirect('/home');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('auth.index')->with('Success', 'Terimakasih Sudah Absen');
    }
}
