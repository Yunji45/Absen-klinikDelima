<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DatasetEstetika;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DatasetEstetikaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dataset Estetika';
        $type = 'layanan-dataset';
        $data = DatasetEstetika::all();
        return view ('template.backend.admin.dataset.estetika.index',compact('title','type','data'));
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

        $estetika = new DatasetEstetika;
        $estetika ->name = $request->name;
        $estetika ->jenis_kelamin = $request->jenis_kelamin;
        $estetika ->tgl_kunjungan = $request->tgl_kunjungan;
        $estetika ->no_rm = $request->no_rm;
        $estetika ->poli = 'ESTETIKA';
        // return $estetika;
        $estetika ->save();
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
        $data = DatasetEstetika::find($id);
        $data -> delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus.');
    }
}
