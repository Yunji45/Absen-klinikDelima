<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DatasetRanap;

use App\Imports\DatasetRanapImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DatasetRawatInapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dataset Ranap';
        $type = 'layanan-dataset';
        $data = DatasetRanap::all();
        return view ('template.backend.admin.dataset.ranap.index',compact('title','type','data'));
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
        
        $ranap = new DatasetRanap;
        $ranap ->name = $request->name;
        $ranap ->jenis_kelamin = $request->jenis_kelamin;
        $ranap ->tgl_kunjungan = $request->tgl_kunjungan;
        $ranap ->no_rm = $request->no_rm;
        $ranap ->poli = 'RAWAT INAP';
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
        //
    }

    public function ImportDatasetRanap(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = $file->hashName();
        $path = $file->storeAs('public/dataset-khitan/',$nama_file);
        // import data
        $import = Excel::import(new DatasetRanapImport(), storage_path('app/public/dataset-khitan/'.$nama_file));
        //remove from server
        Storage::delete($path);
        if($import) {
            //redirect
            return redirect()->route('dataset.khitan')->with('success', 'Data Berhasil Diimport!');
        } else {
            //redirect
            return redirect()->route('dataset.khitan')->with('error', 'Data Gagal Diimport!');
        }
    }
}
