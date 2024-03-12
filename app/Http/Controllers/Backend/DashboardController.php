<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailPegawai;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $type = 'dashboard';
        $JumPegawai = User::whereIn('role',['pegawai','keuangan','evaluator','hrd'])->count();
        $S2 = DetailPegawai::where('education','S2')->count();
        $S1_Nakes = DetailPegawai::where('education','S1 Kesehatan')->count();
        $S1_NonNakes = DetailPegawai::where('education','S1 Non Kesehatan')->count();
        $D3_Nakes = DetailPegawai::where('education','D3 Kesehatan')->count();
        $D3_NonNakes = DetailPegawai::where('education','D3 Non Kesehatan')->count();
        $SLTA_Nakes = DetailPegawai::where('education','SLTA Kesehatan')->count();
        $SLTA_NonNakes = DetailPegawai::where('education','SLTA Non Kesehatan')->count();
        $Dibawah_SLTA = DetailPegawai::where('education','Dibawah SLTA')->count();

        return view('template.backend.admin.dashboard.index',compact('title','type','JumPegawai','S2','S1_Nakes','S1_NonNakes',
        'D3_Nakes','D3_NonNakes','SLTA_Nakes','SLTA_NonNakes','Dibawah_SLTA'
    ));
        // return $JumPegawai;
    }

    //layanan
    public function dash_layanan()
    {
        $title = 'Dashboard Layanan';
        $type = 'dash_layanan';
        return view('template.backend.admin.dashboard.layanan',compact('title','type'));
    }
}
