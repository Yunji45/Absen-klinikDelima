<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Helper\Biznet;
use Illuminate\Support\Facades\Session;

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
        // Mengambil hasil identifikasi dari sesi
        $result = session('face_verification_result');

        if (isset($result['risetai']['return'][0]['user_name'])) {
            $identifiedUserName = $result['risetai']['return'][0]['user_name'];
            $loggedInUserName = Auth::user()->name;

            if ($identifiedUserName === $loggedInUserName) {
                // Jika cocok, lanjutkan dengan permintaan
                return $next($request);
            } else {
                // Jika user_name tidak cocok, tambahkan logika atau pesan kesalahan sesuai kebutuhan
                return redirect('/biznet')->with('error', 'Identifikasi wajah tidak cocok dengan pengguna yang sedang login.');
            }
        } else {
            // Jika tidak ada user_name dalam hasil identifikasi, tambahkan logika atau pesan kesalahan sesuai kebutuhan
            return redirect('/biznet')->with('error', 'Identifikasi wajah tidak berhasil.');
        }
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
