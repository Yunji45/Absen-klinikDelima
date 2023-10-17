<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kpi;
use App\Models\User;
use App\Models\jadwalterbaru;
use App\Models\presensi;
use App\Models\targetkpi;
use App\Models\InsentifKpi;
use Illuminate\Support\Facades\Validator;
use DB;

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
        // $user_id = 1;
        // $data = explode('-', '2023-10-02'); // Memisahkan string bulan menjadi array
        // $bulan = $data[1]; // Bulan
        // $tahun = $data[0]; // Tahun
        
        // $totalMasuk = Presensi::where('user_id', $user_id)
        //     ->where('keterangan', 'Masuk')
        //     ->whereMonth('tanggal', $bulan)
        //     ->whereYear('tanggal', $tahun)
        //     ->count();
        
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
        $user = User::all();
        return view('template.backend.admin.kpi.create',compact('title','user'));
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
            'target' => 'required',
        ],[
            'user_id.required' => 'Kolom user_id wajib diisi.',
            'jabatan.required' => 'Kolom jabatan wajib diisi.',
            'div.required' => 'Kolom div wajib diisi.',
            'nama_atasan.required' => 'Kolom nama_atasan wajib diisi.',
            'div_atasan.required' => 'Kolom div_atasan wajib diisi.',
            'jabatan_atasan.required' => 'Kolom jabatan_atasan wajib diisi.',
            'target.required' => 'Kolom target wajib diisi.',        
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
        $kpi->target = $request->target;
        // $kpi ->div = 'Software Enginer';
        //request input
        // $daftarValue = $request->input('daftar', []);
        // $poliValue = $request->input('poli', []);
        // $farmasiValue = $request->input('farmasi', []);
        // $kasirValue = $request->input('kasir', []);
        // $careValue = $request->input('care', []);
        // $bpjsValue = $request->input('bpjs', []);
        // $khitanValue = $request->input('khitan', []);
        // $rawatValue = $request->input('rawat', []);
        // $persalinanValue = $request->input('persalinan', []);
        // $labValue = $request->input('lab', []);
        // $umumValue = $request->input('umum', []);
        // $visitValue = $request->input('visit', []);
        $layananValue = $request->input('layanan', []);
        $akuntanValue = $request->input('akuntan', []);
        $kompetenValue = $request->input('kompeten', []);
        $harmonisValue = $request->input('harmonis', []);
        $loyalValue = $request->input('loyal', []);
        $adaptifValue = $request->input('adaptif', []);
        $kolaboratifValue = $request->input('kolaboratif', []);
        $absenValue = $request->input('absen', []);
        
        //total
        // $totaldaftar = !empty($daftarValue) ? array_sum($daftarValue) : 0;
        // $totalpoli = !empty($poliValue) ? array_sum($poliValue) : 0;
        // $totalfarmsai = !empty($farmasiValue) ? array_sum($farmasiValue) : 0;
        // $totalkasir = !empty($kasirValue) ? array_sum($kasirValue) : 0;
        // $totalcare = !empty($careValue) ? array_sum($careValue) : 0;
        // $totalbpjs = !empty($bpjsValue) ? array_sum($bpjsValue) : 0;
        // $totalkhitan = !empty($khitanValue) ? array_sum($khitanValue) : 0;
        // $totalrawat = !empty($rawatValue) ? array_sum($rawatValue) : 0;
        // $totalpersalinan = !empty($persalinanValue) ? array_sum($persalinanValue) : 0;
        // $totallab = !empty($labValue) ? array_sum($labValue) : 0;
        // $totalumum = !empty($umumValue) ? array_sum($umumValue) : 0;
        // $totalvisit = !empty($visitValue) ? array_sum($visitValue) : 0;
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
                                
        // $kpi->daftar = $targetdaftar;
        // $kpi->poli = $targetpoli;
        // $kpi ->farmasi = $totalfarmsai;
        // $kpi ->kasir = $totalkasir;

        // $kpi ->care = $totalcare;
        // $kpi ->bpjs = $totalbpjs;
        // $kpi ->khitan = $totalkhitan;
        // $kpi ->rawat = $totalrawat;

        // $kpi ->persalinan = $totalpersalinan;
        // $kpi ->lab = $totallab;
        // $kpi ->umum = $totalumum;
        // $kpi ->visit = $totalvisit;

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
        
        $totalMasuk = Presensi::where('user_id', $user_id)
            ->where('keterangan', 'Masuk')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->count();
    
        $totalTelat = Presensi::where('user_id', $user_id)
            ->where('keterangan', 'Telat')
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
        if($totalabsen > 1){
            $kpi->absen =3;
        }elseif($totalabsen == 1 ){
            $kpi->absen = 2;
        }elseif($totalabsen < 1){
            $kpi->absen =1;
        }else{
            $kpi->absen = null;
        }
        // $kpi->absen = $totalabsen;
        $kpi->bulan = $request->bulan;

        // $totalMasuk = Presensi::where('user_id', $user_id)
        // ->where('keterangan', 'Masuk')
        // ->count();
        // $totalTelat = Presensi::where('user_id', $user_id)
        //     ->where('keterangan', 'Telat')
        //     ->count();
        // $kpi ->bulan = $request->bulan;

        $kpi->total = 
        // $totaldaftar + $totalpoli + $totalfarmsai + $totalkasir +
        // $totalcare + $totalbpjs + $totalkhitan + $totalrawat +
        // $totalpersalinan + $totallab + $totalumum + $totalvisit +
        $kpi->daftar + $kpi->poli + $kpi->farmasi + $kpi->kasir +
        $kpi->bpjs + $kpi->khitan + $kpi->rawat + $kpi->persalinan +
        $kpi->lab + $kpi->umum + $kpi->visit +
        $totallayanan + $totalakuntan + $totalkompeten + $totalharmonis +
        $totalloyal + $totaladaptif + $totalkolaboratif + $kpi->absen;

        $kpi->total_kinerja = 
        ($kpi->daftar + $kpi->poli + $kpi->farmasi + $kpi->kasir +
        $kpi->bpjs + $kpi->khitan + $kpi->rawat + $kpi->persalinan +
        $kpi->lab + $kpi->umum + $kpi->visit +
        $totallayanan + $totalakuntan + $totalkompeten + $totalharmonis +
        $totalloyal + $totaladaptif + $totalkolaboratif + $kpi->absen)/$request->target;

        // $kpi ->ket = 'melampaui';
        if ($kpi->total_kinerja / $request->target == 1) {
            $kpi->ket = 'Sesuai';
        } elseif ($kpi->total_kinerja / $request->target > 1) {
            $kpi->ket = 'Melampaui';
        } else {
            $kpi->ket = 'Dibawah';
        }
        // $kpi ->bulan = $request->bulan;
        $kpi ->save();
        // return $totalabsen;
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


    // Masuk Zona Target KPI
    public function createTarget()
    {
        $title = 'Target Capaian KPI';
        $user = User::all();
        return view('template.backend.admin.kpi.form-target',compact('title','user'));
    }
    public function storeTarget(Request $request)
    {
        $validator=Validator::make($request -> all(),[
            'user_id' => 'required',
            'bulan' => 'required',
            't_daftar' => 'required',
            'r_daftar' => 'required',
            't_poli' => 'required',
            'r_poli' => 'required',
            't_farmasi' => 'required',
            'r_farmasi' => 'required',
            't_kasir' => 'required',
            'r_kasir' => 'required',
            't_care' => 'required',
            'r_care' => 'required',
            't_khitan' => 'required',
            'r_khitan' => 'required',
            't_rawat' => 'required',
            'r_rawat' => 'required',
            't_salin' => 'required',
            'r_salin' => 'required',
            't_lab' => 'required',
            'r_lab' => 'required',
            't_bpjs' => 'required',
            'r_bpjs' => 'required',
            't_umum' => 'required',
            'r_umum' => 'required',
            't_visit' => 'required',
            'r_visit' => 'required',
        ],[
            'user_id.required' => 'Kolom user_id wajib diisi.',
            'bulan.required' => 'Kolom bulan wajib diisi.',
            't_daftar.required' => 'Kolom t_daftar wajib diisi.',
            'r_daftar.required' => 'Kolom r_daftar wajib diisi.',
            't_poli.required' => 'Kolom t_poli wajib diisi.',
            'r_poli.required' => 'Kolom r_poli wajib diisi.',
            't_farmasi.required' => 'Kolom t_farmasi wajib diisi.',
            'r_farmasi.required' => 'Kolom r_farmasi wajib diisi.',
            't_kasir.required' => 'Kolom t_kasir wajib diisi.',
            'r_kasir.required' => 'Kolom r_kasir wajib diisi.',
            't_care.required' => 'Kolom t_care wajib diisi.',
            'r_care.required' => 'Kolom r_care wajib diisi.',
            't_khitan.required' => 'Kolom t_khitan wajib diisi.',
            'r_khitan.required' => 'Kolom r_khitan wajib diisi.',
            't_rawat.required' => 'Kolom t_rawat wajib diisi.',
            'r_rawat.required' => 'Kolom r_rawat wajib diisi.',
            't_salin.required' => 'Kolom t_salin wajib diisi.',
            'r_salin.required' => 'Kolom r_salin wajib diisi.',
            't_lab.required' => 'Kolom t_lab wajib diisi.',
            'r_lab.required' => 'Kolom r_lab wajib diisi.',
            't_bpjs.required' => 'Kolom t_bpjs wajib diisi.',
            'r_bpjs.required' => 'Kolom r_bpjs wajib diisi.',
            't_umum.required' => 'Kolom t_umum wajib diisi.',
            'r_umum.required' => 'Kolom r_umum wajib diisi.',
            't_visit.required' => 'Kolom t_visit wajib diisi.',
            'r_visit.required' => 'Kolom r_visit wajib diisi.',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        $target = new targetkpi();
        $target->user_id = $request->user_id;
        $target->bulan = $request->bulan;

        $target->t_daftar = $request->t_daftar;
        $target->r_daftar = $request->r_daftar;
        if ($request->t_daftar != 0) {
            $totaldaftar = $request->r_daftar / $request->t_daftar;

            if ($totaldaftar > 1) {
                $target->c_daftar = 3;
            } elseif ($totaldaftar == 1) {
                $target->c_daftar = 2;
            } elseif ($totaldaftar < 1 && $totaldaftar >= 0) {
                $target->c_daftar = 1;
            } else {
                $target->c_daftar = 0;
            }
        } else {
            $target->c_daftar = 0;
        }

        $target->t_poli = $request->t_poli;
        $target->r_poli = $request->r_poli;
        
        if ($request->t_poli != 0) {
            $totalpoli = $request->r_poli / $request->t_poli;
            
            if ($totalpoli > 1) {
                $target->c_poli = 3;
            } elseif ($totalpoli == 1) {
                $target->c_poli = 2;
            } elseif ($totalpoli < 1 && $totalpoli >= 0) {
                $target->c_poli = 1;
            } else {
                $target->c_poli = 0;
            }
        } else {
            $target->c_poli = 0;
        }
        
        $target->t_farmasi = $request->t_farmasi;
        $target->r_farmasi = $request->r_farmasi;
        if ($request->t_farmasi != 0) {
            $totalfarmasi = $request->r_farmasi / $request->t_farmasi;
            
            if ($totalfarmasi > 1) {
                $target->c_farmasi = 3;
            } elseif ($totalfarmasi == 1) {
                $target->c_farmasi = 2;
            } elseif ($totalfarmasi < 1 && $totalfarmasi >= 0) {
                $target->c_farmasi = 1;
            } else {
                $target->c_farmasi = 0;
            }
        } else {
            $target->c_farmasi = 0;
        }
        
        $target->t_kasir = $request->t_kasir;
        $target->r_kasir = $request->r_kasir;
        if ($request->t_kasir != 0) {
            $totalkasir = $request->r_kasir / $request->t_kasir;
        
            if ($totalkasir > 1) {
                $target->c_kasir = 3;
            } elseif ($totalkasir == 1) {
                $target->c_kasir = 2;
            } elseif ($totalkasir < 1 && $totalkasir >= 0) {
                $target->c_kasir = 1;
            } else {
                $target->c_kasir = 0;
            }
        } else {
            $target->c_kasir = 0;
        }
        
        $target->t_care = $request->t_care;
        $target->r_care = $request->r_care;
        if ($request->t_care != 0) {
            $totalcare = $request->r_care / $request->t_care;
            if ($totalcare > 1) {
                $target->c_care = 3;
            } elseif ($totalcare == 1) {
                $target->c_care = 2;
            } elseif ($totalcare < 1 && $totalcare >= 0) {
                $target->c_care = 1;
            } else {
                $target->c_care = 0;
            }
        } else {
            $target->c_care = 0;
        }
        
        $target->t_khitan = $request->t_khitan;
        $target->r_khitan = $request->r_khitan;
        
        if ($request->t_khitan != 0) {
            $totalkhitan = $request->r_khitan / $request->t_khitan;
        
            if ($totalkhitan > 1) {
                $target->c_khitan = 3;
            } elseif ($totalkhitan == 1) {
                $target->c_khitan = 2;
            } elseif ($totalkhitan < 1 && $totalkhitan >= 0) {
                $target->c_khitan = 1;
            } else {
                $target->c_khitan = 0;
            }
        } else {
            $target->c_khitan = 0;
        }
        
        $target->t_rawat = $request->t_rawat;
        $target->r_rawat = $request->r_rawat;
        
        if ($request->t_rawat != 0) {
            $totalrawat = $request->r_rawat / $request->t_rawat;
        
            if ($totalrawat > 1) {
                $target->c_rawat = 3;
            } elseif ($totalrawat == 1) {
                $target->c_rawat = 2;
            } elseif ($totalrawat < 1 && $totalrawat >= 0) {
                $target->c_rawat = 1;
            } else {
                $target->c_rawat = 0;
            }
        } else {
            $target->c_rawat = 0;
        }
        
        $target->t_salin = $request->t_salin;
        $target->r_salin = $request->r_salin;
        
        if ($request->t_salin != 0) {
            $totalsalin = $request->r_salin / $request->t_salin;
        
            if ($totalsalin > 1) {
                $target->c_salin = 3;
            } elseif ($totalsalin == 1) {
                $target->c_salin = 2;
            } elseif ($totalsalin < 1 && $totalsalin >= 0) {
                $target->c_salin = 1;
            } else {
                $target->c_salin = 0;
            }
        } else {
            $target->c_salin = 0;
        }
        
        $target->t_lab = $request->t_lab;
        $target->r_lab = $request->r_lab;
        if ($request->t_lab != 0) {
            $totallab = $request->r_lab / $request->t_lab;
        
            if ($totallab > 1) {
                $target->c_lab = 3;
            } elseif ($totallab == 1) {
                $target->c_lab = 2;
            } elseif ($totallab < 1 && $totallab >= 0) {
                $target->c_lab = 1;
            } else {
                $target->c_lab = 0;
            }
        } else {
            $target->c_lab = 0;
        }
        
        $target->t_bpjs = $request->t_bpjs;
        $target->r_bpjs = $request->r_bpjs;
        
        if ($request->t_bpjs != 0) {
            $totalbpjs = $request->r_bpjs / $request->t_bpjs;
        
            if ($totalbpjs == 1) {
                $target->c_bpjs = 2;
            } elseif ($totalbpjs < 1 && $totalbpjs >= 0) {
                $target->c_bpjs = 1;
            } else {
                $target->c_bpjs = 0;
            }
        } else {
            $target->c_bpjs = 0;
        }        

        $target->t_umum = $request->t_umum;
        $target->r_umum = $request->r_umum;
        if ($request->t_umum != 0) {
            $totalumum = $request->r_umum / $request->t_umum;
        
            if ($totalumum > 1) {
                $target->c_umum = 3;
            } elseif ($totalumum == 1) {
                $target->c_umum = 2;
            } elseif ($totalumum < 1 && $totalumum >= 0) {
                $target->c_umum = 1;
            } else {
                $target->c_umum = 0;
            }
        } else {
            $target->c_umum = 0;
        }      

        $target->t_visit = $request->t_visit;
        $target->r_visit = $request->r_visit;

        if ($request->t_visit != 0) {
            $totalvisit = $request->r_visit / $request->t_visit;

            if ($totalvisit > 1) {
                $target->c_visit = 3;
            } elseif ($totalvisit == 1) {
                $target->c_visit = 2;
            } elseif ($totalvisit < 1 && $totalvisit >= 0) {
                $target->c_visit = 1;
            } else {
                $target->c_visit = 0;
            }
        } else {
            $target->c_visit = 0;
        }

        $target->t_absen = null;
        $target->r_absen = null;
        $target->c_absen = null;
        // if ($request->t_absen != 0) {
        //     $totalabsen = $request->r_absen / $request->t_absen;
        
        //     if ($totalabsen > 1) {
        //         $target->c_absen = 3;
        //     } elseif ($totalabsen == 1) {
        //         $target->c_absen = 2;
        //     } elseif ($totalabsen < 1 && $totalabsen >= 0) {
        //         $target->c_absen = 1;
        //     } else {
        //         $target->c_absen = 0;
        //     }
        // } else {
        //     $target->c_absen = 0;
        // }                
        $target->save();
        // return $target;
        return redirect('/KPI-create')->with('success','Silahkan isi data selanjutnya');

    }

    //zona Insentif KPI
    public function indexInsentifKpi()
    {
        $title = 'Insentif KPI';
        $user = User::all();
        $insentif = InsentifKpi::all();
        return view ('template.backend.admin.insentif-kpi.index',compact('title','insentif','user'));
    }

    public function storeInsentifKpi(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'total_poin' => 'required',
            'omset' => 'required',
            'total_insentif' => 'required',
            'poin_user' => 'required',
        ],[
            'user_id.required' => 'User Tidak Boleh Kosong',
            'total_poin.required' => 'Total Poin Tidak Boleh Kosong',
            'omset.required' => 'Omset Tidak Boleh Kosong',
            'total_insentif' => 'Total Insentif Yang Akan Dibagikan tidak boleh kosong',
            'poin_user' => 'Poin User Tidak Boleh Kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $insentif = new InsentifKpi;
        $insentif ->user_id = $request->user_id;
        $insentif ->bulan = now();
        $insentif ->total_poin = $request->total_poin;
        $insentif ->omset = $request->omset;
        $insentif ->total_insentif = $request->total_insentif;
        $insentif ->poin_user = $request->poin_user;
        $index_rupiah = $request->total_insentif / $request->total_poin;
        $insentif->index_rupiah = round($index_rupiah, 2);
        $insentif->insentif_final = round($index_rupiah * $request->poin_user, 2);
        $insentif -> save();
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
}
