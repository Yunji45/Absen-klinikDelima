<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helper\Biznet;

class BiznetController extends Controller
{
    public function index()
    {
        return view('template.frontend.face');
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
        // Lakukan sesuatu dengan hasil identifikasi, misalnya:
        // return response()->json(['result' => $result]);

        // Contoh langsung mengembalikan hasil identifikasi dalam bentuk JSON
        // return response()->json($result);
        if (isset($result['risetai']['status']) && $result['risetai']['status'] === "200") {
            // Jika status adalah "200", arahkan ke rute '/'
            return redirect('/');
        } else {
            // Jika status bukan "200", arahkan ke rute '/biznet'
            return redirect('/biznet');
        }
    }

}
