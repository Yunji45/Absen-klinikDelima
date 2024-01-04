<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DaftarPasien;
use App\Models\KategoriJasaMedis;
use App\Models\OperasionalJasa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Auth;

class DaftarTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Jadwal Tugas Layanan';
        $type = 'jasamedis';
        $users = User::whereIn('role',['evaluator','pegawai','keuangan','hrd'])->get();
        $pasien = DaftarPasien::orderBy('created_at','desc')->get();
        // $pasien = DaftarPasien::all();
        $kategori = KategoriJasaMedis::all();
        $tugas = OperasionalJasa::where('ceklis','Tidak')->orderBy('created_at','desc')->get();
        // $tugas = OperasionalJasa::all();
        return view ('template.backend.admin.jasamedis.daftar-tugas.index',compact('title','type','pasien','users','tugas','kategori'));
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
            'user_id' => 'required',
            'layanan_id' => 'required',
            'pasien_id' => 'required',

        ],[
            'user_id.required' => 'Nama Petugas Tidak Boleh Kosong',
            'layanan_id.required' => 'Jenis Layanan Tidak Boleh Kosong',
            'pasien_id.required' => 'Pasien Tidak Boleh Kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        $tugas = new OperasionalJasa;
        $tugas -> bulan =$request->bulan;
        $tugas -> user_id = $request->user_id;
        $tugas -> pasien_id = $request->pasien_id;
        $tugas -> layanan_id = $request->layanan_id;
        //mengambil nilai request layanan
        $layanan = KategoriJasaMedis::find($request->layanan_id);
        $tugas->tarif_jasa = $layanan->tarif_jasa;
        $tugas->ceklis = 'Tidak';
        // return $tugas;
        $tugas -> save();
        return redirect()->back()->with('success','Daftar Tugas Layanan Berhasil Disimpan.');
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
        $title = 'Jadwal Tugas Layanan';
        $type = 'jasamedis';
        $users = User::all();
        $pasien = DaftarPasien::all();
        $kategori = KategoriJasaMedis::all();
        $tugas = OperasionalJasa::find($id);
        return view ('template.backend.admin.jasamedis.daftar-tugas.edit',compact('title','type','pasien','users','tugas','kategori'));
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
        $tugas = OperasionalJasa::find($id);
        $tugas -> bulan =$request->bulan;
        $tugas -> user_id = $request->user_id;
        $tugas -> pasien_id = $request->pasien_id;
        $tugas -> layanan_id = $request->layanan_id;
        //mengambil nilai request layanan
        $layanan = KategoriJasaMedis::find($request->layanan_id);
        $tugas->tarif_jasa = $layanan->tarif_jasa;
        $tugas->ceklis = 'Tidak';
        // return $tugas;
        $tugas -> save();
        return redirect()->route('daftar.tugas')->with('success','Daftar Tugas Layanan Berhasil Diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tugas = OperasionalJasa::find($id);
        $tugas -> delete();
        return redirect()->back()->with('success','Daftar Tugas Layanan Berhasil Dihapus.');
    }

    public function CeklisJasaMedis(Request $request,$id)
    {
        $tugas = OperasionalJasa::find($id);
        if($tugas->ceklis == 'Tidak'){
            $tugas->update(['ceklis' => 'Ya']);
            return redirect()->back()->with('success','Tindakan Medis Dikonfirmasi');
        }else{
            return redirect()->back()->with('error','Tindakan Medis Gagal Untuk Dikonfirmasi.');
        }
    }

    public function RiwayatTugas()
    {
        $title = 'Riwayat Tugas Layanan';
        $type = 'jasamedis';
        $tugas = OperasionalJasa::where('ceklis','Ya')->orderBy('updated_at','desc')->get();
        $uniqueUserIds = OperasionalJasa::where('ceklis', 'Ya')->pluck('user_id')->unique();
        $history = [];
        foreach ($uniqueUserIds as $userId) {
            $userHistory = OperasionalJasa::where('user_id', $userId)
                ->where('ceklis', 'Ya')
                ->select('user_id','bulan')
                ->first();

            if ($userHistory) {
                $history[] = $userHistory;
            }
        }
        // return $history;
        return view ('template.backend.admin.jasamedis.daftar-tugas.riwayat',compact('title','type','tugas','history'));
    }

    public function Delete($user_id)
    {
        $tugas = OperasionalJasa::where('user_id', $user_id)->first();
        if($tugas){
            $tugas ->delete();
            return redirect()->back()->with('success','Data Riwayat Berhasil Dihapus.');
        }else{
            return redirect()->back()->with('error','Data Riwayat Gagal Dihapus.');
        }
    }

    public function DetailRiwayatTugas(Request $request,User $user_id)
    {
        $title = 'Detail Riwayat Tugas Layanan';
        $type = 'jasamedis';
        $now = Carbon::now(); 
        $bulanBerjalan = $now->format('m'); 
        $tahunBerjalan = $now->format('Y'); 
        $history = OperasionalJasa::whereUserId($user_id->id)
                                    ->where('ceklis', 'Ya')
                                    ->whereYear('bulan', $tahunBerjalan)
                                    ->whereMonth('bulan', $bulanBerjalan)                                
                                    ->orderBy('updated_at')
                                    ->get();
        $pending = OperasionalJasa::whereUserId($user_id->id)
                                    ->where('ceklis','Tidak')
                                    ->whereYear('bulan', $tahunBerjalan)
                                    ->whereMonth('bulan', $bulanBerjalan)                                
                                    ->count();
        $complete = OperasionalJasa::whereUserId($user_id->id)
                                    ->where('ceklis','Ya')
                                    ->whereYear('bulan', $tahunBerjalan)
                                    ->whereMonth('bulan', $bulanBerjalan)                                
                                    ->count();
        $totaljasa = OperasionalJasa::whereUserId($user_id->id)
                                    ->where('ceklis','Ya')
                                    ->whereYear('bulan', $tahunBerjalan)
                                    ->whereMonth('bulan', $bulanBerjalan)                                
                                    ->sum('tarif_jasa');
        $jumlah = OperasionalJasa::whereUserId($user_id->id)
                                ->whereYear('bulan', $tahunBerjalan)
                                ->whereMonth('bulan', $bulanBerjalan)                                
                                ->count();
        // return $history;
        return view ('template.backend.admin.jasamedis.daftar-tugas.detail-riwayat',compact('title','type','history','pending','complete','jumlah','totaljasa'));
    }

    public function SearchRiwayat(Request $request)
    {
        $request->validate([
            'bulan' => ['nullable', 'date'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable','date']
        ]);
        $title = 'Jadwal Tugas Layanan';
        $type = 'jasamedis';

        $user_id = Auth::id();

        $riwayat = OperasionalJasa::query();

        if ($request->filled('bulan')) {
            $riwayat->where('bulan', $request->bulan);
        } elseif ($request->filled('start_date') && $request->filled('end_date')) {
            $riwayat->whereBetween('bulan', [$request->start_date, $request->end_date]);
        }

        $riwayat = $riwayat->orderBy('bulan', 'desc')->orderBy('updated_at', 'desc')->get();

        $history = OperasionalJasa::query()
                        ->where('user_id',$user_id)
                        ->where('ceklis', 'Ya')
                        ->when($request->filled('bulan'), function ($query) use ($request) {
                            return $query->where('bulan', $request->bulan)->where('user_id',$user_id)->where('ceklis', 'Ya');
                        })
                        ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                            return $query->whereBetween('bulan', [$request->start_date, $request->end_date])->where('user_id',$user_id)->where('ceklis', 'Ya');
                        })->get();
        return $history;
        // return view ('template.backend.admin.jasamedis.daftar-tugas.detail-riwayat',compact('title','type','history','pending','complete','jumlah','totaljasa'));
 
    }

    public function cari(Request $request, User $user_id)
    {
        $request->validate([
            'bulan' => ['required']
        ]);
        $data = explode('-',$request->bulan);
        $history = presensi::whereUserId($user_id->id)
                            ->where('ceklis', 'Ya')
                            ->whereMonth('bulan',$data[1])
                            ->whereYear('bulan',$data[0])
                            ->orderBy('bulan','desc')->get();
        
        return history;
    }

}
