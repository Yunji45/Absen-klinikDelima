<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DatasetRajal;
use App\Models\DatasetRanap;
use App\Models\DatasetKhitan;
use App\Models\DatasetPersalinan;

class LayananController extends Controller
{
    /**
     * API untuk Index utama di dashboard Layanan
     */
    public function dash_layanan()
    {
        $current_year = date('Y');
        $current_month = date('m');
        $rajal_per_month = [];
        $ranap_per_month = [];
        $khitan_per_mont = [];
        
        for ($month = 1; $month <= $current_month; $month++) {
            $first_day_of_month = date('Y-m-01', strtotime("$current_year-$month-01"));
            $last_day_of_month = date('Y-m-t', strtotime("$current_year-$month-01"));
            $rajal_count = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
            $rajal_per_month[$month] = $rajal_count;
            $ranap_count = DatasetRanap::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
            $ranap_per_month[$month] = $ranap_count;
            $khitan_count = DatasetKhitan::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
            $khitan_per_month[$month] = $khitan_count;
            $persalinan_count = DatasetPersalinan::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
            $persalinan_per_month[$month] = $persalinan_count;
        }
        return response()->json([
            'rajal_per_month' => $rajal_per_month,
            'ranap_per_month' => $ranap_per_month,
            'khitan_per_month' => $khitan_per_month,
            'persalinan_per_month' => $persalinan_per_month
        ]);
    }

    /**
     * Api Untuk dashboard Layanan Rajal 
     */
    public function dash_layanan_rajal()
    {
        $current_year = date('Y');
        $current_month = date('m');
        $umum_per_month = [];
        $kb_per_month = [];
        $imunisasi_per_mont = [];
        $hamil_per_mont = [];
        $sehat_per_mont = [];
        
        for ($month = 1; $month <= $current_month; $month++) {
            $first_day_of_month = date('Y-m-01', strtotime("$current_year-$month-01"));
            $last_day_of_month = date('Y-m-t', strtotime("$current_year-$month-01"));
            $umum_count = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->where('poli','Poli Umum')->count();
            $umum_per_month[$month] = $umum_count;
            $kb_count = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->where('poli','KB')->count();
            $kb_per_month[$month] = $kb_count;
            $imunisasi_count = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->where('poli','Imunisasi')->count();
            $imunisasi_per_month[$month] = $imunisasi_count;
            $sehat_count = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->where('poli','Keterangan Sehat')->count();
            $sehat_per_month[$month] = $sehat_count;
            $hamil_count = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->where('poli','Ibu Hamil')->count();
            $hamil_per_month[$month] = $hamil_count;
        }
        return response()->json([
            'umum_per_month' => $umum_per_month,
            'kb_per_month' => $kb_per_month,
            'imunisasi_per_month' => $imunisasi_per_month,
            'sehat_per_month' => $sehat_per_month,
            'hamil_per_month' => $hamil_per_month
        ]);
    }
    // public function dash_layanan_rajal_bar()
    // {
    //     $years = DatasetRajal::selectRaw('YEAR(tgl_kunjungan) as year')->distinct()->pluck('year');

    //     $data = [];
    //     foreach ($years as $year) {
    //         $umum_count = DatasetRajal::whereYear('tgl_kunjungan', $year)->where('poli', 'Umum')->count();
    //         $kb_count = DatasetRajal::whereYear('tgl_kunjungan', $year)->where('poli', 'KB')->count();
    //         $imunisasi_count = DatasetRajal::whereYear('tgl_kunjungan', $year)->where('poli', 'Imunisasi')->count();
    //         $sehat_count = DatasetRajal::whereYear('tgl_kunjungan', $year)->where('poli', 'Keterangan Sehat')->count();
    //         $hamil_count = DatasetRajal::whereYear('tgl_kunjungan', $year)->where('poli', 'Ibu Hamil')->count();

    //         $data[$year] = [
    //             'Umum' => $umum_count,
    //             'KB' => $kb_count,
    //             'Imunisasi' => $imunisasi_count,
    //             'Keterangan Sehat' => $sehat_count,
    //             'Ibu Hamil' => $hamil_count,
    //         ];
    //     }

    //     return response()->json($data);
    // }
    public function dash_layanan_rajal_bar()
    {
        $years = DatasetRajal::selectRaw('YEAR(tgl_kunjungan) as year')
            ->distinct()
            ->pluck('year')
            ->toArray();
        $data = [];
        $polis = ['Umum', 'KB', 'Imunisasi', 'Keterangan Sehat', 'Ibu Hamil'];
        foreach ($years as $year) {
            $data[$year] = [];
            foreach ($polis as $poli) {
                $data[$year][$poli] = 0;
            }
        }
        $visits = DatasetRajal::selectRaw('YEAR(tgl_kunjungan) as year, poli, COUNT(*) as count')
            ->groupBy('year', 'poli')
            ->get();
        foreach ($visits as $visit) {
            $data[$visit->year][$visit->poli] = $visit->count;
        }

        return response()->json($data);
    }

    public function dash_layanan_ranap_line()
    {
        $current_year = date('Y');
        $current_month = date('m');
        $umum_per_month = [];
        $persalinan_per_month = [];

        for ($month = 1; $month <= $current_month; $month++) {
            $first_day_of_month = date('Y-m-01', strtotime("$current_year-$month-01"));
            $last_day_of_month = date('Y-m-t', strtotime("$current_year-$month-01"));
            $umum_count = DatasetRanap::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->where('poli','Poli Umum')->count();
            $umum_per_month[$month] = $umum_count;
            $persalinan_count = DatasetRanap::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->where('poli','Persalinan')->count();
            $persalinan_per_month[$month] = $persalinan_count;
        }
        return response()->json([
            'umum_per_month' => $umum_per_month,
            'persalinan_per_month' => $persalinan_per_month,
        ]);
    }

    public function dash_layanan_ranap_bar()
{
    $current_year = date('Y');
    
    $umum_count = [];
    $persalinan_count = [];
    $persentase = [];

    for ($year = $current_year - 7; $year <= $current_year; $year++) {
        $umum = DatasetRanap::whereYear('tgl_kunjungan', $year)->where('poli','Umum')->count();
        $persalinan = DatasetRanap::whereYear('tgl_kunjungan', $year)->where('poli','Persalinan')->count();
        $total = $umum + $persalinan;

        $umum_count[] = $umum;
        $persalinan_count[] = $persalinan;
        $persentase[] = $total > 0 ? round(($persalinan / $total) * 100, 1) : 0; // Bulatkan ke 1 angka desimal
    }

    // Mengembalikan data dalam format JSON
    return response()->json([
        'umum_count' => $umum_count,
        'persalinan_count' => $persalinan_count,
        'persentase' => $persentase,
        'years' => range($current_year - 7, $current_year),
    ]);
}

        
}
