<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocsApi as api;

class ApiDocsController extends Controller
{
    public function index()
    {
        $title = 'API - Klinik Mitra Delima';
        $type = 'API';
        $data = api::all();
        return view ('template.backend.admin.api.index',compact('title','type','data'));
    }
}
