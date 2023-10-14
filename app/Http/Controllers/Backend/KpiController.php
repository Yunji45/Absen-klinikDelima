<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kpi;
use App\Models\User;
use App\Models\presensi;

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
        $user = User::all();
        return view('template.backend.admin.kpi.create',compact('title','user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' =>'required',
            'jabatan' => 'required',
            'div' => 'required',
            'nama_atasan' => 'required',
            'div_atasan' => 'required',
            'jabatan_atasan' => 'required',
            'target' => 'required',
            // 'daftar' => 'required',
            // 'poli' => 'required'
        ]);

        $kpi = new kpi;
        $kpi ->user_id = $request->user_id;
        $kpi ->jabatan = $request->jabatan;
        $kpi->div = $request->div;
        $kpi->nama_atasan = $request->nama_atasan;
        $kpi->jabatan_atasan = $request->jabatan_atasan;
        $kpi->div_atasan = $request->div_atasan;
        $kpi->target = $request->target;
        // $kpi ->div = 'Software Enginer';
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
        // $kpi ->absen = $totalabsen;
        //ambil data id User
        $user_id = $request->user_id;
        // Menghitung total jumlah masuk berdasarkan user_id
        $totalMasuk = Presensi::where('user_id', $user_id)
        ->where('keterangan', 'Masuk')
        ->count();
        // Menghitung total "Telat" berdasarkan user_id
        $totalTelat = Presensi::where('user_id', $user_id)
            ->where('keterangan', 'Telat')
            ->count();
        $totalabsen = ($totalMasuk + $totalTelat);
    
        // Menyimpan total jumlah masuk ke dalam $kpi->absen
        $kpi->absen = $totalabsen;

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
        $totalloyal + $totaladaptif + $totalkolaboratif + $totalabsen)/$request->target;

        // $kpi ->ket = 'melampaui';
        if ($kpi->total_kinerja / $request->target == 1) {
            $kpi->ket = 'Sesuai';
        } elseif ($kpi->total_kinerja / $request->target > 1) {
            $kpi->ket = 'Melampaui';
        } else {
            $kpi->ket = 'Dibawah';
        }
        $kpi ->bulan = $request->bulan;
        $kpi ->save();
        // return $kpi;
        if ($kpi){
            return redirect('/KPI')->with('success', 'Data Berhasil di Tambahkan');
        }else{
            return redirect()->back()->with('error', 'Data Gagal di Tambahkan');
        }
        // return redirect('/KPI')->with('success', 'Data Berhasil di Tambahkan');

    }

    public function destroy($id)
    {
        $kpi = kpi::find($id);
        $kpi->delete();
        return redirect()->back()->with('success','Data Berhasil di Hapus');
    }
}
