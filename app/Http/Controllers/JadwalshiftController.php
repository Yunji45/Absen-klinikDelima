<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwal;
use App\Models\jadwalterbaru;
use App\Models\rubahjadwal;
use App\Models\shift;
use App\Models\User;
use PDF;
use Auth;

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
        // $data = jadwal::all();
        $type = 'jadwal';
        $user = User::all();
        $bulan = date('m');
        $tahun = date('Y');
    
        // Filter jadwal berdasarkan bulan dan tahun pada atribut 'masa_aktif'
        $data = jadwalterbaru::whereYear('masa_aktif', $tahun)
                    ->whereMonth('masa_aktif', $bulan)
                    ->get();    

                    $permohonan = rubahjadwal::whereIn('status', ['pengajuan','approve'])
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

                    $backgroundClass = '';

                    foreach ($permohonan as $item) {
                        if ($item->status === 'approve') {
                            if ($item->permohonan == 'ganti_jaga') {
                                $backgroundClass = 'bg-merah';
                            } elseif ($item->permohonan == 'tukar_jaga') {
                                $backgroundClass = 'bg-hijau';
                            }
                            // Jika status adalah 'approve', maka $backgroundClass akan diubah sesuai permohonan.
                            // Jika status bukan 'approve', maka $backgroundClass akan tetap seperti variabel default.
                        }
                    }
        // return $user;        
        return view ('template.backend.admin.jadwal.index',compact('title','data','user','bulan','tahun','backgroundClass','permohonan','type'));
    }

    public function indexUser()
    {
        $title = 'Jadwal Shift';
        $bulan = date('m');
        $tahun = date('Y');
        $data = jadwalterbaru::whereYear('masa_aktif', $tahun)
                    ->whereMonth('masa_aktif', $bulan)
                    ->get();    
        return view ('frontend.users.jadwal.index',compact('title','data','tahun','bulan'));
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

        $data = new jadwalterbaru;
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
        $title = 'Edit Jadwal Shift';
        $jadwal = jadwalterbaru::find($id);
        $user = User::all();
        $bulan = date('m');
        $tahun = date('Y');
    
        // Filter jadwal berdasarkan bulan dan tahun pada atribut 'masa_aktif'
        $data = jadwalterbaru::whereYear('masa_aktif', $tahun)
                            ->whereMonth('masa_aktif', $bulan)
                            ->get();    
        // return $user;
        return view ('backend.admin.jadwalshift.edit',compact('title','user','data','bulan','tahun','jadwal'));
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
        $request->validate([
            'user_id' => 'required',
            'bulan' => 'required',
            'masa_aktif' => 'required',
            'masa_akhir' => 'required',
        ]);

        $data = jadwalterbaru::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Jadwal Terbaru tidak ditemukan');
        }
        $data->user_id = $request->input('user_id');
        $data->bulan = $request->input('bulan');
        $data->masa_aktif = $request->input('masa_aktif');
        $data->masa_akhir = $request->input('masa_akhir');
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
        $data->save();
        if($data){
            return redirect()->route('jadwal.shift')->with('success','Terimakasih Telah Update Jadwal Terbaru');
        }else{
            return redirect()->back()->with('error','Update Jadwal Terbaru Gagal');
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
        $data= jadwalterbaru::find($id);
        $data->delete();
        if($data){
            return redirect()->back()->with('success','Data Jadwal User Berhasil Di Hapus Dari Database');
        }else{
            return redirect()->back()->with('erorr','Data Jadwal User Gagal Di Hapus Dari Database');
        }
    }

    public function jadwaldownload()
    {
        $bulan = date('m');
        $tahun = date('Y');
        $data = jadwalterbaru::whereYear('masa_aktif', $tahun)
                        ->whereMonth('masa_aktif', $bulan)
                        ->get();
        // $data = jadwal::all();
        $pdf = PDF::loadview('backend.admin.jadwalshift.downloadjadwal',['data'=>$data]);
        return $pdf->download('Jadwal-Shift');            
    }

    public function cari(Request $request)
    {
        $title = 'Jadwal Shift';
        $type= 'jadwal';
        $user = User::all();
        $bulan = $request->input('bulan');
        $data = jadwalterbaru::where('masa_aktif', '>=', $bulan . '-01')
                        ->where('masa_akhir', '<=', $bulan . '-31')
                        ->get();
                
        return view ('template.backend.admin.jadwal.index',compact('data','title','user','type'));
    }

    public function cariJadwal(Request $request)
    {
        $title = 'Jadwal Shift';
        $bulan = $request->input('bulan');
        $data = jadwalterbaru::where('masa_aktif', '>=', $bulan . '-01')
                        ->where('masa_akhir', '<=', $bulan . '-31')
                        ->get();   
        return view ('frontend.users.jadwal.index',compact('title','data','bulan'));
    }
}
