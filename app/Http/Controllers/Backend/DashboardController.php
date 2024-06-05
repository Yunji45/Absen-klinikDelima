<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailPegawai;
use App\Models\DatasetRanap;
use App\Models\DatasetRajal;
use App\Models\DatasetKhitan;
use App\Models\DatasetLab;
use App\Models\DatasetUsg;
use App\Models\DatasetEstetika;
use App\Models\DatasetPersalinan;
use App\Models\KodeWilayah;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        'D3_Nakes','D3_NonNakes','SLTA_Nakes','SLTA_NonNakes','Dibawah_SLTA','nakes'));
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
        
        $datasets = [
            'rajal' => DatasetRajal::count(),
            'ranap' => DatasetRanap::count(),
            'khitan' => DatasetKhitan::count(),
            'lab' => DatasetLab::count(),
            'usg' => DatasetUsg::count(),
            'estetika' => DatasetEstetika::count()
        ];
        $sum = array_sum($datasets);
        $data = KodeWilayah::all();

        $hariIni = Carbon::today();
        $kemarin = Carbon::yesterday();
        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();
        $awalMingguLalu = Carbon::now()->subWeek()->startOfWeek();
        $akhirMingguLalu = Carbon::now()->subWeek()->endOfWeek();
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();
        $awalBulanLalu = Carbon::now()->subMonth()->startOfMonth();
        $akhirBulanLalu = Carbon::now()->subMonth()->endOfMonth();
        $awalTahun = Carbon::now()->startOfYear();
        $akhirTahun = Carbon::now()->endOfYear();
        $awalTahunLalu = Carbon::now()->subYear()->startOfYear();
        $akhirTahunLalu = Carbon::now()->subYear()->endOfYear();

        $kunjunganHariIni = DatasetEstetika::whereDate('tgl_kunjungan', $hariIni)
                            ->union(
                                DatasetRanap::whereDate('tgl_kunjungan', $hariIni)
                            )
                            ->union(
                                DatasetRajal::whereDate('tgl_kunjungan', $hariIni)
                            )
                            ->union(
                                DatasetKhitan::whereDate('tgl_kunjungan', $hariIni)
                            )
                            ->union(
                                DatasetUsg::whereDate('tgl_kunjungan', $hariIni)
                            )
                            ->union(
                                DatasetLab::whereDate('tgl_kunjungan', $hariIni)
                            )
                            ->count();
        $kunjunganKemarin = DatasetEstetika::whereDate('tgl_kunjungan', $kemarin)
                            ->union(
                                DatasetRanap::whereDate('tgl_kunjungan',$kemarin)
                            )
                            ->union(
                                DatasetRajal::whereDate('tgl_kunjungan',$kemarin)
                            )
                            ->union(
                                DatasetKhitan::whereDate('tgl_kunjungan',$kemarin)
                            )
                            ->union(
                                DatasetUsg::whereDate('tgl_kunjungan',$kemarin)
                            )
                            ->union(
                                DatasetLab::whereDate('tgl_kunjungan',$kemarin)
                            )
                            ->count();
        $kunjunganMingguIni = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalMinggu, $akhirMinggu])
                            ->union(
                                DatasetRanap::whereBetween('tgl_kunjungan',[$awalMinggu, $akhirMinggu])
                            )
                            ->union(
                                DatasetRajal::whereBetween('tgl_kunjungan',[$awalMinggu, $akhirMinggu])
                            )
                            ->union(
                                DatasetKhitan::whereBetween('tgl_kunjungan',[$awalMinggu, $akhirMinggu])
                            )
                            ->union(
                                DatasetUsg::whereBetween('tgl_kunjungan',[$awalMinggu, $akhirMinggu])
                            )
                            ->union(
                                DatasetLab::whereBetween('tgl_kunjungan',[$awalMinggu, $akhirMinggu])
                            )
                            ->count();
        $kunjunganMingguLalu = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalMingguLalu, $akhirMingguLalu])
                            ->union(
                                DatasetRanap::whereBetween('tgl_kunjungan',[$awalMingguLalu, $akhirMingguLalu])
                            )
                            ->union(
                                DatasetRajal::whereBetween('tgl_kunjungan',[$awalMingguLalu, $akhirMingguLalu])
                            )
                            ->union(
                                DatasetKhitan::whereBetween('tgl_kunjungan',[$awalMingguLalu, $akhirMingguLalu])
                            )
                            ->union(
                                DatasetUsg::whereBetween('tgl_kunjungan',[$awalMingguLalu, $akhirMingguLalu])
                            )
                            ->union(
                                DatasetLab::whereBetween('tgl_kunjungan',[$awalMingguLalu, $akhirMingguLalu])
                            )
                            ->count();
        $kunjunganBulanIni = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalBulan, $akhirBulan])
                            ->union(
                                DatasetRanap::whereBetween('tgl_kunjungan',[$awalBulan, $akhirBulan])
                            )
                            ->union(
                                DatasetRajal::whereBetween('tgl_kunjungan',[$awalBulan, $akhirBulan])
                            )
                            ->union(
                                DatasetKhitan::whereBetween('tgl_kunjungan',[$awalBulan, $akhirBulan])
                            )
                            ->union(
                                DatasetUsg::whereBetween('tgl_kunjungan',[$awalBulan, $akhirBulan])
                            )
                            ->union(
                                DatasetLab::whereBetween('tgl_kunjungan',[$awalBulan, $akhirBulan])
                            )
                            ->count();
        $kunjunganBulanLalu = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalBulanLalu, $akhirBulanLalu])
                            ->union(
                                DatasetRanap::whereBetween('tgl_kunjungan',[$awalBulanLalu, $akhirBulanLalu])
                            )
                            ->union(
                                DatasetRajal::whereBetween('tgl_kunjungan',[$awalBulanLalu, $akhirBulanLalu])
                            )
                            ->union(
                                DatasetKhitan::whereBetween('tgl_kunjungan',[$awalBulanLalu, $akhirBulanLalu])
                            )
                            ->union(
                                DatasetUsg::whereBetween('tgl_kunjungan',[$awalBulanLalu, $akhirBulanLalu])
                            )
                            ->union(
                                DatasetLab::whereBetween('tgl_kunjungan',[$awalBulanLalu, $akhirBulanLalu])
                            )
                            ->count();
        $kunjunganTahunIni = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalTahun, $akhirTahun])
                            ->union(
                                DatasetRanap::whereBetween('tgl_kunjungan',[$awalTahun, $akhirTahun])
                            )
                            ->union(
                                DatasetRajal::whereBetween('tgl_kunjungan',[$awalTahun, $akhirTahun])
                            )
                            ->union(
                                DatasetKhitan::whereBetween('tgl_kunjungan',[$awalTahun, $akhirTahun])
                            )
                            ->union(
                                DatasetUsg::whereBetween('tgl_kunjungan',[$awalTahun, $akhirTahun])
                            )
                            ->union(
                                DatasetLab::whereBetween('tgl_kunjungan',[$awalTahun, $akhirTahun])
                            )
                            ->count();
        $kunjunganTahunLalu = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalTahunLalu, $akhirTahunLalu])
                            ->union(
                                DatasetRanap::whereBetween('tgl_kunjungan',[$awalTahunLalu, $akhirTahunLalu])
                            )
                            ->union(
                                DatasetRajal::whereBetween('tgl_kunjungan',[$awalTahunLalu, $akhirTahunLalu])
                            )
                            ->union(
                                DatasetKhitan::whereBetween('tgl_kunjungan',[$awalTahunLalu, $akhirTahunLalu])
                            )
                            ->union(
                                DatasetUsg::whereBetween('tgl_kunjungan',[$awalTahunLalu, $akhirTahunLalu])
                            )
                            ->union(
                                DatasetLab::whereBetween('tgl_kunjungan',[$awalTahunLalu, $akhirTahunLalu])
                            )
                            ->count();
        $perbandinganHariIni = $this->compare_ranap($kunjunganHariIni, $kunjunganKemarin);
        $perbandinganMingguIni = $this->compare_ranap($kunjunganMingguIni, $kunjunganMingguLalu);
        $perbandinganBulanIni = $this->compare_ranap($kunjunganBulanIni, $kunjunganBulanLalu);
        $perbandinganTahunIni = $this->compare_ranap($kunjunganTahunIni, $kunjunganTahunLalu);
                    
        // return $perbandinganHariIni;
        return view('template.backend.admin.dashboard.layanan',compact('title','type','sum','rajal_per_month','ranap_per_month','data',
        'kunjunganHariIni', 'kunjunganKemarin', 'kunjunganMingguIni', 'kunjunganMingguLalu', 
        'kunjunganBulanIni', 'kunjunganBulanLalu', 'kunjunganTahunIni', 'kunjunganTahunLalu',
        'perbandinganHariIni', 'perbandinganMingguIni', 'perbandinganBulanIni', 'perbandinganTahunIni'));
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

        $hariIni = Carbon::today();
        $kemarin = Carbon::yesterday();
        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();
        $awalMingguLalu = Carbon::now()->subWeek()->startOfWeek();
        $akhirMingguLalu = Carbon::now()->subWeek()->endOfWeek();
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();
        $awalBulanLalu = Carbon::now()->subMonth()->startOfMonth();
        $akhirBulanLalu = Carbon::now()->subMonth()->endOfMonth();
        $awalTahun = Carbon::now()->startOfYear();
        $akhirTahun = Carbon::now()->endOfYear();
        $awalTahunLalu = Carbon::now()->subYear()->startOfYear();
        $akhirTahunLalu = Carbon::now()->subYear()->endOfYear();

        $kunjunganHariIni = DatasetRajal::whereDate('tgl_kunjungan', $hariIni)->count();
        $kunjunganKemarin = DatasetRajal::whereDate('tgl_kunjungan', $kemarin)->count();
        $kunjunganMingguIni = DatasetRajal::whereBetween('tgl_kunjungan', [$awalMinggu, $akhirMinggu])->count();
        $kunjunganMingguLalu = DatasetRajal::whereBetween('tgl_kunjungan', [$awalMingguLalu, $akhirMingguLalu])->count();
        $kunjunganBulanIni = DatasetRajal::whereBetween('tgl_kunjungan', [$awalBulan, $akhirBulan])->count();
        $kunjunganBulanLalu = DatasetRajal::whereBetween('tgl_kunjungan', [$awalBulanLalu, $akhirBulanLalu])->count();
        $kunjunganTahunIni = DatasetRajal::whereBetween('tgl_kunjungan', [$awalTahun, $akhirTahun])->count();
        $kunjunganTahunLalu = DatasetRajal::whereBetween('tgl_kunjungan', [$awalTahunLalu, $akhirTahunLalu])->count();

        $perbandinganHariIni = $this->compare_rajal($kunjunganHariIni, $kunjunganKemarin);
        $perbandinganMingguIni = $this->compare_rajal($kunjunganMingguIni, $kunjunganMingguLalu);
        $perbandinganBulanIni = $this->compare_rajal($kunjunganBulanIni, $kunjunganBulanLalu);
        $perbandinganTahunIni = $this->compare_rajal($kunjunganTahunIni, $kunjunganTahunLalu);
        // $years = DatasetRajal::selectRaw('YEAR(tgl_kunjungan) as year')->distinct()->pluck('year');
        // return $years;
        return view('template.backend.admin.dashboard.layanan.rajal',
        compact('title','type','umum','KB','imunisasi','hamil','sehat','total',
        'kunjunganHariIni', 'kunjunganKemarin', 'kunjunganMingguIni', 'kunjunganMingguLalu', 
        'kunjunganBulanIni', 'kunjunganBulanLalu', 'kunjunganTahunIni', 'kunjunganTahunLalu',
        'perbandinganHariIni', 'perbandinganMingguIni', 'perbandinganBulanIni', 'perbandinganTahunIni'
    ));
    }

    private function compare_rajal($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return (($current - $previous) / $previous) * 100;
    }

    public function dash_ranap()
    {
        $title = 'Dashboard Rawat Inap';
        $type = 'dash_layanan';
        $umum = DatasetRanap::where('poli','Umum')->count();
        $persalinan = DatasetRanap::where('poli','Persalinan')->count();
        $total=DatasetRanap::count();

        $hariIni = Carbon::today();
        $kemarin = Carbon::yesterday();
        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();
        $awalMingguLalu = Carbon::now()->subWeek()->startOfWeek();
        $akhirMingguLalu = Carbon::now()->subWeek()->endOfWeek();
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();
        $awalBulanLalu = Carbon::now()->subMonth()->startOfMonth();
        $akhirBulanLalu = Carbon::now()->subMonth()->endOfMonth();
        $awalTahun = Carbon::now()->startOfYear();
        $akhirTahun = Carbon::now()->endOfYear();
        $awalTahunLalu = Carbon::now()->subYear()->startOfYear();
        $akhirTahunLalu = Carbon::now()->subYear()->endOfYear();

        $kunjunganHariIni = DatasetRanap::whereDate('tgl_kunjungan', $hariIni)->count();
        $kunjunganKemarin = DatasetRanap::whereDate('tgl_kunjungan', $kemarin)->count();
        $kunjunganMingguIni = DatasetRanap::whereBetween('tgl_kunjungan', [$awalMinggu, $akhirMinggu])->count();
        $kunjunganMingguLalu = DatasetRanap::whereBetween('tgl_kunjungan', [$awalMingguLalu, $akhirMingguLalu])->count();
        $kunjunganBulanIni = DatasetRanap::whereBetween('tgl_kunjungan', [$awalBulan, $akhirBulan])->count();
        $kunjunganBulanLalu = DatasetRanap::whereBetween('tgl_kunjungan', [$awalBulanLalu, $akhirBulanLalu])->count();
        $kunjunganTahunIni = DatasetRanap::whereBetween('tgl_kunjungan', [$awalTahun, $akhirTahun])->count();
        $kunjunganTahunLalu = DatasetRanap::whereBetween('tgl_kunjungan', [$awalTahunLalu, $akhirTahunLalu])->count();

        $perbandinganHariIni = $this->compare_ranap($kunjunganHariIni, $kunjunganKemarin);
        $perbandinganMingguIni = $this->compare_ranap($kunjunganMingguIni, $kunjunganMingguLalu);
        $perbandinganBulanIni = $this->compare_ranap($kunjunganBulanIni, $kunjunganBulanLalu);
        $perbandinganTahunIni = $this->compare_ranap($kunjunganTahunIni, $kunjunganTahunLalu);

        return view('template.backend.admin.dashboard.layanan.ranap',
        compact('title','type','umum','persalinan','total',
        'kunjunganHariIni', 'kunjunganKemarin', 'kunjunganMingguIni', 'kunjunganMingguLalu', 
        'kunjunganBulanIni', 'kunjunganBulanLalu', 'kunjunganTahunIni', 'kunjunganTahunLalu',
        'perbandinganHariIni', 'perbandinganMingguIni', 'perbandinganBulanIni', 'perbandinganTahunIni'));
    }

    private function compare_ranap($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return (($current - $previous) / $previous) * 100;
    }

    public function dash_khitan()
    {
        $title = 'Dashboard Khitan';
        $type = 'dash_layanan';
        $total = DatasetKhitan::count();

        $hariIni = Carbon::today();
        $kemarin = Carbon::yesterday();
        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();
        $awalMingguLalu = Carbon::now()->subWeek()->startOfWeek();
        $akhirMingguLalu = Carbon::now()->subWeek()->endOfWeek();
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();
        $awalBulanLalu = Carbon::now()->subMonth()->startOfMonth();
        $akhirBulanLalu = Carbon::now()->subMonth()->endOfMonth();
        $awalTahun = Carbon::now()->startOfYear();
        $akhirTahun = Carbon::now()->endOfYear();
        $awalTahunLalu = Carbon::now()->subYear()->startOfYear();
        $akhirTahunLalu = Carbon::now()->subYear()->endOfYear();

        $kunjunganHariIni = DatasetKhitan::whereDate('tgl_kunjungan', $hariIni)->count();
        $kunjunganKemarin = DatasetKhitan::whereDate('tgl_kunjungan', $kemarin)->count();
        $kunjunganMingguIni = DatasetKhitan::whereBetween('tgl_kunjungan', [$awalMinggu, $akhirMinggu])->count();
        $kunjunganMingguLalu = DatasetKhitan::whereBetween('tgl_kunjungan', [$awalMingguLalu, $akhirMingguLalu])->count();
        $kunjunganBulanIni = DatasetKhitan::whereBetween('tgl_kunjungan', [$awalBulan, $akhirBulan])->count();
        $kunjunganBulanLalu = DatasetKhitan::whereBetween('tgl_kunjungan', [$awalBulanLalu, $akhirBulanLalu])->count();
        $kunjunganTahunIni = DatasetKhitan::whereBetween('tgl_kunjungan', [$awalTahun, $akhirTahun])->count();
        $kunjunganTahunLalu = DatasetKhitan::whereBetween('tgl_kunjungan', [$awalTahunLalu, $akhirTahunLalu])->count();

        $perbandinganHariIni = $this->compare_ranap($kunjunganHariIni, $kunjunganKemarin);
        $perbandinganMingguIni = $this->compare_ranap($kunjunganMingguIni, $kunjunganMingguLalu);
        $perbandinganBulanIni = $this->compare_ranap($kunjunganBulanIni, $kunjunganBulanLalu);
        $perbandinganTahunIni = $this->compare_ranap($kunjunganTahunIni, $kunjunganTahunLalu);

        return view('template.backend.admin.dashboard.layanan.khitan',
        compact('title','type','total',
        'kunjunganHariIni', 'kunjunganKemarin', 'kunjunganMingguIni', 'kunjunganMingguLalu', 
        'kunjunganBulanIni', 'kunjunganBulanLalu', 'kunjunganTahunIni', 'kunjunganTahunLalu',
        'perbandinganHariIni', 'perbandinganMingguIni', 'perbandinganBulanIni', 'perbandinganTahunIni'));
    }

    public function dash_lab()
    {
        $title = 'Dashboard Laboratorium';
        $type = 'dash_layanan';
        $total = DatasetLab::count();

        $hariIni = Carbon::today();
        $kemarin = Carbon::yesterday();
        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();
        $awalMingguLalu = Carbon::now()->subWeek()->startOfWeek();
        $akhirMingguLalu = Carbon::now()->subWeek()->endOfWeek();
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();
        $awalBulanLalu = Carbon::now()->subMonth()->startOfMonth();
        $akhirBulanLalu = Carbon::now()->subMonth()->endOfMonth();
        $awalTahun = Carbon::now()->startOfYear();
        $akhirTahun = Carbon::now()->endOfYear();
        $awalTahunLalu = Carbon::now()->subYear()->startOfYear();
        $akhirTahunLalu = Carbon::now()->subYear()->endOfYear();

        $kunjunganHariIni = DatasetLab::whereDate('tgl_kunjungan', $hariIni)->count();
        $kunjunganKemarin = DatasetLab::whereDate('tgl_kunjungan', $kemarin)->count();
        $kunjunganMingguIni = DatasetLab::whereBetween('tgl_kunjungan', [$awalMinggu, $akhirMinggu])->count();
        $kunjunganMingguLalu = DatasetLab::whereBetween('tgl_kunjungan', [$awalMingguLalu, $akhirMingguLalu])->count();
        $kunjunganBulanIni = DatasetLab::whereBetween('tgl_kunjungan', [$awalBulan, $akhirBulan])->count();
        $kunjunganBulanLalu = DatasetLab::whereBetween('tgl_kunjungan', [$awalBulanLalu, $akhirBulanLalu])->count();
        $kunjunganTahunIni = DatasetLab::whereBetween('tgl_kunjungan', [$awalTahun, $akhirTahun])->count();
        $kunjunganTahunLalu = DatasetLab::whereBetween('tgl_kunjungan', [$awalTahunLalu, $akhirTahunLalu])->count();

        $perbandinganHariIni = $this->compare_ranap($kunjunganHariIni, $kunjunganKemarin);
        $perbandinganMingguIni = $this->compare_ranap($kunjunganMingguIni, $kunjunganMingguLalu);
        $perbandinganBulanIni = $this->compare_ranap($kunjunganBulanIni, $kunjunganBulanLalu);
        $perbandinganTahunIni = $this->compare_ranap($kunjunganTahunIni, $kunjunganTahunLalu);

        return view('template.backend.admin.dashboard.layanan.lab',compact('title','type','total',
        'kunjunganHariIni', 'kunjunganKemarin', 'kunjunganMingguIni', 'kunjunganMingguLalu', 
        'kunjunganBulanIni', 'kunjunganBulanLalu', 'kunjunganTahunIni', 'kunjunganTahunLalu',
        'perbandinganHariIni', 'perbandinganMingguIni', 'perbandinganBulanIni', 'perbandinganTahunIni'));
    }

    public function dash_usg()
    {
        $title = 'Dashboard USG';
        $type = 'dash_layanan';
        $total = DatasetUsg::count();

        $hariIni = Carbon::today();
        $kemarin = Carbon::yesterday();
        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();
        $awalMingguLalu = Carbon::now()->subWeek()->startOfWeek();
        $akhirMingguLalu = Carbon::now()->subWeek()->endOfWeek();
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();
        $awalBulanLalu = Carbon::now()->subMonth()->startOfMonth();
        $akhirBulanLalu = Carbon::now()->subMonth()->endOfMonth();
        $awalTahun = Carbon::now()->startOfYear();
        $akhirTahun = Carbon::now()->endOfYear();
        $awalTahunLalu = Carbon::now()->subYear()->startOfYear();
        $akhirTahunLalu = Carbon::now()->subYear()->endOfYear();

        $kunjunganHariIni = DatasetUsg::whereDate('tgl_kunjungan', $hariIni)->count();
        $kunjunganKemarin = DatasetUsg::whereDate('tgl_kunjungan', $kemarin)->count();
        $kunjunganMingguIni = DatasetUsg::whereBetween('tgl_kunjungan', [$awalMinggu, $akhirMinggu])->count();
        $kunjunganMingguLalu = DatasetUsg::whereBetween('tgl_kunjungan', [$awalMingguLalu, $akhirMingguLalu])->count();
        $kunjunganBulanIni = DatasetUsg::whereBetween('tgl_kunjungan', [$awalBulan, $akhirBulan])->count();
        $kunjunganBulanLalu = DatasetUsg::whereBetween('tgl_kunjungan', [$awalBulanLalu, $akhirBulanLalu])->count();
        $kunjunganTahunIni = DatasetUsg::whereBetween('tgl_kunjungan', [$awalTahun, $akhirTahun])->count();
        $kunjunganTahunLalu = DatasetUsg::whereBetween('tgl_kunjungan', [$awalTahunLalu, $akhirTahunLalu])->count();

        $perbandinganHariIni = $this->compare_ranap($kunjunganHariIni, $kunjunganKemarin);
        $perbandinganMingguIni = $this->compare_ranap($kunjunganMingguIni, $kunjunganMingguLalu);
        $perbandinganBulanIni = $this->compare_ranap($kunjunganBulanIni, $kunjunganBulanLalu);
        $perbandinganTahunIni = $this->compare_ranap($kunjunganTahunIni, $kunjunganTahunLalu);

        return view('template.backend.admin.dashboard.layanan.usg',compact('title','type','total',
        'kunjunganHariIni', 'kunjunganKemarin', 'kunjunganMingguIni', 'kunjunganMingguLalu', 
        'kunjunganBulanIni', 'kunjunganBulanLalu', 'kunjunganTahunIni', 'kunjunganTahunLalu',
        'perbandinganHariIni', 'perbandinganMingguIni', 'perbandinganBulanIni', 'perbandinganTahunIni'));
    }

    public function dash_estetika()
    {
        $title = 'Dashboard Estetika';
        $type = 'dash_layanan';
        $total = DatasetEstetika::count();

        $hariIni = Carbon::today();
        $kemarin = Carbon::yesterday();
        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();
        $awalMingguLalu = Carbon::now()->subWeek()->startOfWeek();
        $akhirMingguLalu = Carbon::now()->subWeek()->endOfWeek();
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();
        $awalBulanLalu = Carbon::now()->subMonth()->startOfMonth();
        $akhirBulanLalu = Carbon::now()->subMonth()->endOfMonth();
        $awalTahun = Carbon::now()->startOfYear();
        $akhirTahun = Carbon::now()->endOfYear();
        $awalTahunLalu = Carbon::now()->subYear()->startOfYear();
        $akhirTahunLalu = Carbon::now()->subYear()->endOfYear();

        $kunjunganHariIni = DatasetEstetika::whereDate('tgl_kunjungan', $hariIni)->count();
        $kunjunganKemarin = DatasetEstetika::whereDate('tgl_kunjungan', $kemarin)->count();
        $kunjunganMingguIni = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalMinggu, $akhirMinggu])->count();
        $kunjunganMingguLalu = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalMingguLalu, $akhirMingguLalu])->count();
        $kunjunganBulanIni = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalBulan, $akhirBulan])->count();
        $kunjunganBulanLalu = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalBulanLalu, $akhirBulanLalu])->count();
        $kunjunganTahunIni = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalTahun, $akhirTahun])->count();
        $kunjunganTahunLalu = DatasetEstetika::whereBetween('tgl_kunjungan', [$awalTahunLalu, $akhirTahunLalu])->count();

        $perbandinganHariIni = $this->compare_ranap($kunjunganHariIni, $kunjunganKemarin);
        $perbandinganMingguIni = $this->compare_ranap($kunjunganMingguIni, $kunjunganMingguLalu);
        $perbandinganBulanIni = $this->compare_ranap($kunjunganBulanIni, $kunjunganBulanLalu);
        $perbandinganTahunIni = $this->compare_ranap($kunjunganTahunIni, $kunjunganTahunLalu);


        return view('template.backend.admin.dashboard.layanan.estetika',compact('title','type','total',
        'kunjunganHariIni', 'kunjunganKemarin', 'kunjunganMingguIni', 'kunjunganMingguLalu', 
        'kunjunganBulanIni', 'kunjunganBulanLalu', 'kunjunganTahunIni', 'kunjunganTahunLalu',
        'perbandinganHariIni', 'perbandinganMingguIni', 'perbandinganBulanIni', 'perbandinganTahunIni'));

    }
}
