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
}
