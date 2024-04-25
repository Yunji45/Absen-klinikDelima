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

        $dokter = DetailPegawai::where('position','DOKTER')->count();
        $perawat = DetailPegawai::where('position','PERAWAT')->count();
        $bidan = DetailPegawai::where('position','BIDAN')->count();
        $apoteker = DetailPegawai::where('position','APOTEKER')->count();
        $ast_apoteker = DetailPegawai::where('position','Ast.APOTEKER')->count();
        $analys = DetailPegawai::where('position','ANALYS LAB')->count();
        $nutrisi = DetailPegawai::where('position','NUTRISIONIS')->count();

        $nakes = [
            'DOKTER' => $dokter,
            'PERAWAT' => $perawat,
            'BIDAN' => $bidan,
            'APOTEKER' => $apoteker,
            'Ast.APOTEKER' => $ast_apoteker,
            'ANALYS LAB' => $analys,
            'NUTRISIONIS' => $nutrisi,
        ];


        return view('template.backend.admin.dashboard.index',compact('title','type','JumPegawai','S2','S1_Nakes','S1_NonNakes',
        'D3_Nakes','D3_NonNakes','SLTA_Nakes','SLTA_NonNakes','Dibawah_SLTA','nakes'
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

    public function dash_rajal()
    {
        $title = 'Dashboard Rawat Jalan';
        $type = 'dash_layanan';
        return view('template.backend.admin.dashboard.layanan.rajal',compact('title','type'));
    }

    public function dash_ranap()
    {
        $title = 'Dashboard Rawat Inap';
        $type = 'dash_layanan';
        return view('template.backend.admin.dashboard.layanan.ranap',compact('title','type'));
    }

}
