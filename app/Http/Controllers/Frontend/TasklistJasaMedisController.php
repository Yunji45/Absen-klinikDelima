<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OperasionalJasa;
use App\Models\User;
use Auth;

class TasklistJasaMedisController extends Controller
{
    public function index()
    {
        $title = 'Todo List Jasa Medis';
        $type = 'tasklist';
        $tugas = OperasionalJasa::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        // return $tugas;
        return view('template.frontend.jasa-medis.index',compact('title','type','tugas'));
    }

    public function HistoryTask()
    {
        $title = 'Todo List Jasa Medis';
        $type = 'tasklist';
        $tugas = OperasionalJasa::where('user_id',Auth::user()->id)->where('ceklis','Ya')->get();
        // return $tugas;
        return view('template.frontend.jasa-medis.index',compact('title','type','tugas'));
    }
}
