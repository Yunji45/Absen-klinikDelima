<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VerifiedFaceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     public function handle($request, Closure $next)
     {
         // Memeriksa apakah pengguna telah login
         if (Auth::check()) {
            return $next($request);
            // return redirect('/biznet')->with('error', 'Anda harus login terlebih dahulu.');
         }
 
         // Jika pengguna belum login, arahkan ke /biznet
         return redirect('/')->with('error', 'Anda harus login terlebih dahulu.');
     }
 
    // public function handle(Request $request, Closure $next)
    // {
    //     $isFaceVerified = true;

    //     if (!$isFaceVerified) {
    //         // Jika verifikasi wajah tidak berhasil, arahkan ke /biznet
    //         return redirect('/biznet')->with('error', 'Anda harus melewati verifikasi wajah di /biznet terlebih dahulu.');
    //     }

    //     return $next($request);
    // }
}
