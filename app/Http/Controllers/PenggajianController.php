<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gajian;
use App\Models\User;
use App\Models\UMKaryawan;
use Auth;
use PDF;


class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Penggajian';
        $gaji = gajian::all();
        $data = User::all();
        $umr = UMKaryawan::all();
        return view('backend.admin.gaji.index',compact('title','gaji','data','umr'));
        // $data = 2021657;
        // $persen = '180';
        // $perkalian = (($data * $persen) / 100);
        // $del = ($perkalian * 80 ) / 100;
        // $hasil_bulat = round($del);
        // $hasil_rupiah = "Rp " . number_format($hasil_bulat, 0, ',', '.');
        // return $hasil_rupiah;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data = User::all();
        // $umr = UMKaryawan::all();
        // return view ('backend.admin.gaji.create',compact('data','umr'));
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
            'pendidikan' => 'required',
            'umr_id' => 'required',
            'index' => 'required',
            'Masa_kerja' => 'required',
        ]);
        $bulanYangDicari = $request->bulan; 
        $tahun = date('Y'); 
        $tanggalBulan = $tahun . '-' . $bulanYangDicari . '-01';

        $gaji = new gajian;
        $gaji->user_id = $request->user_id;
        $gaji->bulan = $tanggalBulan;
        $gaji->pendidikan = $request->pendidikan;
        $gaji->umr_id = $request->umr_id;
        $gaji->index = $request->index;
        // Mengambil nilai UMK berdasarkan umr_id
        $umr_id = $request->umr_id;
        $umk = UMKaryawan::where('id', $umr_id)->value('UMK');
        // Perhitungan THP
        $thp = ($umk * $request->index) / 100;
        $hasil_thp = round($thp);
        $hasil_rupiah_thp = "Rp." . number_format($hasil_thp, 0, ',', '.');
        $gaji->THP = $hasil_rupiah_thp;
        
        // Perhitungan Gaji 80 %
        $gaji_80 = ($thp * 80) / 100;
        $hasil_Gaji = round($gaji_80);
        $hasil_rupiah_Gaji = "Rp." . number_format($hasil_Gaji, 0, ',', '.');
        $gaji->Gaji = $hasil_rupiah_Gaji;
        
        // Perhitungan Insentif 20%
        $insentif = ($thp * 20) / 100;
        $hasil_insentif = round($insentif);
        $hasil_rupiah_insentif = "Rp." . number_format($hasil_insentif, 0, ',', '.');
        $gaji->Ach = $hasil_rupiah_insentif;
        
        $gaji->Bonus = null;
        $gaji->Masa_kerja = $request->Masa_kerja;
        
        // Perhitungan Gaji Akhir
        if ($request->Masa_kerja == 1) {
            $gaji->Gaji_akhir = $hasil_rupiah_Gaji;
        } elseif ($request->Masa_kerja == 0) {
            $masa = $gaji_80 * 0.8;
            $hasil_masa = round($masa);
            $hasil_rupiah_masa = "Rp." . number_format($hasil_masa, 0, ',', '.');
            $gaji->Gaji_akhir = $hasil_rupiah_masa;
        } else {
            $gaji->Gaji_akhir = null;
        }
        
        $gaji->Potongan = null;
        
        $gaji->save();
        // return $gaji;
        if($gaji){
            return redirect()->back()->with('success','Data Berhasil Di Simpan.');
        }else{
            return redirect()->back()->with('error','Data Gagal Untuk Di Simpan.');
        }
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
        $data = gajian::find($id);
        $data ->delete();
        if($data){
            return redirect()->back()->with('success','Data Berhasil Di Hapus.');
        }else{
            return redirect()->back()->with('error','Data Gagal Untuk Di Hapus.');
        }
    }

    public function indexUMR()
    {
        $title = 'Setting UMR';
        $data = UMKaryawan::all();
        return view ('backend.admin.gaji.umr-index',compact('title','data'));
    }

    public function saveUMR(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'UMK' => 'numeric',
        ]);

        $umr = new UMKaryawan;
        $umr -> name = $request->name;
        $umr -> UMK = $request->UMK;
        $data = $request->UMK;
        $hasil_data = round($data);
        $hasil_rupiah_data = "Rp." . number_format($hasil_data, 0, ',', '.');
        $umr->Rp = $hasil_rupiah_data;
        $umr ->save();
        // return $umr;
        if($umr){
            return redirect()->back()->with('success','Data Berhasil Disimpan.');
        }else{
            return redirect()->back()->with('error', 'Input UMR hanya dengan Angka, Tidak Dengan Karakter');
        }
    }

    public function hapusUMR($id)
    {
        $data = UMKarwayan::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        $data->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus.');
    }
    
}
