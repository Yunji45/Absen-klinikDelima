<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DokumentasiController extends Controller
{
    public function index()
    {
        $title = 'Dokumentasi API';
        $type = 'dokumentasi';
        return view ('template.backend.API.index',compact('title','type'));
    }
}
