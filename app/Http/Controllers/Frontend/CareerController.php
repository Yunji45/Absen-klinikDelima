<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $title = 'Klinik Mitra Delima - Career';
        return view ('template.frontend.content.career',compact('title'));
    }
}
