<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rubahjadwal;
use App\Models\jadwal;
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
            'pengganti' => 'required',
            'tanggal' => 'required|date',
            'alasan' => 'required|string',
        ]);
        $user_id = auth()->user()->id;

        $existingCuti = rubahjadwal::where('user_id', $user_id)
            ->where('status', 'pengajuan')
           ->first();

        if ($existingCuti) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengajukan izin baru selama pengajuan izin sebelumnya masih berlangsung atau belum disetujui.');
        }

        $izinSebelumnya = rubahjadwal::where('user_id', $user_id)
            ->where(function ($query) use ($request) {
                $query->where('tanggal', '<=', $request->tanggal);
            })
            ->first();

        if ($izinSebelumnya) {
            return redirect()->back()->with('error', 'Tanggal yang Anda pilih telah digunakan untuk izin sebelumnya.');
        }


        $permohonan = [
            'user_id' => Auth()->user()->id,
            'permohonan' => $request->permohonan,
            'pengganti' => $request->pengganti,
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
        //
    }

    public function indexAdmin()
    {
        $title = 'Permohonan Jadwal';
        $permohonan = rubahjadwal::whereIn('status', ['pengajuan', 'approve'])
        ->orderBy('created_at', 'desc') 
        ->get();
        return view ('backend.admin.permohonan.index',compact('title','permohonan'));
    }

    public function VerifPermohonan($id)
    {
        $permohonan = rubahjadwal::find($id);
        if($permohonan)
        {
            $permohonan->update(['status' => 'approve']);
            return redirect()->back()->with('success', 'Permohonan User Berhasil Di Setujui');
        }else{
            return redirect()->back()->with('error', 'Permohonan Tidak Di Setujui');
        }   
    }
}
