<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rubahjadwal;
use App\Models\jadwal;
use App\Models\jadwalterbaru;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class RubahjadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Permohonan Jadwal';
        $user = User::all();
        $permohonan = rubahjadwal::whereIn('status', ['pengajuan','approve'])
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view ('frontend.users.permohonan.index',compact('title','user','permohonan'));
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
        $request->validate([
            'permohonan' => 'required',
            'tanggal' => 'required|date',
            'alasan' => 'required|string',
        ]);
        $user_id = auth()->user()->id;

        // $existingCuti = rubahjadwal::where('user_id', $user_id)
        //     ->where('status', 'pengajuan')
        //    ->first();

        // if ($existingCuti) {
        //     return redirect()->back()->with('error', 'Anda tidak dapat mengajukan izin baru selama pengajuan izin sebelumnya masih berlangsung atau belum disetujui.');
        // }

        // $izinSebelumnya = rubahjadwal::where('user_id', $user_id)
        //     ->where(function ($query) use ($request) {
        //         $query->where('tanggal', '<=', $request->tanggal);
        //     })
        //     ->first();

        // if ($izinSebelumnya) {
        //     return redirect()->back()->with('error', 'Tanggal yang Anda pilih telah digunakan untuk izin sebelumnya.');
        // }
        $existingCuti = RubahJadwal::where('user_id', $user_id)
        ->where('status', 'pengajuan')
        ->first();

        if ($existingCuti) {
            return redirect()->back()->with('error', 'User tersebut tidak dapat mengajukan izin baru selama pengajuan izin sebelumnya masih berlangsung atau belum disetujui.');
        }

        $izinSebelumnya = RubahJadwal::where('user_id', $user_id)
            ->where('tanggal', $request->tanggal)
            ->where('status', 'pengajuan') // Hanya mempertimbangkan permintaan yang masih tertunda
            ->first();

        if ($izinSebelumnya) {
            return redirect()->back()->with('error', 'Tanggal yang Anda pilih telah digunakan oleh pengguna untuk izin sebelumnya.');
        }
        
        $permohonan = [
            'user_id' => Auth()->user()->id,
            'permohonan' => $request->permohonan,
            'pengganti' => $request->pengganti ?? null,
            'tanggal' => $request->tanggal,
            'alasan' => $request->alasan,
            'status' => 'pengajuan', 
        ];

        rubahjadwal::create($permohonan);
        // return $cutiData;
        return redirect()->back()->with('success', 'Berhasil di ajukan.');
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
        $title = 'Hapus Permohonan';
        $data = rubahjadwal::find($id);
        $data->delete();
        if ($data){
            return redirect()->back()->with('success', 'Data Permohonan Berhasil Di Hapus');
        }else {
            return redirect()->back()->with('error', 'Data Permohonan Gagal Di Hapus');
        }
    }

    public function indexAdmin()
    {
        $title = 'Permohonan Jadwal';
        $user = User::all();
        $permohonan = rubahjadwal::whereIn('status', ['pengajuan', 'approve'])
        ->orderBy('created_at', 'desc') 
        ->get();
        return view ('backend.admin.permohonan.index',compact('title','permohonan','user'));
    }

    public function VerifPermohonan(Request $request ,$id)
    {
        $permohonan = rubahjadwal::find($id);

        if ($permohonan) {
            if ($permohonan->permohonan == 'lembur') {
                if ($permohonan->tanggal) {
                    $jadwalterbarus = jadwalterbaru::where('user_id', $permohonan->user_id)->get();
    
                    // if ($jadwalterbarus) {
                    //     $namaKolom = 'j' . ltrim(Carbon::parse($permohonan->tanggal)->format('d'), '0');
                    //     // $namaKolom = 'j' . Carbon::parse($permohonan->tanggal)->format('d');
                    //     $jadwalterbarus->$namaKolom = 'LL';
                    //     $jadwalterbarus->save();
                    // }
                    foreach ($jadwalterbarus as $barisJadwal) {
                        $namaKolom = 'j' . ltrim(Carbon::parse($permohonan->tanggal)->format('d'), '0');
                        $barisJadwal->$namaKolom = 'LL';
                        $barisJadwal->save();
                    }
                }
    
                // Mengubah status permohonan menjadi 'approve'
                $permohonan->update(['status' => 'approve']);
    
                return redirect()->back()->with('success', 'Permohonan User Berhasil Di Setujui');
            } elseif ($permohonan->permohonan == 'ganti_jaga') {
                $permohonan->update(['status' => 'approve']);
                return redirect()->back()->with('success', 'Permohonan Ganti Jaga Berhasil Di Setujui');
            }else if($permohonan->permohonan == 'tukar_jaga'){
                $permohonan->update(['status' => 'approve']);
                return redirect()->back()->with('success', 'Permohonan Tukar Jaga Berhasil Di Setujui');
            }
        } else {
            return redirect()->back()->with('error', 'Permohonan Tidak Di Setujui');
        }
    
    }

    // public function storeAdm(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required',
    //         'permohonan' => 'required',
    //         'tanggal' => 'required|date',
    //         'alasan' => 'required|string',
    //     ]);
    //     $user_id = $request->input('user_id');

    //     $existingCuti = rubahjadwal::where('user_id', $user_id)
    //         ->where('status', 'pengajuan')
    //        ->first();

    //     if ($existingCuti) {
    //         return redirect()->back()->with('error', 'User tersebut tidak dapat mengajukan izin baru selama pengajuan izin sebelumnya masih berlangsung atau belum disetujui.');
    //     }

    //     $izinSebelumnya = rubahjadwal::where('user_id', $user_id)
    //         ->where(function ($query) use ($request) {
    //             $query->where('tanggal', '<=', $request->tanggal);
    //         })
    //         ->first();

    //     if ($izinSebelumnya) {
    //         return redirect()->back()->with('error', 'Tanggal yang Anda pilih telah digunakan User untuk izin sebelumnya.');
    //     }


    //     $permohonan = new rubahjadwal;
    //     $permohonan -> user_id = $request->user_id;
    //     $permohonan -> permohonan = $request->permohonan;
    //     $permohonan -> tanggal = $request->tanggal;
    //     $permohonan -> alasan = $request->alasan;
    //     $permohonan -> status = 'pengajuan';
    //     $permohonan ->save();
    //     // return $permohonan;
    //     return redirect()->back()->with('success', 'Berhasil di ajukan.');
    // }
    public function storeAdm(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'permohonan' => 'required',
            'tanggal' => 'required|date',
            'alasan' => 'required|string',
        ]);

        $user_id = $request->input('user_id');

        $existingCuti = RubahJadwal::where('user_id', $user_id)
            ->where('status', 'pengajuan')
            ->first();

        if ($existingCuti) {
            return redirect()->back()->with('error', 'User tersebut tidak dapat mengajukan izin baru selama pengajuan izin sebelumnya masih berlangsung atau belum disetujui.');
        }

        $izinSebelumnya = RubahJadwal::where('user_id', $user_id)
            ->where('tanggal', $request->tanggal)
            ->where('status', 'pengajuan') // Hanya mempertimbangkan permintaan yang masih tertunda
            ->first();

        if ($izinSebelumnya) {
            return redirect()->back()->with('error', 'Tanggal yang Anda pilih telah digunakan oleh pengguna untuk izin sebelumnya.');
        }

        $permohonan = new RubahJadwal;
        $permohonan->user_id = $user_id;
        $permohonan->permohonan = $request->permohonan;
        $permohonan->pengganti = $request->pengganti ?? null;
        $permohonan->tanggal = $request->tanggal;
        $permohonan->alasan = $request->alasan;
        $permohonan->status = 'pengajuan';
        $permohonan->save();

        return redirect()->back()->with('success', 'Berhasil diajukan.');
    }

}
