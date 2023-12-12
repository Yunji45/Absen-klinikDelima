<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helper\Biznet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BiznetController extends Controller
{
    public function index()
    {
        return view('template.frontend.face');
    }

    public function Face(Request $request)
    {
        // Validasi input
        $request->validate([
            'base64image' => 'required|string', // Sesuaikan dengan kebutuhan validasi gambar Anda
        ]);
        // Ambil data base64image dari request
        $image = $request->input('base64image');
        // Panggil fungsi identify dari helper Biznet
        $result = Biznet::identify($image);
        // Lakukan sesuatu dengan hasil identifikasi, misalnya:
        // return response()->json(['result' => $result]);

        // Contoh langsung mengembalikan hasil identifikasi dalam bentuk JSON
        return response()->json($result);
        // if (isset($result['risetai']['status']) && $result['risetai']['status'] === "200") {
        //     // Jika status adalah "200", arahkan ke rute '/'
        //     return redirect('/home');
        // } else {
        //     // Jika status bukan "200", arahkan ke rute '/biznet'
        //     return redirect('/biznet');
        // }
    }
    public function identifyFace(Request $request)
    {
        // Validasi input
        $request->validate([
            'base64image' => 'required|string', // Sesuaikan dengan kebutuhan validasi gambar Anda
        ]);

        // Ambil data base64image dari request
        $image = $request->input('base64image');

        // Panggil fungsi identify dari helper Biznet
        $result = Biznet::identify($image);

        session(['face_verification_result' => $result]);

        // Periksa apakah hasil identifikasi memiliki user_name
        if (isset($result['risetai']['return'][0]['user_name'])) {
            $identifiedUserName = $result['risetai']['return'][0]['user_name'];

            // Ambil nama pengguna yang sedang login
            $loggedInUserName = Auth::user()->name;

            // Periksa apakah user_name dari hasil identifikasi cocok dengan nama pengguna yang sedang login
            if ($identifiedUserName === $loggedInUserName) {
                // Jika cocok, lakukan sesuatu (misalnya, redirect ke halaman yang sesuai)
                return redirect('/home');
            } else {
                // Jika tidak cocok, lakukan sesuatu yang sesuai (misalnya, redirect ke halaman lain)
                return redirect('/biznet');
            }
        } else {
            // Jika tidak ada user_name dalam hasil identifikasi, lakukan sesuatu yang sesuai
            return redirect('/biznet');
        }
    }

}
