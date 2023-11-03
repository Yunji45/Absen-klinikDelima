<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kpi;
use App\Models\User;
use App\Models\jadwalterbaru;
use App\Models\presensi;
use App\Models\targetkpi;
use App\Models\AchKpi;
use App\Models\InsentifKpi;
use App\Models\OmsetKlinik;
use App\Models\rubahjadwal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use PDF;

class KpiController extends Controller
{
    public function index ()
    {
        $title = 'KPI';
        $type = 'kpi';
        $user = User::all();
        $bulan = date('m');
        $tahun = date('Y');
        $kpi = kpi::whereYear('bulan', $tahun)
        ->whereMonth('bulan', $bulan)
        ->orderBy('created_at', 'desc')
        ->get();    

        return view ('template.backend.admin.kpi.index',compact('title','kpi','type'));
    }

    public function SearchKpi(Request $request)
    {
        $title = 'KPI';
        $type = 'kpi';
        $user = User::all();
        $bulan = $request->input('bulan');
        $startDate = $bulan . '-01';
        $endDate = $bulan . '-31';
    
        $kpi = kpi::whereBetween('bulan', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
    
        return view ('template.backend.admin.kpi.index',compact('title','kpi','bulan','type'));
    }

    public function create()
    {                   
        // $user_id = 15;
        // $data = explode('-', '2023-10-02'); // Memisahkan string bulan menjadi array
        // $bulan = $data[1]; // Bulan
        // $tahun = $data[0]; // Tahun
        
        // $ceklis = TargetKpi::where('user_id', $user_id)
        //     ->whereMonth('bulan', $bulan)
        //     ->whereYear('bulan', $tahun)
        //     ->select('c_daftar','c_poli','c_farmasi','c_kasir','c_care','c_bpjs','c_khitan','c_rawat','c_salin','c_lab','c_umum','c_visit')
        //     ->first();
        // $kpi = kpi::where('user_id', $user_id)
        //     ->whereMonth('bulan', $bulan)
        //     ->whereYear('bulan', $tahun)
        //     ->select('daftar','poli','farmasi','kasir','care','bpjs','khitan','rawat','persalinan','lab','umum','visit',
        //             'layanan','akuntan','kompeten','harmonis','loyal','adaptif','kolaboratif','absen')
        //     ->first();

        // $jumlah = 0;
        // $jumkpi = 0;
        // if ($ceklis) {
        //     foreach ($ceklis->toArray() as $key => $value) {
        //         if ($value != 0) {
        //             $jumlah++;
        //         }
        //     }
        // }
        // if ($kpi) {
        //     foreach ($kpi->toArray() as $key => $value) {
        //         if ($value != 0) {
        //             $jumkpi++;
        //         }
        //     }
        // }

        // return $jumlah ;
        
        // $totalTelat = Presensi::where('user_id', $user_id)
        //     ->where('keterangan', 'Telat')
        //     ->whereMonth('tanggal', $bulan)
        //     ->whereYear('tanggal', $tahun)
        //     ->count();
        //     $totalabsen = ($totalMasuk + $totalTelat);
        //     return $totalabsen;
    //     $targetData = targetkpi::where('user_id', $user_id)
                                // ->whereMonth('bulan', $bulan)
                                // ->whereYear('bulan', $tahun)
                                // ->select('c_daftar', 'c_poli')
                                // ->first();
                                // return $targetData;

        // $tes = targetkpi::where('user_id', $user_id)
        //                 ->whereMonth('bulan', $bulan)
        //                 ->whereYear('bulan', $tahun)
        //                 ->pluck('r_daftar');
        //     return $tes;          
        $title = 'Tambah KPI';
        $type = 'kpi';
        $user = User::all();
        return view('template.backend.admin.kpi.create',compact('title','user','type'));
    }

    public function storeGagal(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'user_id' =>'required',
            'jabatan' => 'required',
            'div' => 'required',
            'nama_atasan' => 'required',
            'div_atasan' => 'required',
            'jabatan_atasan' => 'required',
            // 'target' => 'required'
        ],[
            'user_id.required' => 'Kolom user_id wajib diisi.',
            'jabatan.required' => 'Kolom jabatan wajib diisi.',
            'div.required' => 'Kolom div wajib diisi.',
            'nama_atasan.required' => 'Kolom nama_atasan wajib diisi.',
            'div_atasan.required' => 'Kolom div_atasan wajib diisi.',
            'jabatan_atasan.required' => 'Kolom jabatan_atasan wajib diisi.',
            // 'target.required' => 'Kolom target wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        $kpi = new kpi;
        $kpi ->user_id = $request->user_id;
        $kpi ->jabatan = $request->jabatan;
        $kpi->div = $request->div;
        $kpi->nama_atasan = $request->nama_atasan;
        $kpi->jabatan_atasan = $request->jabatan_atasan;
        $kpi->div_atasan = $request->div_atasan;
        // $kpi->target = $request->target;

        $layananValue = $request->input('layanan', []);
        $akuntanValue = $request->input('akuntan', []);
        $kompetenValue = $request->input('kompeten', []);
        $harmonisValue = $request->input('harmonis', []);
        $loyalValue = $request->input('loyal', []);
        $adaptifValue = $request->input('adaptif', []);
        $kolaboratifValue = $request->input('kolaboratif', []);
        $absenValue = $request->input('absen', []);
        
        $totallayanan = !empty($layananValue) ? array_sum($layananValue) : 0;
        $totalakuntan = !empty($akuntanValue) ? array_sum($akuntanValue) : 0;
        $totalkompeten = !empty($kompetenValue) ? array_sum($kompetenValue) : 0;
        $totalharmonis = !empty($harmonisValue) ? array_sum($harmonisValue) : 0;
        $totalloyal = !empty($loyalValue) ? array_sum($loyalValue) : 0;
        $totaladaptif = !empty($adaptifValue) ? array_sum($adaptifValue) : 0;
        $totalkolaboratif = !empty($kolaboratifValue) ? array_sum($kolaboratifValue) : 0;
        $totalabsen = !empty($absenValue) ? array_sum($absenValue) : 0;

        //save
        $user_id = $request->user_id;
        $data = explode('-', $request->bulan); // Memisahkan string bulan menjadi array
        $bulan = $data[1]; // Bulan
        $tahun = $data[0]; // Tahun

        $targetData = targetkpi::where('user_id', $user_id)
                                ->whereMonth('bulan', $bulan)
                                ->whereYear('bulan', $tahun)
                                ->select('c_daftar', 'c_poli','c_farmasi','c_bpjs','c_kasir','c_care','c_khitan','c_rawat','c_salin','c_lab','c_umum','c_visit')
                                ->first();
        if ($targetData) {
            $kpi->daftar = $targetData->c_daftar;
            $kpi->poli = $targetData->c_poli;
            $kpi->farmasi = $targetData->c_farmasi;
            $kpi->kasir = $targetData->c_kasir;
            $kpi->bpjs = $targetData->c_bpjs;
            $kpi->care = $targetData->c_care;
            $kpi->khitan = $targetData->c_khitan;
            $kpi->rawat = $targetData->c_rawat;
            $kpi->persalinan = $targetData->c_salin;
            $kpi->lab = $targetData->c_lab;
            $kpi->umum = $targetData->c_umum;
            $kpi->visit = $targetData->c_visit;
        } else {
            $kpi->daftar = 0;
            $kpi->poli = 0;
            $kpi->farmasi = 0;
            $kpi->kasir = 0;
            $kpi->bpjs = 0;
            $kpi->care = 0;
            $kpi->khitan = 0;
            $kpi->rawat = 0;
            $kpi->persalinan = 0;
            $kpi->lab = 0;
            $kpi->umum = 0;
            $kpi->visit = 0;
        }
        $kpi ->layanan = $totallayanan;
        $kpi ->akuntan = $totalakuntan;
        $kpi ->kompeten = $totalkompeten;
        $kpi ->harmonis = $totalharmonis;

        $kpi ->loyal = $totalloyal;
        $kpi ->adaptif = $totaladaptif;
        $kpi ->kolaboratif = $totalkolaboratif;
        // $kpi ->absen = $totalabsen;
        //ambil data id User
        // $user_id = $request->user_id;
        // $data = explode('-', $request->bulan); // Memisahkan string bulan menjadi array
        // $bulan = $data[1]; // Bulan
        // $tahun = $data[0]; // Tahun
        //hitung masuk
        $totalMasuk = Presensi::where('user_id', $user_id)
            ->where('keterangan', 'Masuk')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count();
        //hitung telat
        $totalTelat = Presensi::where('user_id', $user_id)
            ->where('keterangan', 'Telat')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count();
        //hitung lembur
        $lembur = rubahjadwal::where('user_id', $user_id)
                            ->where('permohonan', 'lembur')
                            ->where('status', 'approve')
                            ->whereMonth('tanggal', $bulan)
                            ->whereYear('tanggal', $tahun)
                            ->count();

        //hitung jadwal
        $psTotal = 0;
            for ($day = 1; $day <= 31; $day++) {
                $column = 'j' . $day;
                
                $psCount = jadwalterbaru::where('user_id', $user_id)
                    ->where(function ($query) use ($column) {
                        $query->whereIn($column, ['PS', 'SM', 'PM']);
                    })
                    ->whereMonth('masa_aktif', $bulan)
                    ->whereYear('masa_aktif', $tahun)        
                    ->count();
            
                $psTotal += $psCount;
            }

        session(['psTotal' => $psTotal]);
        if (!$psTotal){
            return redirect()->back()->with('error','Pegawai Tersebut Tidak Mempunyai Data Absen Pada Periode Terpilih');
        }
        $totalabsen = ($totalMasuk + $totalTelat)/$psTotal;
        if($totalabsen == 1 && $lembur > 1){
            $kpi->absen =3;
        }elseif($totalabsen == 1 ){
            $kpi->absen = 2;
        }elseif($totalabsen < 1){
            $kpi->absen =1;
        }else{
            $kpi->absen = 0;
        }
        // $kpi->absen = $totalabsen;
        $totalabsen = $kpi->absen;
        $kpi->bulan = $request->bulan;
        $kpi->total = 
        $kpi->daftar + $kpi->poli + $kpi->farmasi + $kpi->kasir +
        $kpi->bpjs + $kpi->khitan + $kpi->rawat + $kpi->persalinan +
        $kpi->lab + $kpi->umum + $kpi->visit +
        $totallayanan + $totalakuntan + $totalkompeten + $totalharmonis +
        $totalloyal + $totaladaptif + $totalkolaboratif + $totalabsen;

        $kpi->total_kinerja = 
        ($kpi->daftar + $kpi->poli + $kpi->farmasi + $kpi->kasir +
        $kpi->bpjs + $kpi->khitan + $kpi->rawat + $kpi->persalinan +
        $kpi->lab + $kpi->umum + $kpi->visit +
        $totallayanan + $totalakuntan + $totalkompeten + $totalharmonis +
        $totalloyal + $totaladaptif + $totalkolaboratif + $kpi->absen)/$kpi->target;

        // $kpi ->ket = 'melampaui';
        if ($kpi->total_kinerja / $request->target == 1) {
            $kpi->ket = 'Sesuai';
        } elseif ($kpi->total_kinerja / $request->target > 1) {
            $kpi->ket = 'Melampaui';
        } else {
            $kpi->ket = 'Dibawah';
        }
        // $kpi ->bulan = $request->bulan;
        $realisasi = targetkpi::where('user_id', $user_id)
                                ->whereMonth('bulan', $bulan)
                                ->whereYear('bulan', $tahun)
                                ->first();
        $omset = OmsetKlinik::whereMonth('bulan', $bulan)
                                    ->whereYear('bulan', $tahun)
                                    ->first();
        if ($omset) {
            return redirect()->back()->with('error', 'Performance Unit Pada Periode ' . $request->bulan . ' Sudah Final.');
        }
                                
        if ($realisasi){
            $kpi->save();
        }else{
            return redirect()->back()->with('error','Realisasi User Pada Periode '. $request->bulan .' Ini Belum Ada.');
        }
        return redirect('/KPI')->with('success', 'Data Berhasil di Tambahkan');
    }
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'user_id' =>'required',
            'jabatan' => 'required',
            'div' => 'required',
            'nama_atasan' => 'required',
            'div_atasan' => 'required',
            'jabatan_atasan' => 'required',
            // 'target' => 'required'
        ],[
            'user_id.required' => 'Kolom user_id wajib diisi.',
            'jabatan.required' => 'Kolom jabatan wajib diisi.',
            'div.required' => 'Kolom div wajib diisi.',
            'nama_atasan.required' => 'Kolom nama_atasan wajib diisi.',
            'div_atasan.required' => 'Kolom div_atasan wajib diisi.',
            'jabatan_atasan.required' => 'Kolom jabatan_atasan wajib diisi.',
            // 'target.required' => 'Kolom target wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        $kpi = new kpi;
        $kpi ->user_id = $request->user_id;
        $kpi ->jabatan = $request->jabatan;
        $kpi->div = $request->div;
        $kpi->nama_atasan = $request->nama_atasan;
        $kpi->jabatan_atasan = $request->jabatan_atasan;
        $kpi->div_atasan = $request->div_atasan;
        // $kpi->target = $request->target;

        $layananValue = $request->input('layanan', []);
        $akuntanValue = $request->input('akuntan', []);
        $kompetenValue = $request->input('kompeten', []);
        $harmonisValue = $request->input('harmonis', []);
        $loyalValue = $request->input('loyal', []);
        $adaptifValue = $request->input('adaptif', []);
        $kolaboratifValue = $request->input('kolaboratif', []);
        $absenValue = $request->input('absen', []);
        
        $totallayanan = !empty($layananValue) ? array_sum($layananValue) : 0;
        $totalakuntan = !empty($akuntanValue) ? array_sum($akuntanValue) : 0;
        $totalkompeten = !empty($kompetenValue) ? array_sum($kompetenValue) : 0;
        $totalharmonis = !empty($harmonisValue) ? array_sum($harmonisValue) : 0;
        $totalloyal = !empty($loyalValue) ? array_sum($loyalValue) : 0;
        $totaladaptif = !empty($adaptifValue) ? array_sum($adaptifValue) : 0;
        $totalkolaboratif = !empty($kolaboratifValue) ? array_sum($kolaboratifValue) : 0;
        $totalabsen = !empty($absenValue) ? array_sum($absenValue) : 0;

        //save
        $user_id = $request->user_id;
        $data = explode('-', $request->bulan); // Memisahkan string bulan menjadi array
        $bulan = $data[1]; // Bulan
        $tahun = $data[0]; // Tahun

        $targetData = targetkpi::where('user_id', $user_id)
                                ->whereMonth('bulan', $bulan)
                                ->whereYear('bulan', $tahun)
                                ->select('c_daftar', 'c_poli','c_farmasi','c_bpjs','c_kasir','c_care','c_khitan','c_rawat','c_salin','c_lab','c_umum','c_visit')
                                ->first();
        if ($targetData) {
            $kpi->daftar = $targetData->c_daftar;
            $kpi->poli = $targetData->c_poli;
            $kpi->farmasi = $targetData->c_farmasi;
            $kpi->kasir = $targetData->c_kasir;
            $kpi->bpjs = $targetData->c_bpjs;
            $kpi->care = $targetData->c_care;
            $kpi->khitan = $targetData->c_khitan;
            $kpi->rawat = $targetData->c_rawat;
            $kpi->persalinan = $targetData->c_salin;
            $kpi->lab = $targetData->c_lab;
            $kpi->umum = $targetData->c_umum;
            $kpi->visit = $targetData->c_visit;
        } else {
            $kpi->daftar = 0;
            $kpi->poli = 0;
            $kpi->farmasi = 0;
            $kpi->kasir = 0;
            $kpi->bpjs = 0;
            $kpi->care = 0;
            $kpi->khitan = 0;
            $kpi->rawat = 0;
            $kpi->persalinan = 0;
            $kpi->lab = 0;
            $kpi->umum = 0;
            $kpi->visit = 0;
        }
        $kpi ->layanan = $totallayanan;
        $kpi ->akuntan = $totalakuntan;
        $kpi ->kompeten = $totalkompeten;
        $kpi ->harmonis = $totalharmonis;

        $kpi ->loyal = $totalloyal;
        $kpi ->adaptif = $totaladaptif;
        $kpi ->kolaboratif = $totalkolaboratif;
        //hitung masuk
        $totalMasuk = Presensi::where('user_id', $user_id)
            ->where('keterangan', 'Masuk')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count();
        //hitung telat
        $totalTelat = Presensi::where('user_id', $user_id)
            ->where('keterangan', 'Telat')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count();
        //hitung lembur
        $lembur = rubahjadwal::where('user_id', $user_id)
                            ->where('permohonan', 'lembur')
                            ->where('status', 'approve')
                            ->whereMonth('tanggal', $bulan)
                            ->whereYear('tanggal', $tahun)
                            ->count();

        //hitung jadwal
        $psTotal = 0;
            for ($day = 1; $day <= 31; $day++) {
                $column = 'j' . $day;
                
                $psCount = jadwalterbaru::where('user_id', $user_id)
                    ->where(function ($query) use ($column) {
                        $query->whereIn($column, ['PS', 'SM', 'PM']);
                    })
                    ->whereMonth('masa_aktif', $bulan)
                    ->whereYear('masa_aktif', $tahun)        
                    ->count();
            
                $psTotal += $psCount;
            }

        session(['psTotal' => $psTotal]);
        if (!$psTotal){
            return redirect()->back()->with('error','Pegawai Tersebut Tidak Mempunyai Data Absen Pada Periode Terpilih');
        }
        $totalabsen = ($totalMasuk + $totalTelat)/$psTotal;
        if($totalabsen == 1 && $lembur > 1){
            $kpi->absen =3;
        }elseif($totalabsen == 1 ){
            $kpi->absen = 2;
        }elseif($totalabsen < 1){
            $kpi->absen =1;
        }else{
            $kpi->absen = 0;
        }
        // $kpi->absen = $totalabsen;
        $totalabsen = $kpi->absen;
        $kpi->bulan = $request->bulan;
        $kpi->total = 
        $kpi->daftar + $kpi->poli + $kpi->farmasi + $kpi->kasir +
        $kpi->bpjs + $kpi->khitan + $kpi->rawat + $kpi->persalinan +
        $kpi->lab + $kpi->umum + $kpi->visit +
        $totallayanan + $totalakuntan + $totalkompeten + $totalharmonis +
        $totalloyal + $totaladaptif + $totalkolaboratif + $totalabsen;

        $jumlahNonZero = count(array_filter([
            $kpi->daftar,
            $kpi->poli,
            $kpi->farmasi,
            $kpi->kasir,
            $kpi->bpjs,
            $kpi->care,
            $kpi->khitan,
            $kpi->rawat,
            $kpi->persalinan,
            $kpi->lab,
            $kpi->umum,
            $kpi->visit,
            $kpi->layanan,
            $kpi->akuntan,
            $kpi->kompeten,
            $kpi->harmonis,
            $kpi->loyal,
            $kpi->adaptif,
            $kpi->kolaboratif,
            $kpi->absen,
        ], function ($value) {
            return $value != 0;
        }));
        
        $kpi->target = $jumlahNonZero;
        
        $kpi->total_kinerja = 
        ($kpi->daftar + $kpi->poli + $kpi->farmasi + $kpi->kasir +
        $kpi->bpjs + $kpi->khitan + $kpi->rawat + $kpi->persalinan +
        $kpi->lab + $kpi->umum + $kpi->visit +
        $totallayanan + $totalakuntan + $totalkompeten + $totalharmonis +
        $totalloyal + $totaladaptif + $totalkolaboratif + $kpi->absen)/$kpi->target;

        // $kpi ->ket = 'melampaui';
        if ($kpi->total_kinerja / $kpi->target == 1) {
            $kpi->ket = 'Sesuai';
        } elseif ($kpi->total_kinerja / $kpi->target > 1) {
            $kpi->ket = 'Melampaui';
        } else {
            $kpi->ket = 'Dibawah';
        }
        // $kpi ->bulan = $request->bulan;
        $realisasi = targetkpi::where('user_id', $user_id)
                                ->whereMonth('bulan', $bulan)
                                ->whereYear('bulan', $tahun)
                                ->first();
        $omset = OmsetKlinik::whereMonth('bulan', $bulan)
                                    ->whereYear('bulan', $tahun)
                                    ->first();
        if ($omset) {
            return redirect()->back()->with('error', 'Performance Unit Pada Periode ' . $request->bulan . ' Sudah Final.');
        }
                                
        if ($realisasi){
            $kpi->save();
            // return $kpi;
        }else{
            return redirect()->back()->with('error','Realisasi User Pada Periode '. $request->bulan .' Ini Belum Ada.');
        }
        return redirect('/KPI')->with('success', 'Data Berhasil di Tambahkan');
    }


