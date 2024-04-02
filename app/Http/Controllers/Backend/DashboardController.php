<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailPegawai;
use App\Charts\LayananChart;
use App\Charts\AreaChart;
use App\Charts\NakesChart;

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

        $data1 = app(NakesChart::class);
        $chart = $data1->build(); 

        return view('template.backend.admin.dashboard.index',compact('title','type','JumPegawai','S2','S1_Nakes','S1_NonNakes',
        'D3_Nakes','D3_NonNakes','SLTA_Nakes','SLTA_NonNakes','Dibawah_SLTA','chart'
    ));
        // return $JumPegawai;
    }

    //layanan
    public function dash_layanan()
    {
        
        $title = 'Dashboard Layanan';
        $type = 'dash_layanan';

        $data1 = app(LayananChart::class);
        $data2 = app(AreaChart::class);
    
        $chartData = $data1->build(); 
        $areaChartData = $data2->build();
    
        return view('template.backend.admin.dashboard.layanan', [
            'chart' => $chartData,
            'area' => $areaChartData,
            'title' => $title,
            'type' => $type
        ]);
    }

}
