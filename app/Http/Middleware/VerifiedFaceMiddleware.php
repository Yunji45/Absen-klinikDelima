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
        $isFaceVerified = false;

        if (!$isFaceVerified) {
            // Jika verifikasi wajah tidak berhasil, arahkan ke /biznet
            return redirect('/biznet')->with('error', 'Anda harus melewati verifikasi wajah di /biznet terlebih dahulu.');
        }

        return $next($request);
    }
}
