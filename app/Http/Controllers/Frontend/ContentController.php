<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beranda;
use App\Models\Tentang;
use App\Models\Layanan;

class ContentController extends Controller
{
    public function home()
    {
        $beranda = Beranda::find(1);
        // return $beranda;
        return view ('template.frontend.content.index',compact('beranda'));
    }
    public function tentang()
    {
        $tentang = Tentang::find(2);
        return view ('template.frontend.content.tentang',compact('tentang'));
    }

    public function layanan()
    {
        $layanan = Layanan::all();
        return view ('template.frontend.content.layanan',compact('layanan'));
    }

    public function divisi()
    {
        return view ('template.frontend.content.divisi');
    }

    public function dokter()
    {
        return view ('template.frontend.content.dokter');
    }

    public function kontak()
    {
        return view ('template.frontend.content.kontak');
    }

    public function kritik_saran()
    {
        return view ('template.frontend.content.kritik-saran');
    }
}
