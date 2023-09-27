<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpITController extends Controller
{
    public function index()
    {
        return view('frontend.helpIT.index');
    }
}
