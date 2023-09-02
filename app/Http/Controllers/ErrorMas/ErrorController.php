<?php

namespace App\Http\Controllers\ErrorMas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function forBidden()
    {
        return view ('frontend.error.403');
    }

    public function server()
    {
        return view('frontend.error.500');
    }
}
