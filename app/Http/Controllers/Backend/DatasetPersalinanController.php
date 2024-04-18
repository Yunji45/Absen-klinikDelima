<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DatasetPersalinan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon;

class DatasetPersalinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dataset Persalinan';
        $type = 'layanan-dataset';
        $data = DatasetPersalinan::all();
        return view ('template.backend.admin.dataset.persalinan.index',compact('title','type','data'));
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

        $persalinan = new DatasetPersalinan;
        $persalinan ->name = $request->name;
        $persalinan ->jenis_kelamin = $request->jenis_kelamin;
        $persalinan ->tgl_kunjungan = $request->tgl_kunjungan;
        $persalinan ->no_rm = $request->no_rm;
        $persalinan ->poli = 'PERSALINAN';
        // return $persalinan;
        $persalinan ->save();
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
        $data = DatasetPersalinan::find($id);
        $data -> delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus.');
    }
}
