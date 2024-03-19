<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\THR_lebaran;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
        return view('template.backend.admin.THR.index',compact('title','type','data','total'));
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
        $validator = Validator::make($request->all(),[
            'bulan' => 'required',
        ],[
            'bulan.required' => 'Bulan Tidak Boleh Kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }    

        $data = new THR_lebaran;
    }

    public function destroy($id)
    {
        $data = THR_lebaran::find($id);
        $data -> delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus.');
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
}
