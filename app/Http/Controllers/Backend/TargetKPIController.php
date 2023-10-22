<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AchKpi;
use App\Models\User;
use App\Models\OmsetKlinik;
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
        $target = AchKpi::all();
        $user = User::all();
        return view('template.backend.admin.target-kpi.index',compact('title','target','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Target KPI';
        return view('template.backend.admin.target-kpi.create',compact('title'));
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
        $ach -> delete();
        if($ach){
            return redirect()->back()->with('success','Data Target Berhasil Dihapus.');
        }else{
            return redirect()->back()->with('error','Data Target Gagal dihapus.');
        }
    }

    public function setItemTarget()
    {

    }

    public function indexOmset()
    {
        $title = 'Performance Klinik';
        $omset = OmsetKlinik::all();
        return view ('template.backend.admin.omset.index',compact('title','omset'));
    }

    public function storeOmset(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bulan' => 'required',
            'omset' => 'required',
            'skor' => 'required',
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
        $omset ->skor = $request->skor;
        $persen = ($request->omset * $request->index) / 100;
        $omset ->total_insentif = round($persen, 2);
        $index_rupiah = $persen / $request->skor;
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
