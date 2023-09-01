<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\presensi;
use App\Models\User;
use App\Models\cuti;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pengajuan Cuti';
        $cuti = cuti::all();
        return view('frontend.cuti.index',compact('title'));
        // return $cuti;
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
    public function presensi(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        $weekendDays = ['Saturday', 'Sunday'];
        $tanggalMulai = date('l', strtotime($request->tanggal_mulai));
        $tanggalSelesai = date('l', strtotime($request->tanggal_selesai));

        if (in_array($tanggalMulai, $weekendDays) || in_array($tanggalSelesai, $weekendDays)) {
            return back()->with('error', 'Tanggal cuti jatuh pada akhir pekan.');
        }

        $cutiData = [
            'user_id' => Auth()->user()->id,
            'keterangan' => 'Cuti',
            'tanggal' => $request->tanggal_mulai, 
            'jam_masuk' => null,
            'jam_keluar' => null,
        ];

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
                presensi::create($cutiData);
            }

            $tanggalCuti = strtotime('+1 day', $tanggalCuti); 
        }

        return redirect()->route('cuti.create')->with('success', 'Pengajuan cuti berhasil diajukan.');
    }

    public function store (Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        $cutiData = [
            'user_id' => Auth()->user()->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'alasan' => $request->alasan,
            'status' => 'pengajuan', 
        ];

        cuti::create($cutiData);
        return $cutiData;
        // return redirect()->route('cuti.create')->with('success', 'Pengajuan cuti berhasil diajukan.');

    }

}
