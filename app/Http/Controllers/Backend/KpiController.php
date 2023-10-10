<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kpi;
use App\Models\User;

class KpiController extends Controller
{
    public function index ()
    {
        $title = 'KPI';
        $kpi = kpi::all();
        $user = User::all();
        return view ('template.backend.admin.kpi.index',compact('title','kpi'));
    }

    public function create()
    {
        $title = 'Tambah KPI';
        return view('template.backend.admin.kpi.create',compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'user_id' =>'required',
            // 'div' => 'required',
            // 'daftar' => 'required',
            // 'poli' => 'required'
        ]);

        $kpi = new kpi;
        $kpi ->user_id = 1;
        $kpi ->div = 'Software Enginer';
        //request input
        $daftarValue = $request->input('daftar', []);
        $poliValue = $request->input('poli', []);
        $farmasiValue = $request->input('farmasi', []);
        $kasirValue = $request->input('kasir', []);
        $careValue = $request->input('care', []);
        $bpjsValue = $request->input('bpjs', []);
        $khitanValue = $request->input('khitan', []);
        $rawatValue = $request->input('rawat', []);
        $persalinanValue = $request->input('persalinan', []);
        $labValue = $request->input('lab', []);
        $umumValue = $request->input('umum', []);
        $visitValue = $request->input('visit', []);
        $layananValue = $request->input('layanan', []);
        $akuntanValue = $request->input('akuntan', []);
        $kompetenValue = $request->input('kompeten', []);
        $harmonisValue = $request->input('harmonis', []);
        $loyalValue = $request->input('loyal', []);
        $adaptifValue = $request->input('adaptif', []);
        $kolaboratifValue = $request->input('kolaboratif', []);
        $absenValue = $request->input('absen', []);
        
        //total
        $totaldaftar = !empty($daftarValue) ? array_sum($daftarValue) : 0;
        $totalpoli = !empty($poliValue) ? array_sum($poliValue) : 0;
        $totalfarmsai = !empty($farmasiValue) ? array_sum($farmasiValue) : 0;
        $totalkasir = !empty($kasirValue) ? array_sum($kasirValue) : 0;
        $totalcare = !empty($careValue) ? array_sum($careValue) : 0;
        $totalbpjs = !empty($bpjsValue) ? array_sum($bpjsValue) : 0;
        $totalkhitan = !empty($khitanValue) ? array_sum($khitanValue) : 0;
        $totalrawat = !empty($rawatValue) ? array_sum($rawatValue) : 0;
        $totalpersalinan = !empty($persalinanValue) ? array_sum($persalinanValue) : 0;
        $totallab = !empty($labValue) ? array_sum($labValue) : 0;
        $totalumum = !empty($umumValue) ? array_sum($umumValue) : 0;
        $totalvisit = !empty($visitValue) ? array_sum($visitValue) : 0;
        $totallayanan = !empty($layananValue) ? array_sum($layananValue) : 0;
        $totalakuntan = !empty($akuntanValue) ? array_sum($akuntanValue) : 0;
        $totalkompeten = !empty($kompetenValue) ? array_sum($kompetenValue) : 0;
        $totalharmonis = !empty($harmonisValue) ? array_sum($harmonisValue) : 0;
        $totalloyal = !empty($loyalValue) ? array_sum($loyalValue) : 0;
        $totaladaptif = !empty($adaptifValue) ? array_sum($adaptifValue) : 0;
        $totalkolaboratif = !empty($kolaboratifValue) ? array_sum($kolaboratifValue) : 0;
        $totalabsen = !empty($absenValue) ? array_sum($absenValue) : 0;

        //save
        $kpi->daftar = $totaldaftar;
        $kpi->poli = $totalpoli;
        $kpi ->farmasi = $totalfarmsai;
        $kpi ->kasir = $totalkasir;

        $kpi ->care = $totalcare;
        $kpi ->bpjs = $totalbpjs;
        $kpi ->khitan = $totalkhitan;
        $kpi ->rawat = $totalrawat;

        $kpi ->persalinan = $totalpersalinan;
        $kpi ->lab = $totallab;
        $kpi ->umum = $totalumum;
        $kpi ->visit = $totalvisit;

        $kpi ->layanan = $totallayanan;
        $kpi ->akuntan = $totalakuntan;
        $kpi ->kompeten = $totalkompeten;
        $kpi ->harmonis = $totalharmonis;

        $kpi ->loyal = $totalloyal;
        $kpi ->adaptif = $totaladaptif;
        $kpi ->kolaboratif = $totalkolaboratif;
        $kpi ->absen = $totalabsen;
        $kpi->total = 
        $totaldaftar + $totalpoli + $totalfarmsai + $totalkasir +
        $totalcare + $totalbpjs + $totalkhitan + $totalrawat +
        $totalpersalinan + $totallab + $totalumum + $totalvisit +
        $totallayanan + $totalakuntan + $totalkompeten + $totalharmonis +
        $totalloyal + $totaladaptif + $totalkolaboratif + $totalabsen;

        $kpi->total_kinerja = 
        ($totaldaftar + $totalpoli + $totalfarmsai + $totalkasir +
        $totalcare + $totalbpjs + $totalkhitan + $totalrawat +
        $totalpersalinan + $totallab + $totalumum + $totalvisit +
        $totallayanan + $totalakuntan + $totalkompeten + $totalharmonis +
        $totalloyal + $totaladaptif + $totalkolaboratif + $totalabsen)/10;

        $kpi ->ket = 'melampaui';
        $kpi ->bulan =now();
        $kpi ->save();
        // return $kpi;
        return redirect('/KPI');

    }
}
