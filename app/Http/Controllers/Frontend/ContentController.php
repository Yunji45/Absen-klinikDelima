<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beranda;
use App\Models\Tentang;
use App\Models\Layanan;
use App\Models\Divisi;
use App\Models\FaqKontak;
use App\Models\Dokter;

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
        $tentang = Tentang::find(1);
        return view ('template.frontend.content.tentang',compact('tentang'));
    }

    public function layanan()
    {
        $layanan = Layanan::all();
        return view ('template.frontend.content.layanan',compact('layanan'));
    }

    public function divisi()
    {
        $divisi = Divisi::all();
        return view ('template.frontend.content.divisi',compact('divisi'));
    }

    public function dokter()
    {
        $dokter = Dokter::all();
        return view ('template.frontend.content.dokter',compact('dokter'));
    }

    public function kontak()
    {
        $faqs = FaqKontak::all();
        return view ('template.frontend.content.kontak',compact('faqs'));
    }

    public function kritik_saran()
    {
        return view ('template.frontend.content.kritik-saran');
    }
}
