<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy;

class CareerController extends Controller
{
    public function index()
    {
        $title = 'Klinik Mitra Delima - Career';
        $job = JobVacancy::orderBy('created_at','desc')->get();
        // return $job;
        return view ('template.frontend.content.career',compact('title','job'));
    }
}
