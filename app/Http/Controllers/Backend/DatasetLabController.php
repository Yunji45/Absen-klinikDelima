<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DatasetLab;
use App\Models\KodeWilayah;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DatasetLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dataset lab';
        $type = 'layanan-dataset';
        $kode = KodeWilayah::all();   
        $bulan= date('m');
        $tahun= date('Y');    

        $data = DatasetLab::whereNotNull('tgl_kunjungan')
                            ->whereYear('tgl_kunjungan', $tahun)
                            ->whereMonth('tgl_kunjungan', $bulan)
                            ->get();
        if ($data->isEmpty()) {
            session()->flash('message', 'Tidak ada data untuk bulan dan tahun ini.');
            // return redirect()->route('dash.layanan')->with('error','Data Rajal Pada Bulan Ini tidak ada');
        }
        return view ('template.backend.admin.dataset.lab.index',compact('title','type','data','kode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'no_rm' => 'required',
            'jenis_kelamin' => 'required',
        ],[
            'name.required' => 'Nama pasien Tidak Boleh Kosong',
            'no_rm.required' => 'No RM Tidak Boleh Kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin Tidak Boleh Kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $lab = new DatasetLab;
        $lab ->name = $request->name;
        $lab ->jenis_kelamin = $request->jenis_kelamin;
        $lab ->tgl_kunjungan = $request->tgl_kunjungan;
        $lab ->no_rm = $request->no_rm;
        $lab ->poli = 'LABORATORIUM';
        $lab ->kode_wilayah = $request->kode_wilayah;
        // return $lab;
        $lab ->save();
        return redirect()->back()->with('success','Data Berhasil Disimpan.');
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
        $data = DatasetLab::find($id);
        $data -> delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus.');
    }

    public function Cari_Dataset_Lab(Request $request)
    {
        $title = 'Dataset Lab';
        $type = 'layanan-dataset';
        // $user = User::all();
        $bulan = $request->input('bulan');
        $kode = KodeWilayah::all();
        $data = DatasetLab::where('tgl_kunjungan', '>=', $bulan . '-01')
                        ->where('tgl_kunjungan', '<=', $bulan . '-31')
                        ->get();
                
        return view ('template.backend.admin.dataset.lab.index',compact('title','type','data','kode'));
    }

}
