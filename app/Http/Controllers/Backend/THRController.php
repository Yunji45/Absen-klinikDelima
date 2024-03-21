<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\THR_lebaran;
use App\Models\User;
use App\Models\gajian;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Exports\THRExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class THRController extends Controller
{
    public function index()
    {
        $title = 'THR Idul Fitri';
        $type = 'gaji';
        $tahun = date('Y');
        $data = THR_lebaran::whereYear('bulan', $tahun)
                            ->orderBy('created_at', 'desc')
                            ->get();
        $total = THR_lebaran::whereYear('bulan',$tahun)->sum('THR');
        $user = THR_lebaran::whereYear('bulan',$tahun)->count();
        // $bulan_sebelumnya = Carbon::now()->subMonth();
        // $userIds = Gajian::whereYear('bulan', $bulan_sebelumnya->year)
        //                 ->whereMonth('bulan', $bulan_sebelumnya->month)
        //                 ->pluck('user_id');
        // return $userIds;
        return view('template.backend.admin.THR.index',compact('title','type','data','total','user'));
    }

    public function create()
    {
        $title = 'THR Idul Fitri';
        $type = 'gaji';
        $data = User::all();
        return view('template.backend.admin.THR.create',compact('title','type','data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
        ],[
            'user_id.required' => 'User Tidak Boleh Kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }    

        $data = new THR_lebaran;
        $data ->user_id = $request->user_id;
        $data ->bulan = Carbon::now()->format('Y-m-d');
        $data ->pendidikan = $request->pendidikan;
        $data ->gaji_terakhir = $request->gaji_terakhir;

        $hireDate = Carbon::parse($request->masuk);
        $exitDate = $request->keluar ? Carbon::parse($request->keluar) : Carbon::now();
        $lengthService = $hireDate->diff($exitDate);
        $years = $lengthService->y;
        $month = $lengthService->m;
        $lamakerja = $years . ' tahun ' . $month +1 . ' bulan';
        $data->masa_kerja = $lamakerja;
        $data->masuk = $hireDate->toDateString();
        $data->keluar = $exitDate->toDateString();
        
        $data ->index = $request->index;
        $data ->THR = ($request->gaji_terakhir * $request->index) / 100;
        $data ->save();
        // return $data;

        return redirect()->route('thr.idul-fitri')->with('success','Data Berhasil Disimpan');

    }

    public function GetDataMultiple(Request $request)
    {
        
        $bulan_sebelumnya = Carbon::now()->subMonth();
        $userIds = Gajian::whereYear('bulan', $bulan_sebelumnya->year)
                        ->whereMonth('bulan', $bulan_sebelumnya->month)
                        ->pluck('user_id');
        $data = [];

        foreach ($userIds as $userId) {
            $targetData = gajian::where('user_id', $userId)
                ->whereYear('bulan', $bulan_sebelumnya->year)
                ->whereMonth('bulan', $bulan_sebelumnya->month)
                ->select('bulan', 'pendidikan','Masa_kerja', 'Gaji_akhir','masa_kerja_karyawan','bergabung','berakhir')
                ->first();

            if (!$targetData) {
                return redirect()->back()->with('error', 'Data Gaji User Pada Bulan Ini sudah Ada.');
            }

            if($targetData)
            {
                $rowData = [
                    'user_id' => $userId,
                    'bulan' => now()->format('Y-m-d'),
                    'pendidikan' => $targetData->pendidikan ?? null,
                    'gaji_terakhir' => $targetData->Gaji_akhir ?? null,
                    'masa_kerja' => $targetData->masa_kerja_karyawan ?? null,
                    'masuk' => $targetData->bergabung ?? null,
                    'keluar' => $targetData->berakhir ?? null,
                    'THR' => 0,
                    'index' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $data[] = $rowData;    
            }
        }
        if (!empty($data)) {
            THR_lebaran::insert($data);
            // return $data;
            return redirect()->back()->with('success', 'Terimakasih, Data THR Terbaru Berhasil Disimpan');
        }else{
            return redirect()->back()->with('error','Maaf Terjadi Kesalahan Saat Mengambil Data.');
        }
        // return $userIds;
    }

    public function edit($id)
    {
        $title = 'THR Idul Fitri';
        $type = 'gaji';
        $data = User::all();
        $thr = THR_lebaran::find($id);
        return view('template.backend.admin.THR.edit',compact('title','type','data','thr'));
    }

    public function update(Request $request, $id)
    {
        $data = THR_lebaran::find($id);
        $data ->user_id = $request->user_id;
        $data ->bulan = Carbon::now()->format('Y-m-d');
        $data ->pendidikan = $request->pendidikan;
        $data ->gaji_terakhir = $request->gaji_terakhir;

        $hireDate = Carbon::parse($request->masuk);
        $exitDate = $request->keluar ? Carbon::parse($request->keluar) : Carbon::now();
        $lengthService = $hireDate->diff($exitDate);
        $years = $lengthService->y;
        $month = $lengthService->m;
        $lamakerja = $years . ' tahun ' . $month +1 . ' bulan';
        $data->masa_kerja = $lamakerja;
        $data->masuk = $hireDate->toDateString();
        $data->keluar = $exitDate->toDateString();
        
        $data ->index = $request->index;
        $data ->THR = ($request->gaji_terakhir * $request->index) / 100;
        $data ->save();
        // return $data;

        return redirect()->route('thr.idul-fitri')->with('success','Data Berhasil Diupdate.');

    }

    public function destroy($id)
    {
        $data = THR_lebaran::find($id);
        $data -> delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus.');
    }

    public function THR_Excel()
    {
        $tahun = Carbon::now()->year;
        $data = THR_lebaran::whereYear('bulan', $tahun)
                        ->orderBy('bulan', 'asc')
                        ->get();
        return Excel::download(new THRExport($data), 'THR-Idul-Fitri-MD.xlsx');
    }

    public function THR_pdf(Request $request)
    {
        $tahun = date('Y');
        $data = THR_lebaran::whereYear('bulan', $tahun)
                        ->get();
        
        $total = THR_lebaran::whereYear('bulan', $tahun)
                        ->sum('THR');

        $pdf = PDF::loadview('template.backend.admin.THR.pdf', ['data' => $data, 'total' => $total]);
        return $pdf->download('THR-Karyawan-MD.pdf');
    }
}
