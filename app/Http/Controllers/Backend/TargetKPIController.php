<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AchKpi;
use App\Models\User;
use App\Models\kpi;
use App\Models\OmsetKlinik;
use App\Models\targetkpi;
use Illuminate\Support\Facades\Validator;

class TargetKPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Target KPI';
        $type = 'kpi';
        $target = AchKpi::all();
        $user = User::all();
        return view('template.backend.admin.target-kpi.index',compact('title','target','user','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Target KPI';
        $type = 'kpi';
        return view('template.backend.admin.target-kpi.create',compact('title','type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'daftar' => 'required',
            'poli' => 'required',
            'farmasi' => 'required',
            'kasir' => 'required',
            'care' => 'required',
            'bpjs' => 'required',
            'khitan' => 'required',
            'rawat' => 'required',
            'salin' => 'required',
            'lab' => 'required',
            'umum' => 'required',
            'visit' => 'required',
        ],[
            'name.required' => 'Nama Target Tidak Boleh Kosong',
            'daftar.required' => 'Daftar tidak boleh kosong',
            'poli.required' => 'Poli tidak boleh kosong',
            'farmasi.required' => 'Farmasi tidak boleh kosong',
            'kasir.required' => 'Kasir tidak boleh kosong',
            'care.required' => 'Home Care tidak boleh kosong',
            'bpjs.required' => 'BPJS tidak boleh kosong',
            'khitan.required' => 'Khitan tidak boleh kosong',
            'rawat.required' => 'Rawat Inap tidak boleh kosong',
            'salin.required' => 'Persalinan tidak boleh kosong',
            'lab.required' => 'Laboratorium tidak boleh kosong',
            'umum.required' => 'Umum tidak boleh kosong',
            'visit.required' => 'Visit Dokter tidak boleh kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        $newStartDate = $request->start_date;
        $newEndDate = $request->end_date;
        // Memeriksa apakah periode sudah digunakan sebelumnya
        $existingTarget = AchKpi::where(function ($query) use ($newStartDate, $newEndDate) {
            $query->where('start_date', '<=', $newEndDate)
                ->where('end_date', '>=', $newStartDate);
        })->first();
        if ($existingTarget) {
            return redirect()->back()->with('error', 'Periode tanggal dan tahun ini sudah digunakan sebelumnya.');
        }

        $target = new AchKpi;
        $target -> name = $request->name;
        $target -> start_date = $request->start_date;
        $target -> end_date = $request->end_date;
        $target -> daftar = $request->daftar;
        $target -> poli = $request->poli;
        $target -> farmasi = $request->farmasi;
        $target -> kasir = $request->kasir;
        $target -> care = $request->care;
        $target -> bpjs = $request->bpjs;
        $target -> khitan = $request->khitan;
        $target -> rawat = $request->rawat;
        $target -> salin = $request->salin;
        $target -> lab = $request->lab;
        $target -> umum = $request->visit;
        $target -> visit = $request->visit;
        $target -> tambah1 = null;
        $target -> tambah2 = null;
        $target -> tambah3 = null;
        $target -> tambah4 = null;
        $target -> tambah5 = null;
        $target -> save();
        // return $target;
        return redirect('/TargetKPI')->with('success','Data Target Berhasil Ditambahkan.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ach = AchKpi::find($id);
        // Periksa apakah data target sedang digunakan di tabel lain
        if (!$ach) {
            return redirect()->back()->with('error', 'Data Target tidak ditemukan.');
        }
        if (targetkpi::where('target_id', $ach->id)->exists()) {
            return redirect()->back()->with('error', 'Data Target tidak dapat dihapus karena sedang digunakan di Realisasi KPI.');
        }
        $ach->delete();
        return redirect()->back()->with('success', 'Data Target Berhasil Dihapus.');
    }

    public function indexOmset()
    {
        // $data = explode('-', '2023-10-02');
        // $bulan = $data[1]; 
        // $tahun = $data[0]; 
        // $jumlah = 0;

        // $poin = kpi::whereMonth('bulan', $bulan)
        // ->whereYear('bulan', $tahun)
        // ->select('total')
        // ->get();
        // foreach ($poin as $data) {
        //     $jumlah += $data->total;
        // }
        // return $jumlah;

        $title = 'Performance Klinik';
        $type = 'gaji';
        // $omset = OmsetKlinik::all();
        $bulan = date('m');
        $tahun = date('Y');
        $omset = OmsetKlinik::whereYear('bulan', $tahun)
        ->whereMonth('bulan', $bulan)
        ->orderBy('created_at', 'desc')
        ->get();
        return view ('template.backend.admin.omset.index',compact('title','omset','type'));
    }
    public function SearchOmset(Request $request)
    {
        $title = 'Performance Klinik';
        $type = 'gaji';
        $bulan = $request->input('bulan');
        $startDate = $bulan . '-01';
        $endDate = $bulan . '-31';
        $omset = OmsetKlinik::whereBetween('bulan', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
        return view ('template.backend.admin.omset.index',compact('title','omset','type'));
    }
    public function storeOmset(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bulan' => 'required',
            'omset' => 'required',
            // 'skor' => 'required',
            'index' => 'required',
        ],[
            'omset.required' => 'Omset Tidak Boleh Kosong',
            'index.required' => 'Index Presentase Tidak Boleh Kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        $omset = new OmsetKlinik;
        $omset ->bulan = $request->bulan;
        $omset ->omset = $request->omset;
        $omset ->index = $request->index;
        //mendapatkan skor keseluruhan
        $data = explode('-', $request->bulan);
        $bulan = $data[1]; 
        $tahun = $data[0]; 
        $jumlah = 0;

        $poin = kpi::whereMonth('bulan', $bulan)
                    ->whereYear('bulan', $tahun)
                    ->select('total')
                    ->get();
        foreach ($poin as $data) {
            $jumlah += $data->total;
        }
        $omset ->skor = $jumlah;
        $persen = ($request->omset * $request->index) / 100;
        $omset ->total_insentif = round($persen, 2);
        $index_rupiah = $persen / $jumlah;
        $omset -> index_rupiah = round($index_rupiah, 2);
        $omset -> save();
        return redirect()->back()->with('success','Omset Bulan ini Berhasil Ditambahkan');

    }

    public function hapusOmset($id)
    {
        $omset = OmsetKlinik::find($id);
        $omset -> delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus.');
    }
}
