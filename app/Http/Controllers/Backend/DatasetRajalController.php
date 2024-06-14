<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\DatasetRajalImport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\DatasetRajal;
use App\Models\KodeWilayah;

use Maatwebsite\Excel\Facades\Excel;

class DatasetRajalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dataset Rajal';
        $type = 'layanan-dataset';
        $bulan= date('m');
        $tahun= date('Y');    

        $data = DatasetRajal::whereNotNull('tgl_kunjungan')
                            ->whereYear('tgl_kunjungan', $tahun)
                            ->whereMonth('tgl_kunjungan', $bulan)
                            ->get();
        if ($data->isEmpty()) {
            session()->flash('message', 'Tidak ada data untuk bulan dan tahun ini.');
            // return redirect()->route('dash.layanan')->with('error','Data Rajal Pada Bulan Ini tidak ada');
        }
        $kode = KodeWilayah::all();
        return view ('template.backend.admin.dataset.rajal.index',compact('title','type','data','kode'));
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
        
        $ranap = new DatasetRajal;
        $ranap ->name = $request->name;
        $ranap ->jenis_kelamin = $request->jenis_kelamin;
        $ranap ->tgl_kunjungan = $request->tgl_kunjungan;
        $ranap ->no_rm = $request->no_rm;
        $ranap ->poli = $request->poli;
        $ranap ->kode_wilayah = $request->kode_wilayah;
        // return $ranap;
        $ranap ->save();
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
        $data = DatasetRajal::find($id);
        $data->delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus.');
    }

    public function Cari_Dataset_Rajal(Request $request)
    {
        $title = 'Dataset Rajal';
        $type = 'layanan-dataset';
        // $user = User::all();
        $kode = KodeWilayah::all();
        $bulan = $request->input('bulan');
        $data = DatasetRajal::where('tgl_kunjungan', '>=', $bulan . '-01')
                        ->where('tgl_kunjungan', '<=', $bulan . '-31')
                        ->get();
                
        return view ('template.backend.admin.dataset.rajal.index',compact('title','type','data','kode'));
    }

    public function ImportDatasetRajal(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = $file->hashName();
        $path = $file->storeAs('public/dataset-rajal/',$nama_file);
        // import data
        $import = Excel::import(new DatasetRajalImport(), storage_path('app/public/dataset-rajal/'.$nama_file));
        //remove from server
        Storage::delete($path);
        if($import) {
            //redirect
            return redirect()->route('dataset.rajal')->with('success', 'Data Berhasil Diimport!');
        } else {
            //redirect
            return redirect()->route('dataset.rajal')->with('error', 'Data Gagal Diimport!');
        }
    }

}
