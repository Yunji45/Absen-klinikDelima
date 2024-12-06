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
use App\Models\KodeWilayah;
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

    public function GetAvailableYears_layanan()
    {
        // Mengambil tahun kunjungan dari masing-masing tabel dan menyatukan hasilnya
        $years = DatasetRajal::selectRaw('YEAR(tgl_kunjungan) as year')
            ->union(
                DatasetRanap::selectRaw('YEAR(tgl_kunjungan) as year')
            )
            ->union(
                DatasetKhitan::selectRaw('YEAR(tgl_kunjungan) as year')
            )
            ->union(
                DatasetLab::selectRaw('YEAR(tgl_kunjungan) as year')
            )
            ->union(
                DatasetUsg::selectRaw('YEAR(tgl_kunjungan) as year')
            )
            ->union(
                DatasetEstetika::selectRaw('YEAR(tgl_kunjungan) as year')
            )

            ->distinct()
            ->orderBy('year', 'asc')
            ->pluck('year');
    
        // Mengembalikan hasil sebagai respons JSON
        return response()->json($years);
    }
    
    public function search_layanan(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $rajal_per_month = [];
        $ranap_per_month = [];
        $khitan_per_month = [];
        $lab_per_month = [];
        $usg_per_month = [];
        $estetika_per_month = [];

        for ($month = 1; $month <= 12; $month++) {
            $first_day_of_month = date('Y-m-01', strtotime("$year-$month-01"));
            $last_day_of_month = date('Y-m-t', strtotime("$year-$month-01"));

            $rajal_per_month[$month] = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->count();
            $ranap_per_month[$month] = DatasetRanap::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->count();
            $khitan_per_month[$month] = DatasetKhitan::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                    ->count();
            $lab_per_month[$month] = DatasetLab::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->count();
            $usg_per_month[$month] = DatasetUsg::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->count();
            $estetika_per_month[$month] = DatasetEstetika::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->count();

        }

        // Mengembalikan hasil sebagai respons JSON
        return response()->json([
            'rajal_per_month' => $rajal_per_month,
            'ranap_per_month' => $ranap_per_month,
            'khitan_per_month' => $khitan_per_month,
            'lab_per_month' => $lab_per_month,
            'usg_per_month' => $usg_per_month,
            'estetika_per_month' => $estetika_per_month,
        ]);
    }

    public function dash_layanan_pie(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $rajal_per_month = [];
        $ranap_per_month = [];
        $khitan_per_month = [];
        $lab_per_month = [];
        $usg_per_month = [];
        $estetika_per_month = [];

        for ($month = 1; $month <= 12; $month++) {
            $first_day_of_month = date('Y-m-01', strtotime("$year-$month-01"));
            $last_day_of_month = date('Y-m-t', strtotime("$year-$month-01"));

            $rajal_per_month[$month] = DatasetRajal::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
            $ranap_per_month[$month] = DatasetRanap::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
            $khitan_per_month[$month] = DatasetKhitan::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
            $lab_per_month[$month] = DatasetLab::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
            $usg_per_month[$month] = DatasetUsg::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
            $estetika_per_month[$month] = DatasetEstetika::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])->count();
        }

        // Menghitung total kunjungan per kategori layanan
        $total_rajal = array_sum($rajal_per_month);
        $total_ranap = array_sum($ranap_per_month);
        $total_khitan = array_sum($khitan_per_month);
        $total_lab = array_sum($lab_per_month);
        $total_usg = array_sum($usg_per_month);
        $total_estetika = array_sum($estetika_per_month);

        $pie_data = [
            'series' => [$total_rajal, $total_ranap, $total_khitan, $total_lab, $total_usg, $total_estetika],
            'labels' => ["Rawat Jalan", "Rawat Inap", "Khitan", "Laboratorium", "USG", "Estetika"]
        ];

        // Mengembalikan data dalam format JSON
        return response()->json($pie_data);
    }

    public function dash_layanan_piramid()
    {
        // Mengambil tahun dari semua tabel dan membuat daftar tahun unik
        $years = DatasetRajal::selectRaw('YEAR(tgl_kunjungan) as year')
            ->union(DatasetRanap::selectRaw('YEAR(tgl_kunjungan) as year'))
            ->union(DatasetKhitan::selectRaw('YEAR(tgl_kunjungan) as year'))
            ->union(DatasetUsg::selectRaw('YEAR(tgl_kunjungan) as year'))
            ->union(DatasetLab::selectRaw('YEAR(tgl_kunjungan) as year'))
            ->union(DatasetEstetika::selectRaw('YEAR(tgl_kunjungan) as year'))
            ->distinct()
            ->pluck('year')
            ->toArray();
        
        // Inisialisasi data dengan tahun dan kategori yang tersedia
        $data = [];
        $categories = ['Rajal', 'Ranap', 'Khitan', 'USG', 'Lab', 'Estetika'];
        foreach ($years as $year) {
            $data[$year] = [];
            foreach ($categories as $category) {
                $data[$year][$category] = 0;
            }
        }
        
        // Fungsi untuk menggabungkan data dari tabel
        function addVisitsData($model, $category, &$data) {
            $visits = $model::selectRaw('YEAR(tgl_kunjungan) as year, COUNT(*) as count')
                ->groupBy('year')
                ->get();
            foreach ($visits as $visit) {
                if (isset($data[$visit->year][$category])) {
                    $data[$visit->year][$category] += $visit->count;
                }
            }
        }
    
        // Mengambil data kunjungan dari setiap tabel
        addVisitsData(DatasetRajal::class, 'Rajal', $data);
        addVisitsData(DatasetRanap::class, 'Ranap', $data);
        addVisitsData(DatasetKhitan::class, 'Khitan', $data);
        addVisitsData(DatasetUsg::class, 'USG', $data);
        addVisitsData(DatasetLab::class, 'Lab', $data);
        addVisitsData(DatasetEstetika::class, 'Estetika', $data);
    
        return response()->json($data);
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

    public function GetAvailableYears_ranap()
    {
        $years = DatasetRanap::selectRaw('YEAR(tgl_kunjungan) as year')
            ->distinct()
            ->orderBy('year', 'asc')
            ->pluck('year');

        return response()->json($years);
    }

    public function search_layanan_ranap(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $umum_per_month = [];
        $persalinan_per_month = [];

        for ($month = 1; $month <= 12; $month++) {
            $first_day_of_month = date('Y-m-01', strtotime("$year-$month-01"));
            $last_day_of_month = date('Y-m-t', strtotime("$year-$month-01"));

            $umum_per_month[$month] = DatasetRanap::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->where('poli', 'Umum')
                                                ->count();
            $persalinan_per_month[$month] = DatasetRanap::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->where('poli', 'Persalinan')
                                                ->count();
        }

        // Mengembalikan hasil sebagai respons JSON
        return response()->json([
            'umum_per_month' => $umum_per_month,
            'persalinan_per_month' => $persalinan_per_month,
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

    public function GetAvailableYears_khitan()
    {
        $years = DatasetKhitan::selectRaw('YEAR(tgl_kunjungan) as year')
            ->distinct()
            ->orderBy('year', 'asc')
            ->pluck('year');

        return response()->json($years);
    }

    public function search_layanan_khitan(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $khitan_per_month = [];

        for ($month = 1; $month <= 12; $month++) {
            $first_day_of_month = date('Y-m-01', strtotime("$year-$month-01"));
            $last_day_of_month = date('Y-m-t', strtotime("$year-$month-01"));

            $khitan_per_month[$month] = DatasetKhitan::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                ->where('poli', 'Khitan')
                                                ->count();
        }

        // Mengembalikan hasil sebagai respons JSON
        return response()->json([
            'khitan_per_month' => $khitan_per_month,
        ]);
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

     public function GetAvailableYears_lab()
     {
         $years = DatasetLab::selectRaw('YEAR(tgl_kunjungan) as year')
             ->distinct()
             ->orderBy('year', 'asc')
             ->pluck('year');
 
         return response()->json($years);
     }

     public function search_layanan_lab(Request $request)
     {
         $year = $request->input('year', date('Y'));
 
         $lab_per_month = [];
 
         for ($month = 1; $month <= 12; $month++) {
             $first_day_of_month = date('Y-m-01', strtotime("$year-$month-01"));
             $last_day_of_month = date('Y-m-t', strtotime("$year-$month-01"));
 
             $lab_per_month[$month] = DatasetLab::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                 ->where('poli', 'LABORATORIUM')
                                                 ->count();
         }
 
         // Mengembalikan hasil sebagai respons JSON
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
     
         $data = [];
         $totalPerYear = [];
     
         foreach ($years as $year) {
             $data[$year] = [
                 'Laki-laki' => 0,
                 'Perempuan' => 0
             ];
             $totalPerYear[$year] = 0;
         }
     
         $visits = DatasetLab::selectRaw('YEAR(tgl_kunjungan) as year, jenis_kelamin, COUNT(*) as count')
             ->groupBy('year', 'jenis_kelamin')
             ->get();
     
         foreach ($visits as $visit) {
             $data[$visit->year][$visit->jenis_kelamin] += $visit->count;
             $totalPerYear[$visit->year] += $visit->count;
         }
     
         $response = [
             'years' => $years,
             'series' => [
                 [
                     'name' => 'Laki-laki',
                     'data' => array_column($data, 'Laki-laki')
                 ],
                 [
                     'name' => 'Perempuan',
                     'data' => array_column($data, 'Perempuan')
                 ],
                 [
                     'name' => 'Total',
                     'data' => array_values($totalPerYear)
                 ]
             ]
         ];
     
         return response()->json($response);
     }
          
     /**
      * Api untuk USG
      */
    
     public function GetAvailableYears_usg()
     {
         $years = DatasetUsg::selectRaw('YEAR(tgl_kunjungan) as year')
             ->distinct()
             ->orderBy('year', 'asc')
             ->pluck('year');
 
         return response()->json($years);
     }

     public function search_layanan_usg(Request $request)
     {
         $year = $request->input('year', date('Y'));
 
         $usg_per_month = [];
 
         for ($month = 1; $month <= 12; $month++) {
             $first_day_of_month = date('Y-m-01', strtotime("$year-$month-01"));
             $last_day_of_month = date('Y-m-t', strtotime("$year-$month-01"));
 
             $usg_per_month[$month] = DatasetUsg::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                 ->where('poli', 'USG')
                                                 ->count();
         }
 
         // Mengembalikan hasil sebagai respons JSON
         return response()->json([
             'usg_per_month' => $usg_per_month,
         ]);
     }


     public function dash_layanan_usg_bar()
     {
         $years = DatasetUsg::selectRaw('YEAR(tgl_kunjungan) as year')
             ->distinct()
             ->pluck('year')
             ->toArray();
     
         $data = [];
         $totalPerYear = [];
     
         foreach ($years as $year) {
             $data[$year] = [
                 'Perempuan' => 0
             ];
             $totalPerYear[$year] = 0;
         }
     
         $visits = DatasetUsg::selectRaw('YEAR(tgl_kunjungan) as year, COUNT(*) as count')
             ->where('jenis_kelamin', 'Perempuan')
             ->groupBy('year')
             ->get();
     
         foreach ($visits as $visit) {
             $data[$visit->year]['Perempuan'] += $visit->count;
             $totalPerYear[$visit->year] += $visit->count;
         }
     
         $response = [
             'years' => $years,
             'series' => [
                 [
                     'name' => 'Perempuan',
                     'data' => array_column($data, 'Perempuan')
                 ],
                 [
                     'name' => 'Total',
                     'data' => array_values($totalPerYear)
                 ]
             ]
         ];
     
         return response()->json($response);
     }
     
    /**
      * Api untuk Estetika
      */

      public function GetAvailableYears_estetika()
      {
          $years = DatasetEstetika::selectRaw('YEAR(tgl_kunjungan) as year')
              ->distinct()
              ->orderBy('year', 'asc')
              ->pluck('year');
  
          return response()->json($years);
      }
 
      public function search_layanan_estetika(Request $request)
      {
          $year = $request->input('year', date('Y'));
  
          $esteika_per_month = [];
  
          for ($month = 1; $month <= 12; $month++) {
              $first_day_of_month = date('Y-m-01', strtotime("$year-$month-01"));
              $last_day_of_month = date('Y-m-t', strtotime("$year-$month-01"));
  
              $estetika_per_month[$month] = DatasetEstetika::whereBetween('tgl_kunjungan', [$first_day_of_month, $last_day_of_month])
                                                  ->where('poli', 'Estetika')
                                                  ->count();
          }
  
          // Mengembalikan hasil sebagai respons JSON
          return response()->json([
              'estetika_per_month' => $estetika_per_month,
          ]);
      }
 
 
      public function dash_layanan_estetika_bar()
      {
          $years = DatasetEstetika::selectRaw('YEAR(tgl_kunjungan) as year')
              ->distinct()
              ->pluck('year')
              ->toArray();
      
          $data = [];
          $totalPerYear = [];
      
          foreach ($years as $year) {
              $data[$year] = [
                  'Laki-laki' => 0,
                  'Perempuan' => 0
              ];
              $totalPerYear[$year] = 0;
          }
      
          $visits = DatasetEstetika::selectRaw('YEAR(tgl_kunjungan) as year, jenis_kelamin, COUNT(*) as count')
              ->groupBy('year', 'jenis_kelamin')
              ->get();
      
          foreach ($visits as $visit) {
              $data[$visit->year][$visit->jenis_kelamin] += $visit->count;
              $totalPerYear[$visit->year] += $visit->count;
          }
      
          $response = [
              'years' => $years,
              'series' => [
                  [
                      'name' => 'Laki-laki',
                      'data' => array_column($data, 'Laki-laki')
                  ],
                  [
                      'name' => 'Perempuan',
                      'data' => array_column($data, 'Perempuan')
                  ],
                  [
                      'name' => 'Total',
                      'data' => array_values($totalPerYear)
                  ]
              ]
          ];
      
          return response()->json($response);
      }

      //GEOJSON
      public function GeoJson()
      {
        $wilayahs = KodeWilayah::all();
        $features = [];

        // Iterasi melalui setiap wilayah
        foreach ($wilayahs as $wilayah) {
            $rajalCount = DatasetRajal::where('kode_wilayah', $wilayah->kode)->count();
            $ranapCount = DatasetRanap::where('kode_wilayah', $wilayah->kode)->count();
            $khitanCount = DatasetKhitan::where('kode_wilayah', $wilayah->kode)->count();
            $usgCount = DatasetUsg::where('kode_wilayah', $wilayah->kode)->count();
            $labCount = DatasetLab::where('kode_wilayah', $wilayah->kode)->count();
            $estetikaCount = DatasetEstetika::where('kode_wilayah', $wilayah->kode)->count();

            // Membuat fitur GeoJSON untuk wilayah
            $features[] = [
                "type" => "Feature",
                "id" => $wilayah->kode,
                "properties" => [
                    "name" => $wilayah->wilayah,
                    "rajal" => $rajalCount,
                    "ranap" => $ranapCount,
                    "khitan" => $khitanCount,
                    "usg" => $usgCount,
                    "lab" => $labCount,
                    "estetika" => $estetikaCount
                ],
                "geometry" => [
                    "type" => "Point",
                    "coordinates" => [$wilayah->longitude, $wilayah->latitude]
                ]
            ];
        }

        // Membuat koleksi fitur GeoJSON
        $geoJson = [
            "type" => "FeatureCollection",
            "features" => $features
        ];

        // Mengembalikan data GeoJSON sebagai response JSON
        return response()->json($geoJson);
      }
    
}