    public function destroy($id)
    {
        $kpi = kpi::find($id);
        $kpi->delete();
        return redirect()->back()->with('success','Data Berhasil di Hapus');
    }


    // Masuk Zona Target KPI
    public function indexTargetKpi()
    {
        $title = 'Realisasi Kinerja KPI';
        $type = 'kpi';
        // $target = targetkpi::all();
        $bulan = date('m');
        $tahun = date('Y');
        $target = targetkpi::whereYear('bulan',$tahun)
                            ->whereMonth('bulan',$bulan)
                            ->orderBy('created_at','desc')
                            ->get();
        return view ('template.backend.admin.data-kpi.index',compact('title','target','type'));
    }

    public function SearchRealisasi(Request $request)
    {
        $title = 'Realisasi Kinerja KPI';
        $type = 'kpi';
        $bulan = $request->input('bulan');
        $startDate = $bulan . '-01';
        $endDate = $bulan . '-31';
        $target = targetkpi::whereBetween('bulan', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
        return view ('template.backend.admin.data-kpi.index',compact('title','target','type'));
    }
    public function createTarget()
    {
        // return $targetData;

        // $startDate = '2023-08-07'; // Tanggal awal yang Anda cari
        // $endDate = '2023-08-07'; // Tanggal akhir yang Anda cari
        
        // $targetData = AchKpi::where(function ($query) use ($startDate, $endDate) {
        //     $query->where('start_date', '<=', $endDate) // Memastikan start_date kurang dari atau sama dengan end_date yang Anda cari
        //           ->where('end_date', '>=', $startDate); // Memastikan end_date lebih besar dari atau sama dengan start_date yang Anda cari
        // })
        // ->select('daftar', 'poli', 'farmasi', 'bpjs', 'kasir', 'care', 'khitan', 'rawat', 'salin', 'lab', 'umum', 'visit')
        // ->first();
        // return $targetData;
        
        // return $targetData;
        $title = 'Realiasasi Kinerja KPI';
        $type = 'kpi';
        $ach = AchKpi::all();
        $user = User::all();
        // Mendapatkan bulan dan tahun saat ini
        $currentMonth = date('m');
        $currentYear = date('Y');
        $startDate = $currentYear . '-' . $currentMonth . '-01';
        $endDate = $currentYear . '-' . $currentMonth . '-31';

        $target = AchKpi::where(function ($query) use ($startDate, $endDate) {
            $query->where('start_date', '<=', $endDate)
                ->where('end_date', '>=', $startDate);
        })
        ->select('daftar', 'poli', 'farmasi', 'bpjs', 'kasir', 'care', 'khitan', 'rawat', 'salin', 'lab', 'umum', 'visit')
        ->first();
        if (!$target){
            return redirect('/TargetKPI')->with('error','Data Target Belum Ada');
        }

        return view('template.backend.admin.kpi.form-target',compact('title','user','ach','target','type'));
    }
    public function storeTarget(Request $request)
    {
        $validator=Validator::make($request -> all(),[
            'user_id' => 'required',
            'target_id' => 'required',
            'bulan' => 'required',
        ],[
            'user_id.required' => 'Kolom user_id wajib diisi.',
            'target_id.required' => 'Kolom Target_id wajib diisi.',
            'bulan.required' => 'Kolom bulan wajib diisi.',            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        $selectedUsers = $request->input('user_id');
        $targetId = $request->input('target_id');
        $startDate = $request->bulan;
        $endDate = $request->bulan;
        $targetData = AchKpi::where(function ($query) use ($startDate, $endDate) {
            $query->where('start_date', '<=', $endDate)
                ->where('end_date', '>=', $startDate);
        })
        ->select('daftar', 'poli', 'farmasi', 'bpjs', 'kasir', 'care', 'khitan', 'rawat', 'salin', 'lab', 'umum', 'visit')
        ->first();
        if ($targetData) {
            // Lakukan pengisian nilai c_* dan operasi insert dalam loop foreach
            foreach ($selectedUsers as $userId) {
                $data = [
                    'user_id' => $userId,
                    'target_id' => $targetId,
                    'bulan' => $request->bulan,
                    'r_daftar' => $request->r_daftar,
                    'r_poli' => $request->r_poli,
                    'r_farmasi' => $request->r_farmasi,
                    'r_kasir' => $request->r_kasir,
                    'r_care' => $request->r_care,
                    'r_khitan' => $request->r_khitan,
                    'r_rawat' => $request->r_rawat,
                    'r_salin' => $request->r_salin,
                    'r_lab' => $request->r_lab,
                    'r_bpjs' => $request->r_bpjs,
                    'r_umum' => $request->r_umum,
                    'r_visit' => $request->r_visit,
                ];

                // Proses pengecekan dan pengisian nilai c_*
                $columns = ['daftar', 'poli', 'farmasi', 'bpjs', 'kasir', 'care','khitan', 'rawat', 'salin', 'lab', 'umum', 'visit'];
                foreach ($columns as $column) {
                    $r_column = 'r_' . $column;
                    $c_column = 'c_' . $column;

                    if ($request->$r_column === null) {
                        $data[$r_column] = 0;
                        $data[$c_column] = 0;
                    } elseif ($targetData->$column != 0) {
                        $total = $request->$r_column / $targetData->$column;
                        if ($total > 1) {
                            $data[$c_column] = 3;
                        } elseif ($total == 1) {
                            $data[$c_column] = 2;
                        } elseif ($total < 1) {
                            $data[$c_column] = 1;
                        } elseif ($total >= 0 || $total == null) {
                            $data[$c_column] = 0;
                        } else {
                            // Handling untuk kasus lain (opsional)
                        }
                    } else {
                        $data[$c_column] = 0;
                    }                        
                }
                $existingData = targetkpi::where('user_id', $userId)
                                        ->where('bulan', $request->bulan)
                                        ->first();
    
                if (!$existingData) {
                    targetkpi::create($data);
                }else {
                    return redirect()->back()->with('error','Data User Pada Bulan Ini sudah Ada.');
                }   
                // targetkpi::create($data);
            }

            return redirect('/KPI/Data-Kinerja')->with('success','Terimakasih , Data Realiasasi Berhasil Disimpan');
        } else {
            //handle request jika $targetData tidak ditemukan
            return redirect()->back()->with('error', 'Data Target Pada Periode Tersebut Tidak Ditemukan.');
        }
    }

    public function editTarget($id)
    {
        $title = 'Realiasasi Kinerja KPI';
        $type = 'kpi';
        $ach = AchKpi::all();
        $realisasi = targetkpi::find($id);
        $targetId = $ach->where('id', $realisasi->target_id)->pluck('name')->first();
        $user = User::all();
        // Mendapatkan bulan dan tahun saat ini
        $currentMonth = date('m');
        $currentYear = date('Y');
        $startDate = $currentYear . '-' . $currentMonth . '-01';
        $endDate = $currentYear . '-' . $currentMonth . '-31';

        $target = AchKpi::where(function ($query) use ($startDate, $endDate) {
            $query->where('start_date', '<=', $endDate)
                ->where('end_date', '>=', $startDate);
        })
        ->select('daftar', 'poli', 'farmasi', 'bpjs', 'kasir', 'care', 'khitan', 'rawat', 'salin', 'lab', 'umum', 'visit')
        ->first();
        if (!$target){
            return redirect('/TargetKPI')->with('error','Data Target Belum Ada');
        }
        return view('template.backend.admin.data-kpi.edit',compact('title','user','ach','target','type','realisasi','targetId'));

    }

    public function updateTarget(Request $request ,$id)
    {
        $selectedUsers = $request->user_id;
        $targetId = $request->target_id;
        $startDate = $request->bulan;
        $endDate = $request->bulan;
        $targetData = AchKpi::where(function ($query) use ($startDate, $endDate) {
            $query->where('start_date', '<=', $endDate)
                ->where('end_date', '>=', $startDate);
        })
        ->select('daftar', 'poli', 'farmasi', 'bpjs', 'kasir', 'care', 'khitan', 'rawat', 'salin', 'lab', 'umum', 'visit')
        ->first();
        if ($targetData) {
            $realisasi = targetkpi::find($id);
            $realisasi -> user_id = $selectedUsers;
            $realisasi -> target_id = $targetId;
            $realisasi -> bulan = $request->bulan;
            $realisasi -> r_daftar = $request->r_daftar;
            $realisasi -> r_poli = $request->r_poli;
            $realisasi -> r_farmasi = $request->r_farmasi;
            $realisasi -> r_kasir = $request->r_kasir;
            $realisasi -> r_care = $request->r_care;
            $realisasi -> r_khitan = $request->r_khitan;
            $realisasi -> r_rawat = $request->r_rawat;
            $realisasi -> r_salin = $request->r_salin;
            $realisasi -> r_lab = $request->r_lab;
            $realisasi -> r_bpjs = $request->r_bpjs;
            $realisasi -> r_umum = $request->r_umum;
            $realisasi -> r_visit = $request->r_visit;

            $columns = ['daftar', 'poli', 'farmasi', 'bpjs', 'kasir', 'care', 'khitan', 'rawat', 'salin', 'lab', 'umum', 'visit'];

            foreach ($columns as $column) {
                $r_column = 'r_' . $column;
                $c_column = 'c_' . $column;

                if ($request->$r_column === null) {
                    $realisasi->$r_column = 0;
                    $realisasi->$c_column = 0;
                } elseif ($targetData->$column != 0) {
                    $total = $request->$r_column / $targetData->$column;
                    if ($total > 1) {
                        $realisasi->$c_column = 3; // Melebihi target
                    } elseif ($total == 1) {
                        $realisasi->$c_column = 2; // Tepat sesuai target
                    } elseif ($total < 1) {
                        $realisasi->$c_column = 1; // Kurang dari target
                    } elseif ($total >= 0) {
                        $realisasi->$c_column = 0; // Nilai non-negatif
                    } else {
                        // Handling untuk kasus lain (opsional)
                    }
                } else {
                    $realisasi->$c_column = 0;
                }
            }


            $realisasi->save();

            return redirect('/KPI/Data-Kinerja')->with('success','Terimakasih , Data Realiasasi Berhasil Diupdate.');
        } else {
            //handle request jika $targetData tidak ditemukan
            return redirect()->back()->with('error', 'Data Target Pada Periode Tersebut Tidak Ditemukan.');
        }

    }

    public function hapusTargetKpi($id)
    {
        $delete = targetkpi::find($id);
        $delete -> delete();
        if($delete){
            return redirect()->back()->with('success', 'Data Kinerja Berhasil Dihapus.');
        }else{
            return redirect()->back()->with('error','Data Kinerja Gagal Untuk Dihapus.');
        }
    }

    public function insertmultiple()
    {
        $title = 'coba multiple';
        $user = User::all();
        $ach = AchKpi::all();
        return view ('template.backend.admin.data-kpi.coba',compact('title','user','ach'));
    }
    public function coba(Request $request)
    {
            // $this->validate($request, [
            //     'user_id' => 'required|array',
            //     'user_id.*' => 'exists:users,id', // Validasi bahwa user_id adalah ID yang valid di tabel users
            //     'target_id' => 'required', // Gantilah "target_table" sesuai nama tabel target yang sesuai
            // ]);
    
            // // Ambil data yang dipilih dari formulir
            // $selectedUsers = $request->input('user_id');
            // $targetId = $request->input('target_id');
        
            // // Simpan data ke dalam tabel target_kpis (atau tabel sesuai yang Anda gunakan)
            // foreach ($selectedUsers as $userId) {
            //     $data = [
            //         'user_id' => $userId,
            //         'target_id' => $targetId, // Gunakan target_id yang diterima dari formulir
            //         // Sisipkan kolom-kolom lain sesuai kebutuhan
            //     ];
    
            //     // Lakukan operasi insert untuk setiap user_id
            //     targetkpi::create($data);
            // }
    
            // return redirect()->back()->with('success', 'Data berhasil disimpan.');
            $target->bulan = $request->bulan;
            $target_id = $request->target_id;
            $startDate = $request->bulan;
            $endDate = $request->bulan;

            // Pencarian data target dari tabel AchKpi
            $targetData = AchKpi::where(function ($query) use ($startDate, $endDate) {
                $query->where('start_date', '<=', $endDate)
                    ->where('end_date', '>=', $startDate);
            })
            ->select('daftar', 'poli', 'farmasi', 'bpjs', 'kasir', 'care', 'khitan', 'rawat', 'salin', 'lab', 'umum', 'visit')
            ->first();

            if ($targetData) {
                // Lakukan pengisian nilai c_* dan operasi insert dalam loop foreach
                foreach ($selectedUsers as $userId) {
                    $data = [
                        'user_id' => $userId,
                        'target_id' => $target_id,
                        'bulan' => $request->bulan,
                        'r_daftar' => $request->r_daftar,
                        'r_poli' => $request->r_poli,
                        'r_farmasi' => $request->r_farmasi,
                        'r_kasir' => $request->r_kasir,
                        'r_care' => $request->r_care,
                        'r_khitan' => $request->r_khitan,
                        'r_rawat' => $request->r_rawat,
                        'r_salin' => $request->r_salin,
                        'r_lab' => $request->r_lab,
                        'r_bpjs' => $request->r_bpjs,
                        'r_umum' => $request->r_umum,
                        'r_visit' => $request->r_visit,
                    ];

                    // Proses pengecekan dan pengisian nilai c_*
                    $columns = ['daftar', 'poli', 'farmasi', 'bpjs', 'kasir', 'care', 'khitan', 'rawat', 'salin', 'lab', 'umum', 'visit'];
                    foreach ($columns as $column) {
                        $r_column = 'r_' . $column;
                        $c_column = 'c_' . $column;

                        if ($targetData->$column != 0) {
                            $total = $request->$r_column / $targetData->$column;
                            if ($total > 1) {
                                $data[$c_column] = 3;
                            } elseif ($total == 1) {
                                $data[$c_column] = 2;
                            } elseif ($total < 1 && $total >= 0) {
                                $data[$c_column] = 1;
                            } else {
                                $data[$c_column] = 0;
                            }
                        } else {
                            $data[$c_column] = 0;
                        }
                    }

                    // Lakukan operasi insert untuk setiap user_id
                    targetkpi::create($data);
                }

                // Setelah loop selesai, Anda dapat mengarahkan pengguna ke halaman berikutnya
                return redirect('/KPI/Data-Kinerja')->with('success','Silahkan isi data selanjutnya');
            } else {
                //handle request jika $targetData tidak ditemukan
                return redirect()->back()->with('error', 'Data Target Ditemukan.');
            }

    }
        
    //zona Insentif KPI
    public function indexInsentifKpi()
    {
        $title = 'Insentif Kinerja KPI';
        $type = 'gaji';
        $bulanTahunSekarang = date('Y-m');
        $bulan = date('m', strtotime('last month')); 
        $tahun = date('Y', strtotime('last month')); 

        $poin = OmsetKlinik::whereMonth('bulan', $bulan)
        ->whereYear('bulan', $tahun)
        ->select('omset','skor','index_rupiah','total_insentif')
        ->first();
        if ($poin) {
            $user = User::all();
            // $insentif = InsentifKpi::all();
            $insentif = InsentifKpi::whereYear('bulan', $tahun)
            ->whereMonth('bulan', $bulan)
            ->orderBy('created_at', 'desc')
            ->get();    
        } else {
            return redirect('/setup-insentif')->with('error', 'Setup Omset Bulan Ini Terlebih Dahulu.');
        }
        
        return view ('template.backend.admin.insentif-kpi.index',compact('title','insentif','user','poin','type'));
    }

    public function SearchInsentifKpi(Request $request)
    {
        $title = 'Insentif Kinerja KPI';
        $type = 'gaji';
        $bulanTahunSekarang = date('Y-m');
        $waktu = date('m'); 
        $tahun = date('Y'); 
        $bulan = $request->input('bulan');
        $startDate = $bulan . '-01';
        $endDate = $bulan . '-31';

        $poin = OmsetKlinik::whereBetween('bulan', [$startDate, $endDate])->first();
        // $poin = OmsetKlinik::whereMonth('bulan', $waktu)
        // ->whereYear('bulan', $tahun)
        // ->select('omset','skor','index_rupiah','total_insentif')
        // ->first();
        if ($poin) {
            $user = User::all();
            // $insentif = InsentifKpi::all();
            $insentif = InsentifKpi::whereBetween('bulan', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
        } else {
            return redirect('/setup-insentif')->with('error', 'Setup Omset Bulan Ini Terlebih Dahulu.');
        }
        
        return view ('template.backend.admin.insentif-kpi.index',compact('title','insentif','user','poin','type'));
    }

    public function storeInsentifKpi(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'bulan' => 'required',
        ],[
            'user_id.required' => 'User Tidak Boleh Kosong',
            'bulan' => 'Poin User Tidak Boleh Kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $insentif = new InsentifKpi;
        $insentif ->user_id = $request->user_id;
        $insentif ->bulan = $request->bulan;
        //mendapatkan nilai Omset
        $user_id = $request->user_id;
        $data = explode('-', $request->bulan);
        $bulan = $data[1]; // Bulan
        $tahun = $data[0]; // Tahun

        $poin = OmsetKlinik::whereMonth('bulan', $bulan)
        ->whereYear('bulan', $tahun)
        ->select('omset','skor','index_rupiah','total_insentif')
        ->first();

        $insentif ->total_poin = $poin->skor;
        $insentif ->omset = $poin->omset;
        $insentif ->total_insentif = $poin->total_insentif;
        //mendapatkan poin user
        $poin_user = kpi::where('user_id', $user_id)
                                ->whereMonth('bulan', $bulan)
                                ->whereYear('bulan', $tahun)
                                ->select('total')
                                ->first();
    
        if ($poin_user) {
            $insentif->poin_user = $poin_user->total;
            $index_rupiah = $poin->total_insentif / $poin->skor;
            $insentif->index_rupiah = round($index_rupiah, 2);
            $insentif->insentif_final = round($index_rupiah * $poin_user->total, 2);
            $insentif->save();
        }else{
            return redirect()->back()->with('error','Poin KPI '. User::find($user_id)->name . ' Tidak ada');
        }
        // $insentif ->poin_user = $poin_user->total;
        // $index_rupiah = $poin->total_insentif / $poin->skor;
        // $insentif->index_rupiah = round($index_rupiah, 2);
        // $insentif->insentif_final = round($index_rupiah * $poin_user->total, 2);
        // $insentif -> save();
        return redirect()->back()->with('success','Data Insentif Berhasil Disimpan.');
        // return $insentif;
    }

    public function hapusInsentifKpi($id)
    {
        $insentif = InsentifKpi::find($id);
    
        if (!$insentif) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    
        $insentif->delete();
    
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    //zona view detail KPI
    public function indexViewKpi($id)
    {
        $kpi = Kpi::find($id);
        $user = User::find($kpi->user_id);
        $type = 'kpi';
        $title = 'View Detail KPI ('.$user->name.')';

        $ach = null; 
        $psTotal = 0;
        $totalkehadiran= 0;

        if ($kpi) {
            $user = User::find($kpi->user_id);

            if ($user) {
                $targetkpi = targetkpi::where('user_id', $user->id)
                    ->select('r_daftar', 'r_poli', 'r_farmasi', 'r_kasir', 'r_care', 'r_bpjs', 'r_khitan',
                        'r_rawat', 'r_salin', 'r_lab', 'r_umum', 'r_visit', 'target_id', 'bulan')
                    ->first();

                if ($targetkpi) {
                    if ($targetkpi->bulan) {
                        $data = explode('-', $targetkpi->bulan);
                        $bulan = $data[1];
                        $tahun = $data[0];

                        $totalMasuk = Presensi::where('user_id', $user->id)
                            ->where('keterangan', 'Masuk')
                            ->whereMonth('tanggal', $bulan)
                            ->whereYear('tanggal', $tahun)
                            ->count();

                        $totalTelat = Presensi::where('user_id', $user->id)
                            ->where('keterangan', 'Telat')
                            ->whereMonth('tanggal', $bulan)
                            ->whereYear('tanggal', $tahun)
                            ->count();

                        $totalkehadiran = $totalMasuk + $totalTelat;

                        for ($day = 1; $day <= 31; $day++) {
                            $column = 'j' . $day;

                            $psCount = jadwalterbaru::where('user_id', $user->id)
                                ->where(function ($query) use ($column) {
                                    $query->whereIn($column, ['PS', 'SM', 'PM']);
                                })
                                ->whereMonth('masa_aktif', $bulan)
                                ->whereYear('masa_aktif', $tahun)
                                ->count();

                            $psTotal += $psCount;
                        }

                        $target_id = $targetkpi->target_id;
                        $ach = AchKpi::where('id', $target_id)
                            ->select('daftar', 'poli', 'farmasi', 'kasir', 'care', 'bpjs', 'khitan',
                                'rawat', 'salin', 'lab', 'umum', 'visit')
                            ->first();

                        if (!$ach) {
                            return redirect()->back()->with('error','Ada Masalah Di Backend Ach KPI.');
                        }
                    } else {
                        return redirect()->back()->with('error','Data Periode KPI Tidak Ditemukan.');
                    }
                } else {
                    return redirect()->back()->with('error','Data Realisasi KPI Tidak Ditemukan.');
                }
            } else {
                return redirect()->back()->with('error','Data KPI User NULL atau Tidak Ada.');
            }            
        } else {
            return redirect()->back()->with('error','Data KPI Tidak Ditemukan.');
        }

        // return $psTotal;
        return view ('template.backend.admin.kpi.detail-kpi.index',compact('title','kpi','targetkpi','ach','psTotal','totalkehadiran','type'));
    }

}
