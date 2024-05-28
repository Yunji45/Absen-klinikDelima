<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DatasetRajal;
use App\Models\DatasetRanap;
use App\Models\DatasetKhitan;
use App\Models\DatasetPersalinan;
use App\Models\DatasetLab;
use App\Models\DatasetUsg;
use App\Models\DatasetEstetika;
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

    public function dash_layanan_pie()
    {
        $current_year = date('Y');
        $current_month = date('m');
        $rajal_per_month = [];
        $ranap_per_month = [];
        $khitan_per_month = [];
        $persalinan_per_month = [];
        
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

        // Menghitung total kunjungan per kategori layanan
        $total_rajal = array_sum($rajal_per_month);
        $total_ranap = array_sum($ranap_per_month);
        $total_khitan = array_sum($khitan_per_month);
        $total_persalinan = array_sum($persalinan_per_month);

        // Menyiapkan data dalam format yang diharapkan oleh fungsi pie_chart()
        $pie_data = [
            'series' => [$total_rajal, $total_ranap, $total_khitan, $total_persalinan],
            'labels' => ["Rawat Jalan", "Rawat Inap", "Khitan", "Persalinan"]
        ];

        // Mengembalikan data dalam format JSON
        return response()->json($pie_data);
    }

    public function dash_layanan_piramid()
    {
        $rajal_count = DatasetRajal::count();
        $ranap_count = DatasetRanap::count();
        $khitan_count = DatasetKhitan::count();
        $persalinan_count = DatasetPersalinan::count();

        $data_for_bar_chart = [
            'categories' => ["Rawat Jalan", "Rawat Inap", "Khitan", "Laboratorium", "USG", "Estetika"],
            'series' => [
                [
                    'name' => '',
                    'data' => [$rajal_count, $ranap_count, $khitan_count, $persalinan_count],
                ],
            ],
        ];

        // arsort($data_for_bar_chart['series'][0]['data']);
        // $sorted_categories = [];
        // foreach ($data_for_bar_chart['series'][0]['data'] as $key => $value) {
        //     $sorted_categories[] = $data_for_bar_chart['categories'][$key];
        // }
        // $data_for_bar_chart['categories'] = $sorted_categories;    

        return response()->json($data_for_bar_chart);
    }

    public function dash_layanan_gender()
    {
        // Ambil tahun dari masing-masing model
        $yearsKhitan = DatasetKhitan::selectRaw('YEAR(jenis_kelamin) as year')
            ->distinct()
            ->pluck('year')
            ->toArray();

        $yearsRanap = DatasetRanap::selectRaw('YEAR(jenis_kelamin) as year')
            ->distinct()
            ->pluck('year')
            ->toArray();

        $yearsRajal = DatasetRajal::selectRaw('YEAR(jenis_kelamin) as year')
            ->distinct()
            ->pluck('year')
            ->toArray();

        // Inisialisasi data untuk setiap model
        $dataKhitan = [];
        $dataRanap = [];
        $dataRajal = [];

        // Proses data untuk model Khitan
        foreach ($yearsKhitan as $year) {
            $dataKhitan[$year] = [
                'Laki-laki' => 0,
                'Perempuan' => 0,
            ];
        }

        $visitsKhitan = DatasetKhitan::selectRaw('YEAR(jenis_kelamin) as year, jenis_kelamin, COUNT(*) as count')
            ->groupBy('year', 'jenis_kelamin')
            ->get();
        foreach ($visitsKhitan as $visit) {
            $dataKhitan[$visit->year][$visit->jenis_kelamin] += $visit->count;
        }

        // Proses data untuk model Ranap
        foreach ($yearsRanap as $year) {
            $dataRanap[$year] = [
                'Laki-laki' => 0,
                'Perempuan' => 0,
            ];
        }

        $visitsRanap = DatasetRanap::selectRaw('YEAR(jenis_kelamin) as year, jenis_kelamin, COUNT(*) as count')
            ->groupBy('year', 'jenis_kelamin')
            ->get();
        foreach ($visitsRanap as $visit) {
            $dataRanap[$visit->year][$visit->jenis_kelamin] += $visit->count;
        }

        // Proses data untuk model Rajal
        foreach ($yearsRajal as $year) {
            $dataRajal[$year] = [
                'Laki-laki' => 0,
                'Perempuan' => 0,
            ];
        }

        $visitsRajal = DatasetRajal::selectRaw('YEAR(jenis_kelamin) as year, jenis_kelamin, COUNT(*) as count')
            ->groupBy('year', 'jenis_kelamin')
            ->get();
        foreach ($visitsRajal as $visit) {
            $dataRajal[$visit->year][$visit->jenis_kelamin] += $visit->count;
        }

        return response()->json([
            'khitan' => $dataKhitan,
            'ranap' => $dataRanap,
            'rajal' => $dataRajal,
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

    public function GetAvailableYears()
    {
        $years = DatasetRajal::selectRaw('YEAR(tgl_kunjungan) as year')
            ->distinct()
            ->orderBy('year', 'asc')
            ->pluck('year');

        return response()->json($years);
    }

    public function search_layanan_rajal(Request $request)
    {
        // Mendapatkan tahun dari parameter request, atau gunakan tahun saat ini jika tidak ada parameter
        $year = $request->input('year', date('Y'));

        // Mengatur array untuk menyimpan hasil
        $umum_per_month = [];
        $kb_per_month = [];
        $imunisasi_per_month = [];
        $hamil_per_month = [];
        $sehat_per_month = [];

        // Iterasi untuk setiap bulan dalam tahun yang dipilih
        for ($month = 1; $month <= 12; $month++) {
            $first_day_of_month = date('Y-m-01', strtotime("$year-$month-01"));
            $last_day_of_month = date('Y-m-t', strtotime("$year-$month-01"));

            // Menghitung jumlah kunjungan per poli per bulan
            $umum_per_month[$month] = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->where('poli', 'Poli Umum')
                                                ->count();
            $kb_per_month[$month] = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->where('poli', 'KB')
                                                ->count();
            $imunisasi_per_month[$month] = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                    ->where('poli', 'Imunisasi')
                                                    ->count();
            $sehat_per_month[$month] = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->where('poli', 'Keterangan Sehat')
                                                ->count();
            $hamil_per_month[$month] = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->where('poli', 'Ibu Hamil')
                                                ->count();
        }

        // Mengembalikan hasil sebagai respons JSON
        return response()->json([
            'umum_per_month' => $umum_per_month,
            'kb_per_month' => $kb_per_month,
            'imunisasi_per_month' => $imunisasi_per_month,
            'sehat_per_month' => $sehat_per_month,
            'hamil_per_month' => $hamil_per_month,
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

    /**
     * Api Untuk Layanan Rawat Inap
     */

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

    /**
     * Api Untuk Layanan Khitan
     */

    public function dash_layanan_khitan_line()
    {
        $current_year = date('Y');
        $current_month = date('m');
        $khitan_per_month = [];

        for ($month = 1; $month <= $current_month; $month++) {
            $first_day_of_month = date('Y-m-01', strtotime("$current_year-$month-01"));
            $last_day_of_month = date('Y-m-t', strtotime("$current_year-$month-01"));
            $khitan_count = DatasetKhitan::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->where('poli','Khitan')->count();
            $khitan_per_month[$month] = $khitan_count;
        }
        return response()->json([
            'khitan_per_month' => $khitan_per_month,
        ]);
    }

    public function dash_layanan_khitan_bar()
    {
        $years = DatasetKhitan::selectRaw('YEAR(tgl_kunjungan) as year')
            ->distinct()
            ->pluck('year')
            ->toArray();
        $data = [];
        $polis = ['Khitan'];
        foreach ($years as $year) {
            $data[$year] = [];
            foreach ($polis as $poli) {
                $data[$year][$poli] = 0;
            }
        }
        $visits = DatasetKhitan::selectRaw('YEAR(tgl_kunjungan) as year, poli, COUNT(*) as count')
            ->groupBy('year', 'poli')
            ->get();
        foreach ($visits as $visit) {
            $data[$visit->year][$visit->poli] = $visit->count;
        }

        return response()->json($data);
    }

    /**
     * Api Untuk Laboratorium
     */

     public function dash_layanan_lab_line()
     {
        $current_year = date('Y');
        $current_month = date('m');
        $lab_per_month = [];

        for ($month = 1; $month <= $current_month; $month++) {
            $first_day_of_month = date('Y-m-01', strtotime("$current_year-$month-01"));
            $last_day_of_month = date('Y-m-t', strtotime("$current_year-$month-01"));
            $lab_count = DatasetLab::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->where('poli','LABORATORIUM')->count();
            $lab_per_month[$month] = $lab_count;
        }
        return response()->json([
            'lab_per_month' => $lab_per_month,
        ]);
     }

    public function dash_layanan_lab_bar()
    {
        $years = DatasetLab::selectRaw('YEAR(tgl_kunjungan) as year')
            ->distinct()
            ->pluck('year')
            ->toArray();

        $genders = ['Laki-laki', 'Perempuan'];
        $polis = ['LABORATORIUM'];

        $data = [];
        foreach ($years as $year) {
            $data[$year] = [
                'total_kunjungan' => 0,
                'poli' => []
            ];
            foreach ($polis as $poli) {
                $data[$year]['poli'][$poli] = [
                    'total' => 0,
                    'Laki-laki' => 0,
                    'Perempuan' => 0
                ];
            }
        }

        $visits = DatasetLab::selectRaw('YEAR(tgl_kunjungan) as year, poli, jenis_kelamin, COUNT(*) as count')
            ->groupBy('year', 'poli', 'jenis_kelamin')
            ->get();

        foreach ($visits as $visit) {
            $data[$visit->year]['total_kunjungan'] += $visit->count;
            $data[$visit->year]['poli'][$visit->poli]['total'] += $visit->count;
            $data[$visit->year]['poli'][$visit->poli][$visit->jenis_kelamin] += $visit->count;
        }

        return response()->json($data);
    }

    //  public function dash_layanan_lab_bar()
    //  {
    //     $years = DatasetLab::selectRaw('YEAR(tgl_kunjungan) as year')
    //         ->distinct()
    //         ->pluck('year')
    //         ->toArray();
    //     $data = [];
    //     $genders = ['Laki-laki', 'Perempuan'];
    //     $polis = ['LABORATORIUM'];
    //     foreach ($years as $year) {
    //         $data[$year] = [];
    //         foreach ($polis as $poli) {
    //             $data[$year][$poli] = 0;
    //         }
    //         foreach ($genders as $gender) {
    //             $data[$year][$gender] = 0;
    //         }

    //     }
    //     $visits = DatasetLab::selectRaw('YEAR(tgl_kunjungan) as year, poli, jenis_kelamin, COUNT(*) as count')
    //         ->groupBy('year', 'poli','jenis_kelamin')
    //         ->get();
    //     foreach ($visits as $visit) {
    //         $data[$visit->year][$visit->poli][$visit->jenis_kelamin] = $visit->count;
    //     }

    //     return response()->json($data);
    //  }

     /**
      * Api untuk USG
      */

     public function dash_layanan_usg_line()
     {

     }

     public function dash_layanan_usg_bar()
     {
        
     }

    /**
      * Api untuk Estetika
      */

     public function dash_layanan_estetika_line()
     {

     }

     public function dash_layanan_estetika_bar()
     {
        
     }

}
