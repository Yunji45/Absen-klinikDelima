<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OprJasaMedis;
use App\Models\JasaMedis;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class OprJasaMedisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Tugas Jasa Medis';
        $type = 'jasamedis';
        $opr = OprJasaMedis::all();
        $users = User::all();
        $jasa = JasaMedis::all();
        
        // return $jasaMedis;
        return view ('template.backend.admin.jasamedis.opr.index',compact('title','type','opr','users'));
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
            'nama_pasien' => 'required',
            'No_RM' => 'required',

        ],[
            'nama_pasien.required' => 'Nama Pasien Tidak Boleh Kosong',
            'No_RM.required' => 'No Rekam Medis Tidak Boleh Kosong',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $opr = new OprJasaMedis;
        $opr -> bulan = $request->bulan;
        $opr -> No_RM = $request->No_RM;
        $opr -> nama_pasien = $request->nama_pasien;
        $opr -> jenis_layanan = $request->jenis_layanan;
        $opr -> jenis_jasa = $request->jenis_jasa;
        $opr -> tarif_jasa = $request->tarif_jasa;
        $opr -> user_id = $request->user_id;
        $opr -> ceklis_tindakan = 'Tidak';
        // return $opr;
        $opr -> save();
        return redirect()->back()->with('success','Data Berhasil Disimpan');
        
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
        $title = 'Edit Tugas Jasa Medis';
        $type = 'jasamedis';
        $opr = OprJasaMedis::find($id);
        $users = User::all();
        return view ('template.backend.admin.jasamedis.opr.edit',compact('title','type','opr','users'));
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
        $opr =OprJasaMedis::find($id);
        $opr -> bulan = $request->bulan;
        $opr -> No_RM = $request->No_RM;
        $opr -> nama_pasien = $request->nama_pasien;
        $opr -> jenis_layanan = $request->jenis_layanan;
        $opr -> jenis_jasa = $request->jenis_jasa;
        $opr -> tarif_jasa = $request->tarif_jasa;
        $opr -> user_id = $request->user_id;
        $opr -> ceklis_tindakan = 'Tidak';
        // return $opr;
        $opr -> save();
        return redirect('/opr-medis')->with('success','Terimakasih !! Data Berhasil Diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $opr = OprJasaMedis::find($id);
        $opr -> delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus');

    }

    public function CeklisTindakanMedis(Request $request,$id)
    {
        $opr = OprJasaMedis::find($id);
        if($opr->ceklis_tindakan == 'Tidak'){
            $opr->update(['ceklis_tindakan' => 'Ya']);
            return redirect()->back()->with('success','Tindakan Medis Dikonfirmasi');
        }else{
            return redirect()->back()->with('error','Tindakan Medis Gagal Untuk Dikonfirmasi.');
        }
    }
}
