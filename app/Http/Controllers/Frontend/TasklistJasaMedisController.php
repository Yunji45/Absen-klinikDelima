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
        $tugas = OperasionalJasa::where('user_id',Auth::user()->id)->where('ceklis','Tidak')->orderBy('created_at','desc')->get();
        // return $tugas;
        return view('template.frontend.jasa-medis.index',compact('title','type','tugas'));
    }

    public function HistoryTask()
    {
        $title = 'History Jasa Medis';
        $type = 'tasklist';
        $tugas = OperasionalJasa::where('user_id',Auth::user()->id)->where('ceklis','Ya')->get();
        $pending = OperasionalJasa::where('user_id',Auth::user()->id)->where('ceklis','Tidak')->count();
        $complete = OperasionalJasa::where('user_id',Auth::user()->id)->where('ceklis','Ya')->count();
        $totaljasa = OperasionalJasa::where('user_id',Auth::user()->id)->sum('tarif_jasa');
        $jumlah = OperasionalJasa::where('user_id',Auth::user()->id)->count();
        // return $totaljasa;
        return view('template.frontend.jasa-medis.history',compact('title','type','tugas','jumlah','pending','complete','totaljasa'));
    }
}
