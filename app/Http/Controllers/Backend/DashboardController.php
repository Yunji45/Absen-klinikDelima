<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailPegawai;
use App\Models\DatasetRanap;
use App\Models\DatasetRajal;
use App\Models\DatasetKhitan;
use App\Models\DatasetPersalinan;

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

        $current_year = date('Y');
        $current_month = date('m');
        $rajal_per_month = [];
        $ranap_per_month = [];
        
        for ($month = 1; $month <= $current_month; $month++) {
            $first_day_of_month = date('Y-m-01', strtotime("$current_year-$month-01"));
            $last_day_of_month = date('Y-m-t', strtotime("$current_year-$month-01"));
            $rajal_count = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
            $rajal_per_month[$month] = $rajal_count;
            $ranap_count = DatasetRanap::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
            $ranap_per_month[$month] = $ranap_count;
        }
        
        $rajal = DatasetRajal::count();
        $ranap = DatasetRanap::count();
        $khitan = DatasetKhitan::count();
        $persalinan = DatasetPersalinan::count();
        $sum = $rajal + $ranap + $khitan + $persalinan;
        // return $ranap_per_month;
        return view('template.backend.admin.dashboard.layanan',compact('title','type','sum','rajal_per_month','ranap_per_month'));
    }

    public function dash_rajal()
    {
        $title = 'Dashboard Rawat Jalan';
        $type = 'dash_layanan';
        $umum = DatasetRajal::where('poli','Poli Umum')->count();
        $imunisasi= DatasetRajal::where('poli','Imunisasi')->count();
        $KB = DatasetRajal::where('poli','KB')->count();
        $hamil = DatasetRajal::where('poli','Ibu Hamil')->count();
        $sehat = DatasetRajal::where('poli','Keterangan Sehat')->count();
        $total =DatasetRajal::count();
        // $years = DatasetRajal::selectRaw('YEAR(tgl_kunjungan) as year')->distinct()->pluck('year');
        // return $years;
        return view('template.backend.admin.dashboard.layanan.rajal',compact('title','type','umum','KB','imunisasi','hamil','sehat','total'));
    }

    public function dash_ranap()
    {
        $title = 'Dashboard Rawat Inap';
        $type = 'dash_layanan';
        $umum = DatasetRanap::where('poli','Umum')->count();
        $persalinan = DatasetRanap::where('poli','Persalinan')->count();
        $total=DatasetRanap::count();
        return view('template.backend.admin.dashboard.layanan.ranap',compact('title','type','umum','persalinan','total'));
    }

}
