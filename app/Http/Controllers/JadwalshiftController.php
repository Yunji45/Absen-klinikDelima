<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwal;
use App\Models\jadwalterbaru;
use App\Models\rubahjadwal;
use App\Models\shift;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use PDF;
use Auth;
use Carbon\Carbon;
use App\Notifications\AbsensiNotification;
use App\Notifications\AbsensiExitNotification;
use App\Imports\JadwalShiftImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class JadwalshiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Jadwal Shift';
        // $data = jadwal::all();
        $type = 'jadwal';
        $user = User::all();
        $bulan = date('m');
        $tahun = date('Y');
        // $bulan = date('01');
        // $tahun = date('2024');
    
        $data = jadwalterbaru::whereYear('masa_aktif', $tahun)
                    ->whereMonth('masa_aktif', $bulan)
                    ->get();    

                    $permohonan = rubahjadwal::whereIn('status', ['pengajuan','approve'])
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

                    $backgroundClass = '';

                    foreach ($permohonan as $item) {
                        if ($item->status === 'approve') {
                            if ($item->permohonan == 'ganti_jaga') {
                                $backgroundClass = 'bg-merah';
                            } elseif ($item->permohonan == 'tukar_jaga') {
                                $backgroundClass = 'bg-hijau';
                            }
                            // Jika status adalah 'approve', maka $backgroundClass akan diubah sesuai permohonan.
                            // Jika status bukan 'approve', maka $backgroundClass akan tetap seperti variabel default.
                        }
                    }
        // return $user;        
        return view ('template.backend.admin.jadwal.index',compact('title','data','user','bulan','tahun','backgroundClass','permohonan','type'));
    }

    public function indexUser()
    {
        $title = 'Jadwal Shift';
        $type = 'component';
        $bulan = date('m');
        $tahun = date('Y');
        $notifications = Auth::user()->notifications()
                    ->whereYear('created_at', Carbon::now()->year)
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->orderBy('created_at', 'desc')->take(3)->get();

        $data = jadwalterbaru::whereUserId(auth()->user()->id)
                    ->whereYear('masa_aktif', $tahun)
                    ->whereMonth('masa_aktif', $bulan)
                    ->get();    
        // return view ('frontend.users.jadwal.index',compact('title','data','tahun','bulan'));
        return view ('template.backend.karyawan.page.jadwal.index',compact('title','data','tahun','bulan','type','notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'bulan' => 'required',
            'masa_aktif' => 'required',
            'masa_akhir' => 'required',
        ]);

        $data = new jadwalterbaru;
        $data ->user_id= $request->user_id;
        $data ->bulan = $request->bulan;
        $data ->masa_aktif = $request->masa_aktif;
        $data ->masa_akhir = $request->masa_akhir;
        $data ->j1 = $request->j1;
        $data ->j2 = $request->j2;
        $data ->j3 = $request->j3;
        $data ->j4 = $request->j4;
        $data ->j5 = $request->j5;
        $data ->j6 = $request->j6;
        $data ->j7 = $request->j7;
        $data ->j8 = $request->j8;
        $data ->j9 = $request->j9;
        $data ->j10 = $request->j10;
        $data ->j11 = $request->j11;
        $data ->j12 = $request->j12;
        $data ->j13 = $request->j13;
        $data ->j14 = $request->j14;
        $data ->j15 = $request->j15;
        $data ->j16 = $request->j16;
        $data ->j17 = $request->j17;
        $data ->j18 = $request->j18;
        $data ->j19 = $request->j19;
        $data ->j20 = $request->j20;
        $data ->j21 = $request->j21;
        $data ->j22 = $request->j22;
        $data ->j23 = $request->j23;
        $data ->j24 = $request->j24;
        $data ->j25 = $request->j25;
        $data ->j26 = $request->j26;
        $data ->j27 = $request->j27;
        $data ->j28 = $request->j28;
        $data ->j29 = $request->j29;
        $data ->j30 = $request->j30;
        $data ->j31 = $request->j31;
        $data ->save();
        // return $data;
        return redirect()->back()->with('success','Data Jadwal User Tersebut Berhasil Di tambahkan');
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
        $title = 'Edit Jadwal Shift';
        $jadwal = jadwalterbaru::find($id);
        $user = User::all();
        $bulan = date('m');
        $tahun = date('Y');
    
        $data = jadwalterbaru::whereYear('masa_aktif', $tahun)
                            ->whereMonth('masa_aktif', $bulan)
                            ->get();    
        // return $user;
        return view ('backend.admin.jadwalshift.edit',compact('title','user','data','bulan','tahun','jadwal'));
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
        $request->validate([
            'user_id' => 'required',
            'bulan' => 'required',
            'masa_aktif' => 'required',
            'masa_akhir' => 'required',
        ]);

        $data = jadwalterbaru::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Jadwal Terbaru tidak ditemukan');
        }
        $data->user_id = $request->input('user_id');
        $data->bulan = $request->input('bulan');
        $data->masa_aktif = $request->input('masa_aktif');
        $data->masa_akhir = $request->input('masa_akhir');
        $data ->j1 = $request->j1;
        $data ->j2 = $request->j2;
        $data ->j3 = $request->j3;
        $data ->j4 = $request->j4;
        $data ->j5 = $request->j5;
        $data ->j6 = $request->j6;
        $data ->j7 = $request->j7;
        $data ->j8 = $request->j8;
        $data ->j9 = $request->j9;
        $data ->j10 = $request->j10;
        $data ->j11 = $request->j11;
        $data ->j12 = $request->j12;
        $data ->j13 = $request->j13;
        $data ->j14 = $request->j14;
        $data ->j15 = $request->j15;
        $data ->j16 = $request->j16;
        $data ->j17 = $request->j17;
        $data ->j18 = $request->j18;
        $data ->j19 = $request->j19;
        $data ->j20 = $request->j20;
        $data ->j21 = $request->j21;
        $data ->j22 = $request->j22;
        $data ->j23 = $request->j23;
        $data ->j24 = $request->j24;
        $data ->j25 = $request->j25;
        $data ->j26 = $request->j26;
        $data ->j27 = $request->j27;
        $data ->j28 = $request->j28;
        $data ->j29 = $request->j29;
        $data ->j30 = $request->j30;
        $data ->j31 = $request->j31;
        $data->save();
        if($data){
            return redirect()->route('jadwal.shift')->with('success','Terimakasih Telah Update Jadwal Terbaru');
        }else{
            return redirect()->back()->with('error','Update Jadwal Terbaru Gagal');
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
        $data= jadwalterbaru::find($id);
        $data->delete();
        if($data){
            return redirect()->back()->with('success','Data Jadwal User Berhasil Di Hapus Dari Database');
        }else{
            return redirect()->back()->with('erorr','Data Jadwal User Gagal Di Hapus Dari Database');
        }
    }

    public function jadwaldownload()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $data = jadwalterbaru::whereYear('masa_aktif', $tahun)
                        ->whereMonth('masa_aktif', $bulan)
                        ->get();
        // $data = jadwal::all();
        $pdf = PDF::loadview('backend.admin.jadwalshift.downloadjadwal',['data'=>$data]);
        return $pdf->download('Jadwal-Shift');            
    }

    public function cari(Request $request)
    {
        $title = 'Jadwal Shift';
        $type= 'jadwal';
        $user = User::all();
        $bulan = $request->input('bulan');
        $data = jadwalterbaru::where('masa_aktif', '>=', $bulan . '-01')
                        ->where('masa_akhir', '<=', $bulan . '-31')
                        ->get();
                
        return view ('template.backend.admin.jadwal.index',compact('data','title','user','type'));
    }

    public function cariJadwal(Request $request)
    {
        $title = 'Jadwal Shift';
        $bulan = $request->input('bulan');
        $data = jadwalterbaru::where('masa_aktif', '>=', $bulan . '-01')
                        ->where('masa_akhir', '<=', $bulan . '-31')
                        ->get();   
        return view ('frontend.users.jadwal.index',compact('title','data','bulan'));
    }

    public function StoreMultipleJadwal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => 'required',
            'bulantarget' => 'required'
        ], [
            'bulan.required' => 'Kolom Target wajib diisi.',
            // 'bulan.required' => 'Kolom bulan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $tahun = date('Y');
        $startDate = $request->bulan;
        $endDate = $request->bulan;

        $tanggalawal = $tahun . '-' . $startDate . '-01';
        $tanggalakhir = date('Y-m-t', strtotime($tanggalawal));

        $waktuAwal = explode('-', $request->bulantarget);
        $waktuBulan = $waktuAwal[1];
        $waktuTahun = $waktuAwal[0];
        $waktuawal = $waktuTahun . '-' . $waktuBulan . '-01';

        $tanggalakhirTarget = date('Y-m-t', strtotime($waktuawal));

        $namaBulan = [
            'January', 'February', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $userIds = jadwalterbaru::where('masa_aktif', '>=', $tanggalawal)
            ->where('masa_akhir', '<=', $tanggalakhir)
            ->pluck('user_id');

        foreach ($userIds as $userId) {
            $targetData = jadwalterbaru::where('user_id', $userId)
                ->where('masa_aktif', '>=', $tanggalawal)
                ->where('masa_akhir', '<=', $tanggalakhir)
                ->select('bulan','j1','j2','j3','j4','j5','j6','j7','j8','j9','j10',
                'j11','j12','j13','j14','j15','j16','j17','j18','j19','j20',
                'j21','j22','j23','j24','j25','j26','j27','j28','j29','j30',
                'j31')
                ->first();

            if ($targetData) {
                $rowData = [
                    'user_id' => $userId,
                    'bulan' => $namaBulan[$waktuBulan - 1],
                    'masa_aktif' => $waktuawal,
                    'masa_akhir' => $tanggalakhirTarget,
                    'j1' => $targetData->j1 ?? null,
                    'j2' => $targetData->j2 ?? null,
                    'j3' => $targetData->j3 ?? null,
                    'j4' => $targetData->j4 ?? null,
                    'j5' => $targetData->j5 ?? null,
                    'j6' => $targetData->j6 ?? null,
                    'j7' => $targetData->j7 ?? null,
                    'j8' => $targetData->j8 ?? null,
                    'j9' => $targetData->j9 ?? null,
                    'j10' => $targetData->j10 ?? null,
                    'j11' => $targetData->j11 ?? null,
                    'j12' => $targetData->j12 ?? null,
                    'j13' => $targetData->j13 ?? null,
                    'j14' => $targetData->j14 ?? null,
                    'j15' => $targetData->j15 ?? null,
                    'j16' => $targetData->j16 ?? null,
                    'j17' => $targetData->j17 ?? null,
                    'j18' => $targetData->j18 ?? null,
                    'j19' => $targetData->j19 ?? null,
                    'j20' => $targetData->j20 ?? null,
                    'j21' => $targetData->j21 ?? null,
                    'j22' => $targetData->j22 ?? null,
                    'j23' => $targetData->j23 ?? null,
                    'j24' => $targetData->j24 ?? null,
                    'j25' => $targetData->j25 ?? null,
                    'j26' => $targetData->j26 ?? null,
                    'j27' => $targetData->j27 ?? null,
                    'j28' => $targetData->j28 ?? null,
                    'j29' => $targetData->j29 ?? null,
                    'j30' => $targetData->j30 ?? null,
                    'j31' => $targetData->j31 ?? null,
                ];

                // Menyimpan data baru
                jadwalterbaru::create($rowData);
            } else {
                return redirect()->back()->with('error', 'Data User Pada Bulan Ini sudah Ada.');
            }
        }

        return redirect()->back()->with('success', 'Terimakasih, Data Jadwal Terbaru Berhasil Disimpan');
    }

    // public function StoreMultipleJadwal(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'bulan' => 'required',
    //         'bulantarget' => 'required'
    //     ], [
    //         'bulan.required' => 'Kolom Target wajib diisi.',
    //         // 'bulan.required' => 'Kolom bulan wajib diisi.',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->with('errorForm', $validator->errors()->getMessages())
    //             ->withInput();
    //     }
    //     $startDate = $request->bulan;
    //     $endDate = $request->bulan;
    //     $tahun = date('Y'); 
    //     $tanggalawal = $tahun . '-' . $startDate . '-01';
    //     $tanggalakhir = $tahun . '-' . $endDate . '-31';

    //     $waktuAwal = explode('-',$request->bulantarget);
    //     $waktuBulan = $waktuAwal[1];
    //     $waktuTahun = $waktuAwal[0];
    //     $waktuawal = $waktuTahun . '-' . $waktuBulan . '-01';
    //     $waktuakhir = $waktuTahun . '-' . $waktuBulan . '-31';

    //     $namaBulan = [
    //         'January', 'February', 'Maret', 'April', 'Mei', 'Juni',
    //         'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    //     ];    
    
    //     $userIds = jadwalterbaru::where('masa_aktif', '>=', $tanggalawal)
    //         ->where('masa_akhir', '<=', $tanggalakhir)
    //         ->pluck('user_id');
    
    //     $data = [];
    
    //     foreach ($userIds as $userId) {
    //         $targetData = jadwalterbaru::where('user_id', $userId)
    //             ->where('masa_aktif', '>=', $tanggalawal)
    //             ->where('masa_akhir', '<=', $tanggalakhir)
    //             ->select('bulan','j1','j2','j3','j4','j5','j6','j7','j8','j9','j10',
    //             'j11','j12','j13','j14','j15','j16','j17','j18','j19','j20',
    //             'j21','j22','j23','j24','j25','j26','j27','j28','j29','j30',
    //             'j31'
    //             )
    //             ->first();
    
    //         if ($targetData) {
    //             $rowData = [
    //                 'user_id' => $userId,
    //                 'bulan' => $namaBulan[$waktuBulan - 1],
    //                 'masa_aktif' => $waktuawal,
    //                 'masa_akhir' => $waktuakhir,
    //                 'j1' => $targetData->j1 ?? null,
    //                 'j2' => $targetData->j2 ?? null,
    //                 'j3' => $targetData->j3 ?? null,
    //                 'j4' => $targetData->j4 ?? null,
    //                 'j5' => $targetData->j5 ?? null,
    //                 'j6' => $targetData->j6 ?? null,
    //                 'j7' => $targetData->j7 ?? null,
    //                 'j8' => $targetData->j8 ?? null,
    //                 'j9' => $targetData->j9 ?? null,
    //                 'j10' => $targetData->j10 ?? null,
    //                 'j11' => $targetData->j11 ?? null,
    //                 'j12' => $targetData->j12 ?? null,
    //                 'j13' => $targetData->j13 ?? null,
    //                 'j14' => $targetData->j14 ?? null,
    //                 'j15' => $targetData->j15 ?? null,
    //                 'j16' => $targetData->j16 ?? null,
    //                 'j17' => $targetData->j17 ?? null,
    //                 'j18' => $targetData->j18 ?? null,
    //                 'j19' => $targetData->j19 ?? null,
    //                 'j20' => $targetData->j20 ?? null,
    //                 'j21' => $targetData->j21 ?? null,
    //                 'j22' => $targetData->j22 ?? null,
    //                 'j23' => $targetData->j23 ?? null,
    //                 'j24' => $targetData->j24 ?? null,
    //                 'j25' => $targetData->j25 ?? null,
    //                 'j26' => $targetData->j26 ?? null,
    //                 'j27' => $targetData->j27 ?? null,
    //                 'j28' => $targetData->j28 ?? null,
    //                 'j29' => $targetData->j29 ?? null,
    //                 'j30' => $targetData->j30 ?? null,
    //                 'j31' => $targetData->j31 ?? null,
    //             ];
    //             // $data[] = $rowData;    
    //                 jadwalterbaru::create($rowData);
                
    //         }else {
    //             return redirect()->back()->with('error', 'Data User Pada Bulan Ini sudah Ada.');
    //         }
    //     }
    //     // return $data;
    //     // return response()->json($data, 200);
    //     return redirect()->back()->with('success','Terimakasih , Data Jadwal Terbaru Berhasil Disimpan');
    // }

    public function DestroyAllJadwal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => 'required',
        ], [
            'bulan.required' => 'Bulan tidak boleh kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $target_awal = $request->bulan;
        $tahun = date('Y');
        $awal = $tahun . '-' . $target_awal . '-01';
        $akhir = $tahun . '-' . $target_awal . '-31';
        $deletedRows = jadwalterbaru::where('masa_aktif', '>=', $awal)
                    ->where('masa_akhir', '<=', $akhir)
                    ->delete();

        if ($deletedRows > 0) {
            return redirect()->back()->with('success', 'Semua Data Jadwal Pada Bulan Tersebut berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada data Jadwal yang ditemukan untuk dihapus pada bulan tersebut.');
        }
    }

    public function JadwalImport(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama = $file->hashName();
        $path = $file -> storeAs('public/jadwal/', $nama);
        $import = Excel::import(new JadwalShiftImport() , storage_path('app/public/jadwal/'. $nama));
        Storage::delete($path);
        if($import)
        {
            return redirect()->back()->with('success','Data Berhasil Di import.');
        }else{
            return redirect()->back()->with('error','Data Gagal Di import.');
        }
    }
}
