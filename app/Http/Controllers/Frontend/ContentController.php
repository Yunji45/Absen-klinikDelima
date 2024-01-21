<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function home()
    {
        return view ('template.frontend.content.index');
    }
    public function tentang()
    {
        return view ('template.frontend.content.tentang');
    }

    public function layanan()
    {
        return view ('template.frontend.content.layanan');
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
}
