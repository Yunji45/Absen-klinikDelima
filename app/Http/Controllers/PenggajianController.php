<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gajian;
use App\Models\User;
use App\Models\UMKaryawan;
use App\Models\kpi;
use App\Models\InsentifKpi;
use App\Models\NoteKaryawan;
use App\Exports\GajiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Notifications\AbsensiNotification;
use App\Notifications\AbsensiExitNotification;
use Carbon\Carbon;
use Auth;
use PDF;


class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Payroll';
        $bulan = date('m');
        $tahun = date('Y');
        $type = 'gaji';
        // $gaji = gajian::all();
        $gaji = gajian::whereYear('bulan', $tahun)
        ->whereMonth('bulan', $bulan)
        ->orderBy('created_at', 'asc')
        ->paginate(10);    
        $total = gajian::whereYear('bulan',$tahun)->whereMonth('bulan',$bulan)->sum('Gaji_akhir');        
        $data = User::all();
        $umr = UMKaryawan::all();
        // return $total;
        return view('template.backend.admin.gaji.index',compact('title','gaji','data','umr','tahun','bulan','type','total'));
    }

    public function SearchPayroll(Request $request)
    {
        $title = 'Payroll';
        $data = User::all();
        $type = 'gaji';
        $umr = UMKaryawan::all();
        $bulan = $request->input('bulan');
        $startDate = $bulan . '-01';
        $endDate = $bulan . '-31';
    
        $gaji = gajian::whereBetween('bulan', [$startDate, $endDate])->orderBy('created_at', 'asc')->paginate(10);
        $total = gajian::whereBetween('bulan',[$startDate, $endDate])->sum('Gaji_akhir');
        return view('template.backend.admin.gaji.index',compact('title','gaji','data','umr','bulan','type','total'));

    }

    public function cari(Request $request)
    {
        $title = 'Penggajian';
        $tahun = substr($request->bulan, 0, 4); // Ambil tahun dari input bulan
        $bulanInput = substr($request->bulan, 5, 2); // Ambil bulan dari input bulan    
        $data = User::all();
        $umr = UMKaryawan::all();
        if (preg_match('/^(0[1-9]|1[0-2])$/', $bulanInput)) {
            $gaji = gajian::whereYear('bulan', $tahun)
                ->whereMonth('bulan', $bulanInput)
                ->get();
            return view('backend.admin.gaji.index', compact('gaji', 'title', 'tahun', 'bulanInput','data','umr'));
        } else {
            return redirect()->back()->with('error', 'Format bulan tidak valid.');
        }
    
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Payroll';
        $type = 'gaji';
        $data = User::all();
        $umr = UMKaryawan::all();
        return view ('template.backend.admin.gaji.create',compact('data','umr','title','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required',
    //         'bulan' => 'required',
    //         'pendidikan' => 'required',
    //         'umr_id' => 'required',
    //         'Masa_kerja' => 'required',
    //         'Potongan' => 'numeric',
    //         'penyesuaian' => 'required',
    //         'index' => 'required'
    //     ]);
    //     $bulanYangDicari = $request->bulan; 
    //     $tahun = date('Y'); 
    //     $tanggalBulan = $tahun . '-' . $bulanYangDicari . '-01';

    //     $gaji = new gajian;
    //     $gaji->user_id = $request->user_id;
    //     $gaji->bulan = $tanggalBulan;
    //     $gaji->pendidikan = $request->pendidikan;
    //     $gaji->index = $request->index;

    //     $gaji->umr_id = $request->umr_id;
    //     // Mengambil nilai UMK berdasarkan umr_id
    //     $umr_id = $request->umr_id;
    //     $umk = UMKaryawan::where('id', $umr_id)->value('UMK');
    //     // Perhitungan THP
    //     $thp = ($umk * $request->index) / 100;
    //     $gaji->THP =$thp;
        
    //     // Perhitungan Gaji 80 %
    //     $gaji_80 = ($thp * 80) / 100;
    //     $gaji->Gaji = $gaji_80;
        
    //     // Perhitungan Insentif 20%
    //     $insentif = ($thp * 20) / 100;
    //     $gaji->Ach = $insentif;
    //     $gaji->Masa_kerja = $request->Masa_kerja;

    //     $gaji->Potongan = $request->Potongan;
    //     $gaji->Bonus = $request->Bonus;
    //     $gaji->penyesuaian = $request->penyesuaian;
    //     $gaji->status_admin = 'Pending';
    //     $gaji->status_penerima = 'Pending';

    //     if ($request->Masa_kerja == 1) {
    //         $total_potongan_bonus = $request->Potongan - $request->Bonus;
    //         $gaji_akhir = $gaji_80 - $total_potongan_bonus + $request->penyesuaian;
    //         $gaji->Gaji_akhir = max($gaji_akhir, 0);
    //     } elseif ($request->Masa_kerja == 0) {
    //         $masa = $gaji_80 * 0.8;
    //         $total_potongan_bonus = $request->Potongan - $request->Bonus;
    //         $gaji_akhir = $masa - $total_potongan_bonus + $request->penyesuaian;
    //         $gaji->Gaji_akhir = max($gaji_akhir, 0);
    //     } else {
    //         $gaji->Gaji_akhir = null;
    //     }        
    //     // $gaji->Potongan = $request->Potongan;
    //     // $gaji->Bonus = $request->Bonus;
    //     // $gaji->penyesuaian = 0;
    //     // $gaji->status_admin = 'Pending';
    //     // $gaji->status_penerima = 'Pending';
        
    //     $gaji->save();
    //     // return $gaji;
    //     if($gaji){
    //         return redirect('/index-persentase')->with('success','Data Berhasil Di Simpan.');
    //     }else{
    //         return redirect()->back()->with('error','Data Gagal Untuk Di Simpan.');
    //     }
    // }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'bulan' => 'required',
            'pendidikan' => 'required',
            'umr_id' => 'required',
            'Masa_kerja' => 'required',
            'Potongan' => 'numeric',
            'penyesuaian' => 'required',
            'index' => 'required'
        ]);
        $bulanYangDicari = $request->bulan; 
        $tahun = date('Y'); 
        $tanggalBulan = $tahun . '-' . $bulanYangDicari . '-01';

        $gaji = new gajian;
        $gaji->user_id = $request->user_id;
        $gaji->bulan = $tanggalBulan;
        $gaji->pendidikan = $request->pendidikan;
        $gaji->index = $request->index;

        $gaji->umr_id = $request->umr_id;
        // Mengambil nilai UMK berdasarkan umr_id
        $umr_id = $request->umr_id;
        $umk = UMKaryawan::where('id', $umr_id)->value('UMK');
        // Perhitungan THP
        $thp = ($umk * $request->index) / 100;
        $gaji->THP =$thp;
        
        // Perhitungan Gaji 80 %
        $gaji_80 = ($thp * 80) / 100;
        $gaji->Gaji = $gaji_80;
        
        // Perhitungan Insentif 20%
        $insentif = ($thp * 20) / 100;
        $gaji->Ach = $insentif;
        $gaji->Masa_kerja = $request->Masa_kerja;

        $gaji->Potongan = $request->Potongan;
        $gaji->Bonus = $request->Bonus;
        $gaji->penyesuaian = $request->penyesuaian;
        $gaji->status_admin = 'Pending';
        $gaji->status_penerima = 'Pending';

        $hireDate = Carbon::parse($request->bergabung);
        $exitDate = $request->berakhir ? Carbon::parse($request->berakhir) : Carbon::now();
        $lengthService = $hireDate->diff($exitDate);
        $years = $lengthService->y;
        $month = $lengthService->m;
        $lamakerja = $years . ' tahun ' . $month +1 . ' bulan';
        $gaji->masa_kerja_karyawan = $lamakerja;
        $gaji->bergabung = $hireDate->toDateString();
        $gaji->berakhir = $exitDate->toDateString();
                
        if ($request->Masa_kerja == 1) {
            $total_potongan_bonus = $request->Potongan - $request->Bonus;
            $gaji_akhir = $gaji_80 - $total_potongan_bonus + $request->penyesuaian;
            $gaji->Gaji_akhir = max($gaji_akhir, 0);
        } elseif ($request->Masa_kerja == 0) {
            $masa = $gaji_80 * 0.8;
            $total_potongan_bonus = $request->Potongan - $request->Bonus;
            $gaji_akhir = $masa - $total_potongan_bonus + $request->penyesuaian;
            $gaji->Gaji_akhir = max($gaji_akhir, 0);
        } else {
            $gaji->Gaji_akhir = null;
        }        
        // $gaji->Potongan = $request->Potongan;
        // $gaji->Bonus = $request->Bonus;
        // $gaji->penyesuaian = 0;
        // $gaji->status_admin = 'Pending';
        // $gaji->status_penerima = 'Pending';
        
        $gaji->save();
        // return $gaji;
        if($gaji){
            return redirect('/index-persentase')->with('success','Data Berhasil Di Simpan.');
        }else{
            return redirect()->back()->with('error','Data Gagal Untuk Di Simpan.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Payroll';
        $type = 'gaji';
        $data = User::all();
        $umr = UMKaryawan::all();
        $gaji = gajian::find($id);
        // return $gaji;
        return view('template.backend.admin.gaji.edit',compact('title','data','umr','gaji','type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bulanYangDicari = $request->bulan; 
        $tahun = date('Y'); 
        $tanggalBulan = $tahun . '-' . $bulanYangDicari . '-01';

        $gaji = gajian::find($id);
        $gaji->user_id = $request->user_id;
        $gaji->bulan = $tanggalBulan;
        $gaji->pendidikan = $request->pendidikan;
        $gaji->index = $request->index;

        $gaji->umr_id = $request->umr_id;
        // $gaji->index = $request->index;
        // Mengambil nilai UMK berdasarkan umr_id
        $umr_id = $request->umr_id;
        $umk = UMKaryawan::where('id', $umr_id)->value('UMK');
        // Perhitungan THP
        $thp = ($umk * $request->index) / 100;
        $gaji->THP =$thp;
        
        // Perhitungan Gaji 80 %
        $gaji_80 = ($thp * 80) / 100;
        $gaji->Gaji = $gaji_80;
        
        // Perhitungan Insentif 20%
        $insentif = ($thp * 20) / 100;
        $gaji->Ach = $insentif;
        $gaji->Masa_kerja = $request->Masa_kerja;
        
        // Perhitungan Gaji Akhir
        // if ($request->Masa_kerja == 1) {
        //     $gaji->Gaji_akhir = $gaji_80 - $request->Potongan;
        // } elseif ($request->Masa_kerja == 0) {
        //     $masa = $gaji_80 * 0.8;
        //     $gaji->Gaji_akhir = $masa - $request->Potongan;
        // } else {
        //     $gaji->Gaji_akhir = null;
        // }
        $gaji->Potongan = $request->Potongan;
        $gaji->Bonus = $request->Bonus;
        $gaji->status_admin = 'Pending';
        $gaji->status_penerima = 'Pending';
        $gaji->penyesuaian = $request->penyesuaian;

        $hireDate = Carbon::parse($request->bergabung);
        $exitDate = $request->berakhir ? Carbon::parse($request->berakhir) : Carbon::now();
        $lengthService = $hireDate->diff($exitDate);
        $years = $lengthService->y;
        $month = $lengthService->m;
        $lamakerja = $years . ' tahun ' . $month +1 . ' bulan';
        $gaji->masa_kerja_karyawan = $lamakerja;
        $gaji->bergabung = $hireDate->toDateString();
        $gaji->berakhir = $exitDate->toDateString();

        if ($request->Masa_kerja == 1) {
            $total_potongan_bonus = $request->Potongan - $request->Bonus;
            $gaji_akhir = $gaji_80 - $total_potongan_bonus + $request->penyesuaian;
            $gaji->Gaji_akhir = max($gaji_akhir, 0);

        } elseif ($request->Masa_kerja == 0) {
            $masa = $gaji_80 * 0.8;
            $total_potongan_bonus = $request->Potongan - $request->Bonus;
            $gaji_akhir = $masa - $total_potongan_bonus + $request->penyesuaian;
            $gaji->Gaji_akhir = max($gaji_akhir, 0);
            
        } else {
            $gaji->Gaji_akhir = null;
        }        
        // $gaji->Potongan = $request->Potongan;
        // $gaji->Bonus = $request->Bonus;
        // $gaji->status_admin = 'Pending';
        // $gaji->status_penerima = 'Pending';
        // $gaji->penyesuaian =0;
        
        $gaji->save();
        // return $gaji;
        if($gaji){
            return redirect('/index-persentase')->with('success','Data Berhasil Di Update.');
        }else{
            return redirect()->back()->with('error','Data Gagal Untuk Di Simpan.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = gajian::find($id);
        $data ->delete();
        if($data){
            return redirect()->back()->with('success','Data Berhasil Di Hapus.');
        }else{
            return redirect()->back()->with('error','Data Gagal Untuk Di Hapus.');
        }
    }
    
    public function ConfirmTransfer(Request $request ,$id)
    {
        $gaji = gajian::find($id);
        if($gaji->status_admin == 'Pending'){
            $gaji->update(['status_admin' => 'completed']);
            return redirect()->back()->with('success','Transfer Berhasil Dilakukan');
        }else{
            return redirect()->back()->with('error','Transfer Gagal Untuk Dilakukan.');
        }
    }
    
    public function ConfirmPenerima(Request $request,$id)
    {
        $gaji = gajian::find($id);
        if($gaji->status_penerima == 'Pending'){
            $gaji->update(['status_penerima' => 'success']);
            return redirect()->back()->with('success','Transfer Berhasil Dikonfirmasi');
        }else{
            return redirect()->back()->with('error','Transfer Gagal Untuk Dikonfirmasi.');
        }
    }

    public function CreateMultipleGaji()
    {
        $title = 'Payroll Multiple';
        $type = 'gaji';
        $data = User::all();
        $umr = UMKaryawan::all();
        return view('template.backend.admin.gaji.create-multiple',compact('title','type','data','umr'));
    }

    // public function StoreMultipleGaji(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'user_id' => 'required',
    //     ],[
    //         'user_id.required' => 'Nama Pegawai tidak boleh kosong',
    //     ]);
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->with('errorForm', $validator->errors()->getMessages())
    //             ->withInput();
    //     }
    //     $selectedUsers = $request->input('user_id');

    //     $bulanYangDicari = $request->bulan; 
    //     $tahun = date('Y'); 
    //     $tanggalBulan = $tahun . '-' . $bulanYangDicari . '-01';

    //     $startDate = '2023-10-02';
    //     $endDate = '2023-10-02';
    //     $data = gajian::where('user_id',$selectedUsers)
    //                         ->where(function ($query) use ($startDate, $endDate) {
    //                             $query->where('bulan', '<=', $endDate)
    //                         ->where('bulan', '>=', $startDate);
    //                         })
    //                         ->select('umr_id','index','THP','Gaji','Ach','Masa_kerja','Gaji_akhir','status_admin','status_penerima','penyesuaian')
    //                         ->first();
    //     if($data){
    //         foreach($selectedUsers as $usersId){
    //             $gajian = [
    //                 'user_id' => $usersId,
    //                 'umr_id' => $data->umr_id,
    //                 'pendidikan' => $data->pendidikan,
    //                 'bulan' => $tanggalBulan,
    //                 'index' => $data->index,
    //                 'THP' => $data->THP,
    //                 'Gaji' => $data->Gaji,
    //                 'Ach' => $data->Ach,
    //                 'status_admin' => $data->status_admin,
    //                 'status_penerima' => $data->status_penerima,
    //                 'penyesuaian' => $data->penyesuaian,
    //                 'Bonus' => $request->Bonus,
    //                 'Potongan' => $request->Potongan,
    //             ];
    //             return $gajian;
    //         }
    //     }else{
    //         //handle error data tidak di temukan
    //         return redirect()->back()->with('error','Data Pegawai Tidak Ada.');
    //     }
    //     // $data = gajian::where('user_id', $user_id)
    //     //                 ->whereMonth('bulan', $bulan_data)
    //     //                 ->whereYear('bulan', $tahun)
    //     //                 ->select('umr_id','index','THP','Gaji','Ach','Masa_kerja','Gaji_akhir')
    //     //                 ->first();

    // }
    public function StoreMultipleGaji(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'bulan' => 'required|date_format:m',
        ], [
            'user_id.required' => 'Nama Pegawai tidak boleh kosong',
            'bulan.required' => 'Bulan harus diisi',
            'bulan.date_format' => 'Format bulan tidak valid',        
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $selectedUsers = $request->input('user_id');
        $selectedBulan = $request->bulan;
        $tahun = date('Y');
        $tanggalBulan = $tahun . '-' . $selectedBulan . '-01';

        $startDate = '2023-11-01';
        $endDate = '2023-11-31';

        foreach ($selectedUsers as $usersId) {
            $tempData = gajian::where('user_id', $usersId)
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->where('bulan', '<=', $endDate)
                        ->where('bulan', '>=', $startDate);
                })
                ->select('umr_id','pendidikan', 'index', 'THP', 'Gaji', 'Ach', 'Masa_kerja', 'Gaji_akhir', 'status_admin', 'status_penerima', 'penyesuaian','Bonus','Potongan')
                ->first();

            if ($tempData) {      
                $gajian = new gajian;
                $gajian-> user_id = $usersId;
                $gajian ->umr_id = $tempData->umr_id;
                $gajian->pendidikan = $tempData->pendidikan;
                $gajian -> bulan = $tanggalBulan;
                $gajian->index = $tempData->index;
                $gajian->THP = $tempData->THP;
                $gajian->Gaji = $tempData->Gaji;                    
                $gajian->Ach = $tempData->Ach;
                $gajian->Masa_kerja= $tempData->Masa_kerja;
                $gajian->Gaji_akhir= $tempData->Gaji_akhir;
                $gajian->status_admin = $tempData->status_admin;
                $gajian->status_penerima = $tempData->status_penerima;
                $gajian->penyesuaian = $tempData->penyesuaian;
                $gajian->Bonus = $tempData->Bonus;
                $gajian->Potongan = $tempData->Potongan;

                $existingData = gajian::where('user_id', $usersId)
                ->where('bulan', $tanggalBulan)
                ->first();
                if (!$existingData) {
                    $gajian->save();
                }else {
                    return redirect()->back()->with('error','Data User Pada Bulan Ini sudah Ada.');
                }   

                // $gajian->save();
                // $gajian = [
                //     'user_id' => $usersId,
                //     'umr_id' => $tempData->umr_id,
                //     'pendidikan' => $tempData->pendidikan,
                //     'bulan' => $tanggalBulan,
                //     'index' => $tempData->index,
                //     'THP' => $tempData->THP,
                //     'Gaji' => $tempData->Gaji,
                //     'Ach' => $tempData->Ach,
                //     'Masa_kerja' => $tempData->Masa_kerja,
                //     'Gaji_akhir' => $tempData->Gaji_akhir,
                //     'status_admin' => $tempData->status_admin,
                //     'status_penerima' => $tempData->status_penerima,
                //     'penyesuaian' => $tempData->penyesuaian,
                //     'Bonus' => $request->Bonus,
                //     'Potongan' => $request->Potongan,
                // ];
            }else{
                return redirect()->back()->with('error','Data Tidak Ada');
            }
        }
        return redirect()->back()->with('success', 'Data Gaji Pegawai Berhasil Disimpan.');
    }

    public function GetDataMultipleGaji(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => 'required',
            'bulantarget' => 'required'
        ], [
            'bulan.required' => 'Kolom Target wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $tahun = date('Y');
        $startDate = $request->bulan;
        $endDate = $request->bulan;

        // Menghitung tanggal awal dan akhir untuk bulan yang dipilih
        $tanggalawal = $tahun . '-' . $startDate . '-01';
        $tanggalakhir = $tahun . '-' . $endDate . '-31';
        // $tanggalakhir = date('Y-m-t', strtotime($tanggalawal));

        // Mendapatkan bulan dan tahun target
        $waktuAwal = explode('-', $request->bulantarget);
        $waktuBulan = $waktuAwal[1];
        $waktuTahun = $waktuAwal[0];
        $waktuawal = $waktuTahun . '-' . $waktuBulan . '-01';

        // Menghitung tanggal akhir bulan target
        // $tanggalakhirTarget = date('Y-m-t', strtotime($waktuawal));

        // $namaBulan = [
        //     'January', 'February', 'Maret', 'April', 'Mei', 'Juni',
        //     'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        // ];

        // Mendapatkan user IDs dengan masa aktif antara tanggalawal dan tanggalakhir
        $userIds = gajian::where('bulan', '>=', $tanggalawal)
            ->where('bulan', '<=', $tanggalakhir)
            ->pluck('user_id');
        $data = [];

        foreach ($userIds as $userId) {
            $targetData = gajian::where('user_id', $userId)
                ->where('bulan', '>=', $tanggalawal)
                ->where('bulan', '<=', $tanggalakhir)
                ->select('bulan', 'pendidikan', 'umr_id', 'index', 'THP', 'Gaji', 'Ach', 'Bonus', 'Masa_kerja', 'Gaji_akhir', 'Potongan',
                    'penyesuaian', 'status_admin', 'status_penerima', 'masa_kerja_karyawan','bergabung','berakhir')
                ->first();

            if (!$targetData) {
                // Jika data gaji untuk user dan bulan yang dimaksud tidak ditemukan, lanjutkan ke pengembalian pesan error
                return redirect()->back()->with('error', 'Data Gaji User Pada Bulan Ini sudah Ada.');
            }

            if($targetData)
            {
                $rowData = [
                    'user_id' => $userId,
                    'bulan' => $waktuawal,
                    'pendidikan' => $targetData->pendidikan ?? null,
                    'umr_id' => $targetData->umr_id ?? null,
                    'index' => $targetData->index ?? null,
                    'THP' => $targetData->THP ?? null,
                    'Gaji' => $targetData->Gaji ?? null,
                    'Ach' => $targetData->Ach ?? null,
                    'Bonus' => $targetData->Bonus ?? null,
                    'Masa_kerja' => $targetData->Masa_kerja ?? null,
                    'Gaji_akhir' => $targetData->Gaji_akhir ?? null,
                    'Potongan' => $targetData->Potongan ?? null,
                    'penyesuaian' => $targetData->penyesuaian ?? null,
                    'status_admin' => $targetData->status_admin ?? null,
                    'status_penerima' => $targetData->status_penerima ?? null,
                    'masa_kerja_karyawan' => $targetData->masa_kerja_karyawan ?? null,
                    'bergabung' => $targetData->bergabung ?? null,
                    'berakhir' => $targetData->berakhir ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $data[] = $rowData;    
            }
        }
        if (!empty($data)) {
            gajian::insert($data);
            // return $data;
            return redirect()->back()->with('success', 'Terimakasih, Data Gaji Terbaru Berhasil Disimpan');
        }else{
            return redirect()->back()->with('error','Maaf Terjadi Kesalahan Saat Mengambil Data.');
        }
        // return $userIds;
    }

    public function download_gaji(Request $request)
    {
        $request->validate([
            'bulan' => ['required']
        ]);

        $waktu = explode('-', $request->bulan);
        $tahun = $waktu[0];
        $bulan = $waktu[1];

        $data = gajian::whereYear('bulan', $tahun)
                        ->whereMonth('bulan', $bulan)
                        ->get();
        
        $total = gajian::whereYear('bulan', $tahun)
                        ->whereMonth('bulan', $bulan)
                        ->sum('Gaji_akhir');

        $pdf = PDF::loadview('template.backend.admin.gaji.download-gaji', ['data' => $data, 'total' => $total]);
        return $pdf->download('download-gaji.pdf');
    }

    public function excel_gaji(Request $request)
    {
        $request->validate([
            'bulan' => ['required']
        ]);
        $waktu = explode('-', $request->bulan);
        $tahun = $waktu[0];
        $bulan = $waktu[1];
    
        $data = gajian::whereYear('bulan', $tahun)
                     ->whereMonth('bulan', $bulan)
                     ->orderBy('bulan', 'asc')
                     ->get();
    
        return Excel::download(new GajiExport($data), 'Gaji-Karyawan.xlsx');
    }
    // public function download_gaji()
    // {
    //     $request->validate([
    //         'bulan' => ['required']
    //     ]);
    //     $waktu = explode('-', $request->bulan);
    //     $data = gajian::whereYear('bulan', $waktu[1])
    //                     ->whereMonth('bulan', $waktu[0])
    //                     ->get();
    //     $total = gajian::whereYear('bulan',$tahun)->whereMonth('bulan',$bulan)->sum('Gaji_akhir');        

    //     // $data = jadwal::all();
    //     $pdf = PDF::loadview('template.backend.admin.gaji.download-gaji',['data'=>$data, 'total' => $total]);
    //     return $pdf->download('download-gaji');
    // }

    //zona pegawai
    public function IndexGajiPegawai()
    {
        $title = 'Gaji Karyawan';
        $type = 'insentif & gaji';
        $bulanTahunSekarang = date('Y-m');
        $bulan = date('m', strtotime('last month')); 
        $tahun = date('Y', strtotime('last month')); 
        // $bulan = date('m');
        // $tahun = date('Y');
        $user = Auth::user()->id;
        // $gaji = gajian::all();
        $gaji = gajian::where('user_id',$user)
                        ->whereYear('bulan', $tahun)
                        ->whereMonth('bulan', $bulan)
                        ->first();    
                        // return $gaji;
        $notifications = Auth::user()->notifications()
                        ->whereYear('created_at', Carbon::now()->year)
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->orderBy('created_at', 'desc')->take(3)->get();

        if(!$gaji){
            return redirect()->back()->with('error','Mohon maaf, Slip Gaji Anda pada periode sekarang belum ada.');
        }
        // return view ('frontend.users.gaji.gaji',compact('title','gaji'));
        return view ('template.backend.karyawan.page.slip.gaji',compact('type','title','gaji','notifications'));
    }

    public function insentifPegawai()
    {
        $title = 'Insentif Karyawan';
        $type = 'insentif & gaji';
        $bulanTahunSekarang = date('Y-m');
        $bulan = date('m', strtotime('last month')); 
        $tahun = date('Y', strtotime('last month')); 
        $user = Auth::user()->id;
        $kinerja = kpi::where('user_id', $user)
                        ->whereYear('bulan', $tahun)
                        ->whereMonth('bulan', $bulan)
                        ->first();    
        $gaji = InsentifKpi::where('user_id',$user)
                        ->whereYear('bulan', $tahun)
                        ->whereMonth('bulan', $bulan)
                        ->first();    
        $catatan = NoteKaryawan::where('user_id',$user)
                        ->whereYear('bulan', $tahun)
                        ->whereMonth('bulan', $bulan)
                        ->value('resume');
                        // return $gaji;
        $notifications = Auth::user()->notifications()
                        ->whereYear('created_at', Carbon::now()->year)
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->orderBy('created_at', 'desc')->take(3)->get();

        if(!$gaji){
            return redirect()->back()->with('error','Mohon maaf, Slip Insentif Anda pada periode sekarang belum ada.');
        }
        // return $catatan;
        // return view ('frontend.users.gaji.insentif',compact('title','gaji','kinerja','catatan'));
        return view ('template.backend.karyawan.page.slip.insentif',compact('title','gaji','kinerja','catatan','type','notifications'));

    }

    //zona UMR
    public function indexUMR()
    {
        $title = 'Setting UMR';
        $type = 'gaji';
        $data = UMKaryawan::all();
        return view ('template.backend.admin.gaji.umr',compact('title','data','type'));
    }

    public function createUMR()
    {
        $title = 'Setting UMR';
        return view('template.backend.admin.gaji.create-umr',compact('title'));
    }

    public function saveUMR(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'UMK' => 'numeric',
        ]);

        $umr = new UMKaryawan;
        $umr -> name = $request->name;
        $umr -> UMK = $request->UMK;
        $data = $request->UMK;
        $hasil_data = round($data);
        $hasil_rupiah_data = "Rp." . number_format($hasil_data, 0, ',', '.');
        $umr->Rp = $hasil_rupiah_data;
        $umr ->save();
        // return $umr;
        if($umr){
            return redirect('/index-UMR')->with('success','Data Berhasil Disimpan.');
        }else{
            return redirect()->back()->with('error', 'Input UMR hanya dengan Angka, Tidak Dengan Karakter');
        }
    }

    public function hapusUMR($id)
    {
        $data = UMKaryawan::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        $data->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus.');
    }
    
}
