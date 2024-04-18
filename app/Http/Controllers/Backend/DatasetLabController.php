<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DatasetLab;
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
        $data = Datasetlab::all();
        return view ('template.backend.admin.dataset.lab.index',compact('title','type','data'));
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
}
