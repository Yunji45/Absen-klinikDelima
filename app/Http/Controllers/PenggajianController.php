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
        $title = 'Payroll';
        $bulan = date('m');
        $tahun = date('Y');
        $type = 'gaji';
        // $gaji = gajian::all();
        $gaji = gajian::whereYear('bulan', $tahun)
        ->whereMonth('bulan', $bulan)
        ->orderBy('created_at', 'desc')
        ->get();    
        $data = User::all();
        $umr = UMKaryawan::all();
        return view('template.backend.admin.gaji.index',compact('title','gaji','data','umr','tahun','bulan','type'));
    }

    public function SearchPayroll(Request $request)
    {
        $title = 'Payroll';
        $data = User::all();
        $type = 'gaji';
        $umr = UMKaryawan::all();
        $bulan = $request->input('bulan');
        $startDate = $bulan . '-01';
        $endDate = $bulan . '-31';
    
        $gaji = gajian::whereBetween('bulan', [$startDate, $endDate])->orderBy('created_at', 'desc')->get();
        return view('template.backend.admin.gaji.index',compact('title','gaji','data','umr','bulan','type'));

    }

    public function cari(Request $request)
    {
        $title = 'Penggajian';
        $tahun = substr($request->bulan, 0, 4); // Ambil tahun dari input bulan
        $bulanInput = substr($request->bulan, 5, 2); // Ambil bulan dari input bulan    
        $data = User::all();
        $umr = UMKaryawan::all();
        // $bulan = $request->input('bulan');
        // $gaji = gajian::where('bulan', '>=', $bulan . '-01')
        //                 ->get();
                
        // return view ('backend.admin.gaji.index',compact('gaji','title','data','umr'));
        if (preg_match('/^(0[1-9]|1[0-2])$/', $bulanInput)) {
            $gaji = gajian::whereYear('bulan', $tahun)
                ->whereMonth('bulan', $bulanInput)
                ->get();
            return view('backend.admin.gaji.index', compact('gaji', 'title', 'tahun', 'bulanInput','data','umr'));
        } else {
            // Format bulan tidak sesuai, mungkin Anda ingin menangani ini sesuai kebutuhan Anda.
            return redirect()->back()->with('error', 'Format bulan tidak valid.');
        }
    
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Payroll';
        $type = 'gaji';
        $data = User::all();
        $umr = UMKaryawan::all();
        return view ('template.backend.admin.gaji.create',compact('data','umr','title','type'));
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
            'Masa_kerja' => 'required',
            'Potongan' => 'numeric',
            'index' => 'required'
        ]);
        $bulanYangDicari = $request->bulan; 
        $tahun = date('Y'); 
        $tanggalBulan = $tahun . '-' . $bulanYangDicari . '-01';

        $gaji = new gajian;
        $gaji->user_id = $request->user_id;
        $gaji->bulan = $tanggalBulan;
        $gaji->pendidikan = $request->pendidikan;
        $gaji->index = $request->index;
        // if ($request->pendidikan == 'Dokter'){
        //     $gaji->index = 300;
        // }elseif ($request->pendidikan == 'S1 Profesi'){
        //     $gaji->index = 180;
        // }elseif($request->pendidikan == 'S1 Kesehatan Non Profesi'){
        //     $gaji->index = 170;
        // }elseif($request->pendidikan == 'S1 Non Kesehatan'){
        //     $gaji->index = 150;
        // }elseif($request->pendidikan == 'D3 Kesehatan'){
        //     $gaji->index = 140;
        // }elseif($request->pendidikan == 'D3 Non Kesehatan'){
        //     $gaji->index = 130;
        // }elseif($request->pendidikan == 'SMK Kesehatan'){
        //     $gaji->index= 110;
        // }elseif($request->pendidikan == 'SLTA Non Kesehatan'){
        //     $gaji->index = 100;
        // }elseif($request->pendidikan == 'Dibawah SLTA'){
        //     $gaji->index = 90;
        // }else{
        //     $gaji->index =null;
        // }

        $gaji->umr_id = $request->umr_id;
        // Mengambil nilai UMK berdasarkan umr_id
        $umr_id = $request->umr_id;
        $umk = UMKaryawan::where('id', $umr_id)->value('UMK');
        // Perhitungan THP
        $thp = ($umk * $request->index) / 100;
        $gaji->THP =$thp;
        
        // Perhitungan Gaji 80 %
        $gaji_80 = ($thp * 80) / 100;
        $gaji->Gaji = $gaji_80;
        
        // Perhitungan Insentif 20%
        $insentif = ($thp * 20) / 100;
        $gaji->Ach = $insentif;
        $gaji->Masa_kerja = $request->Masa_kerja;
        
        if ($request->Masa_kerja == 1) {
            $total_potongan_bonus = $request->Potongan - $request->Bonus;
            $gaji->Gaji_akhir = $gaji_80 - $total_potongan_bonus;
        } elseif ($request->Masa_kerja == 0) {
            $masa = $gaji_80 * 0.8;
            $total_potongan_bonus = $request->Potongan - $request->Bonus;
            $gaji->Gaji_akhir = $masa - $total_potongan_bonus;
        } else {
            $gaji->Gaji_akhir = null;
        }        
        $gaji->Potongan = $request->Potongan;
        $gaji->Bonus = $request->Bonus;
        
        $gaji->save();
        // return $gaji;
        if($gaji){
            return redirect('/index-persentase')->with('success','Data Berhasil Di Simpan.');
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
        $title = 'Edit Payroll';
        $type = 'gaji';
        $data = User::all();
        $umr = UMKaryawan::all();
        $gaji = gajian::find($id);
        return view('template.backend.admin.gaji.edit',compact('title','data','umr','gaji'))->with('success','Data Berhasil di Temukan');
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
        $bulanYangDicari = $request->bulan; 
        $tahun = date('Y'); 
        $tanggalBulan = $tahun . '-' . $bulanYangDicari . '-01';

        $gaji = gajian::find($id);
        $gaji->user_id = $request->user_id;
        $gaji->bulan = $tanggalBulan;
        $gaji->pendidikan = $request->pendidikan;
        $gaji->index = $request->index;
        // if ($request->pendidikan == 'Dokter'){
        //     $gaji->index = 300;
        // }elseif ($request->pendidikan == 'S1 Profesi'){
        //     $gaji->index = 180;
        // }elseif($request->pendidikan == 'S1 Kesehatan Non Profesi'){
        //     $gaji->index = 170;
        // }elseif($request->pendidikan == 'S1 Non Kesehatan'){
        //     $gaji->index = 150;
        // }elseif($request->pendidikan == 'D3 Kesehatan'){
        //     $gaji->index = 140;
        // }elseif($request->pendidikan == 'D3 Non Kesehatan'){
        //     $gaji->index = 130;
        // }elseif($request->pendidikan == 'SMK Kesehatan'){
        //     $gaji->index= 110;
        // }elseif($request->pendidikan == 'SLTA Non Kesehatan'){
        //     $gaji->index = 100;
        // }elseif($request->pendidikan == 'Dibawah SLTA'){
        //     $gaji->index = 90;
        // }else{
        //     $gaji->index =null;
        // }

        $gaji->umr_id = $request->umr_id;
        // $gaji->index = $request->index;
        // Mengambil nilai UMK berdasarkan umr_id
        $umr_id = $request->umr_id;
        $umk = UMKaryawan::where('id', $umr_id)->value('UMK');
        // Perhitungan THP
        $thp = ($umk * $request->index) / 100;
        $gaji->THP =$thp;
        
        // Perhitungan Gaji 80 %
        $gaji_80 = ($thp * 80) / 100;
        $gaji->Gaji = $gaji_80;
        
        // Perhitungan Insentif 20%
        $insentif = ($thp * 20) / 100;
        $gaji->Ach = $insentif;
        $gaji->Masa_kerja = $request->Masa_kerja;
        
        // Perhitungan Gaji Akhir
        // if ($request->Masa_kerja == 1) {
        //     $gaji->Gaji_akhir = $gaji_80 - $request->Potongan;
        // } elseif ($request->Masa_kerja == 0) {
        //     $masa = $gaji_80 * 0.8;
        //     $gaji->Gaji_akhir = $masa - $request->Potongan;
        // } else {
        //     $gaji->Gaji_akhir = null;
        // }
        if ($request->Masa_kerja == 1) {
            $total_potongan_bonus = $request->Potongan - $request->Bonus;
            $gaji->Gaji_akhir = $gaji_80 - $total_potongan_bonus;
        } elseif ($request->Masa_kerja == 0) {
            $masa = $gaji_80 * 0.8;
            $total_potongan_bonus = $request->Potongan - $request->Bonus;
            $gaji->Gaji_akhir = $masa - $total_potongan_bonus;
        } else {
            $gaji->Gaji_akhir = null;
        }        
        $gaji->Potongan = $request->Potongan;
        $gaji->Bonus = $request->Bonus;
        
        $gaji->save();
        // return $gaji;
        if($gaji){
            return redirect('/index-persentase')->with('success','Data Berhasil Di Update.');
        }else{
            return redirect()->back()->with('error','Data Gagal Untuk Di Simpan.');
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
        $type = 'gaji';
        $data = UMKaryawan::all();
        return view ('template.backend.admin.gaji.umr',compact('title','data','type'));
    }

    public function createUMR()
    {
        $title = 'Setting UMR';
        return view('template.backend.admin.gaji.create-umr',compact('title'));
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
            return redirect('/index-UMR')->with('success','Data Berhasil Disimpan.');
        }else{
            return redirect()->back()->with('error', 'Input UMR hanya dengan Angka, Tidak Dengan Karakter');
        }
    }

    public function hapusUMR($id)
    {
        $data = UMKaryawan::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
        $data->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus.');
    }
    
}
