<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\presensi;
use App\Models\User;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.cuti.index');
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
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        // Cek jika tanggal cuti jatuh pada akhir pekan
        $weekendDays = ['Saturday', 'Sunday'];
        $tanggalMulai = date('l', strtotime($request->tanggal_mulai));
        $tanggalSelesai = date('l', strtotime($request->tanggal_selesai));

        if (in_array($tanggalMulai, $weekendDays) || in_array($tanggalSelesai, $weekendDays)) {
            return back()->with('error', 'Tanggal cuti jatuh pada akhir pekan.');
        }

        $cutiData = [
            'user_id' => auth()->user()->id,
            'keterangan' => 'Cuti',
            'tanggal' => $request->tanggal_mulai, // Tanggal awal cuti
            'jam_masuk' => null,
            'jam_keluar' => null,
        ];

        // Cek jika cuti dalam rentang tanggal_mulai hingga tanggal_selesai
        $tanggalCuti = strtotime($cutiData['tanggal']);
        $tanggalSelesai = strtotime($request->tanggal_selesai);

        while ($tanggalCuti <= $tanggalSelesai) {
            $existingAttendance = Presensi::where('user_id', $cutiData['user_id'])
                ->where('tanggal', date('Y-m-d', $tanggalCuti))
                ->first();

            if ($existingAttendance) {
                $existingAttendance->update(['keterangan' => 'Cuti']);
            } else {
                $cutiData['tanggal'] = date('Y-m-d', $tanggalCuti);
                Presensi::create($cutiData);
            }

            $tanggalCuti = strtotime('+1 day', $tanggalCuti); // Lanjut ke tanggal berikutnya
        }

        return redirect()->route('cuti.create')->with('success', 'Pengajuan cuti berhasil diajukan.');
    }

    

}
