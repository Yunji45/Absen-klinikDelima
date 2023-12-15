<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OprJasaMedis;
use App\Models\JasaMedis;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class JasaMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Tarif Dasar Jasa Medis';
        $type = 'jasamedis';
        $jasa = JasaMedis::all();
        // return $type;
        return view('template.backend.admin.jasamedis.target.index',compact('title','type','jasa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'nama_standar_opr' => 'required',
            'jenis_layanan' => 'required',
            'jenis_jasa' => 'required',
            'tarif_jasa' => 'required',

        ],[
            'nama_standar_opr.required' => 'Nama Tidak Boleh Kosong',
            'jenis_layanan.required' => 'Jenis Layanan Tidak Boleh Kosong',
            'jenis_jasa.required' => 'Jenis Jasa Tidak Boleh Kosong',
            'tarif_jasa.required' => 'Tarif Jasa Tidak Boleh Kosong',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $jasa = new JasaMedis;
        $jasa -> nama_standar_opr = $request->nama_standar_opr;
        $jasa -> start_date = $request->start_date;
        $jasa -> end_date = $request->end_date;
        $jasa -> jenis_layanan = $request->jenis_layanan;
        $jasa -> jenis_jasa = $request->jenis_jasa;
        $jasa -> tarif_jasa = $request->tarif_jasa;

        $jasa -> save();
        if($jasa){
            return redirect()->back()->with('success','Jenis Jasa Berhasil Ditambahkan.');
        }else{
            return redirect()->back()->with('error','Jenis Jasa Gagal Ditambahkan.');
        }

        // return $jasa;
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
        $title = 'Tarif Dasar Jasa Medis';
        $type = 'jasamedis';
        $jasa = JasaMedis::find($id);
        return view('template.backend.admin.jasamedis.target.edit',compact('title','type','jasa'));
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
        $jasa = JasaMedis::find($id);
        $jasa -> nama_standar_opr = $request->nama_standar_opr;
        $jasa -> start_date = $request->start_date;
        $jasa -> end_date = $request->end_date;
        $jasa -> jenis_layanan = $request->jenis_layanan;
        $jasa -> jenis_jasa = $request->jenis_jasa;
        $jasa -> tarif_jasa = $request->tarif_jasa;
        // return $jasa;
        $jasa -> save();
        if($jasa){
            return redirect('/Jasa-Medis')->with('success','Data Tarif Jasa Medis Berhasil Diupdate.');
        }else{
            return redirect()->back()->with('error','Data Tarif Gagal Diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jasa = JasaMedis::find($id);
        $jasa -> delete();
        return redirect()->back()->with('success','Data Tarif Jasa Medis Berhasil Dihapus.');
    }
}
