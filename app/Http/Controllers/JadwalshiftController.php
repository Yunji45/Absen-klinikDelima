<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwal;
use App\Models\shift;
use App\Models\User;
use PDF;

class JadwalshiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Jadwal Shift';
        $data = jadwal::all();
        $user = User::all();
        // return $user;        
        return view ('backend.admin.jadwalshift.index',compact('title','data','user'));
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
        $request->validate([
            'user_id' => 'required',
            'bulan' => 'required',
            'masa_aktif' => 'required',
            'masa_akhir' => 'required',
        ]);

        $data = new jadwal;
        $data ->user_id= $request->user_id;
        $data ->bulan = $request->bulan;
        $data ->masa_aktif = $request->masa_aktif;
        $data ->masa_akhir = $request->masa_akhir;
        $data ->j1 = $request->j1;
        $data ->j2 = $request->j2;
        $data ->j3 = $request->j3;
        $data ->j4 = $request->j4;
        $data ->j5 = $request->j5;
        $data ->j6 = $request->j6;
        $data ->j7 = $request->j7;
        $data ->j8 = $request->j8;
        $data ->j9 = $request->j9;
        $data ->j10 = $request->j10;
        $data ->j11 = $request->j11;
        $data ->j12 = $request->j12;
        $data ->j13 = $request->j13;
        $data ->j14 = $request->j14;
        $data ->j15 = $request->j15;
        $data ->j16 = $request->j16;
        $data ->j17 = $request->j17;
        $data ->j18 = $request->j18;
        $data ->j19 = $request->j19;
        $data ->j20 = $request->j20;
        $data ->j21 = $request->j21;
        $data ->j22 = $request->j22;
        $data ->j23 = $request->j23;
        $data ->j24 = $request->j24;
        $data ->j25 = $request->j25;
        $data ->j26 = $request->j26;
        $data ->j27 = $request->j27;
        $data ->j28 = $request->j28;
        $data ->j29 = $request->j29;
        $data ->j30 = $request->j30;
        $data ->j31 = $request->j31;
        $data ->save();
        // return $data;
        return redirect()->back()->with('success','Data Jadwal User Tersebut Berhasil Di tambahkan');
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
        $data= jadwal::find($id);
        $data->delete();
        if($data){
            return redirect()->back()->with('success','Data Jadwal User Berhasil Di Hapus Dari Database');
        }else{
            return redirect()->back()->with('erorr','Data Jadwal User Gagal Di Hapus Dari Database');
        }
    }

    public function jadwaldownload()
    {
        $data = jadwal::all();
        $pdf = PDF::loadview('backend.admin.jadwalshift.downloadjadwal',['data'=>$data]);
        return $pdf->download('Jadwal-Shift');            
    }

}
