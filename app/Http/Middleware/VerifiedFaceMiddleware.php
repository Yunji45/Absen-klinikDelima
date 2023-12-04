<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifiedFaceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Contoh logika verifikasi wajah sederhana
        $isFaceVerified = true; // Ganti dengan logika verifikasi sesuai kebutuhan

        // Jika wajah terverifikasi, lanjutkan ke rute yang diminta
        if ($isFaceVerified) {
            // return $next($request);
            return redirect('/home')->with('success','Data Wajah Berhasil Teridentifikasi, Silahkan lanjutkan Presensi.');

        } else {
            // Jika wajah tidak terverifikasi, redirect atau berikan respons sesuai kebutuhan
            return redirect('/biznet')->with('error', 'Anda harus melewati verifikasi wajah terlebih dahulu.');
        }
    }
}
