<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\presensi;
use App\Models\User;
use App\Models\cuti;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        // $cuti = cuti::where('status',['pengajuan','approve'])->get();
        $cuti = cuti::all();
        return view('backend.admin.izin.index',compact('title','cuti'));
        // return $cuti;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Pengajuan Izin';
        return view('frontend.cuti.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function presensi(Request $request)
    // {
    //     $request->validate([
    //         'tanggal_mulai' => 'required|date',
    //         'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    //         'alasan' => 'required|string',
    //     ]);

    //     $weekendDays = ['Saturday', 'Sunday'];
    //     $tanggalMulai = date('l', strtotime($request->tanggal_mulai));
    //     $tanggalSelesai = date('l', strtotime($request->tanggal_selesai));

    //     if (in_array($tanggalMulai, $weekendDays) || in_array($tanggalSelesai, $weekendDays)) {
    //         return back()->with('error', 'Tanggal cuti jatuh pada akhir pekan.');
    //     }

    //     $cutiData = [
    //         'user_id' => Auth()->user()->id,
    //         'keterangan' => 'Cuti',
    //         'tanggal' => $request->tanggal_mulai, 
    //         'jam_masuk' => null,
    //         'jam_keluar' => null,
    //     ];

    //     $tanggalCuti = strtotime($cutiData['tanggal']);
    //     $tanggalSelesai = strtotime($request->tanggal_selesai);

    //     while ($tanggalCuti <= $tanggalSelesai) {
    //         $existingAttendance = Presensi::where('user_id', $cutiData['user_id'])
    //             ->where('tanggal', date('Y-m-d', $tanggalCuti))
    //             ->first();

    //         if ($existingAttendance) {
    //             $existingAttendance->update(['keterangan' => 'Cuti']);
    //         } else {
    //             $cutiData['tanggal'] = date('Y-m-d', $tanggalCuti);
    //             presensi::create($cutiData);
    //         }

    //         $tanggalCuti = strtotime('+1 day', $tanggalCuti); 
    //     }

    //     return redirect()->route('cuti.create')->with('success', 'Pengajuan cuti berhasil diajukan.');
    // }

    public function store (Request $request)
    {
        $request->validate([
            'jenis_izin' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);
        $user_id = auth()->user()->id;

        $existingCuti = cuti::where('user_id', $user_id)
            ->where('status', 'pengajuan')
            // ->where('tanggal_mulai', '<=', $request->tanggal_berakhir)
            // ->where('tanggal_berakhir', '>=', $request->tanggal_mulai)
            ->first();

        if ($existingCuti) {
            return redirect()->back()->with('error', 'Anda tidak dapat mengajukan izin baru selama pengajuan izin sebelumnya masih berlangsung atau belum disetujui.');
        }

        $izinSebelumnya = cuti::where('user_id', $user_id)
            ->where(function ($query) use ($request) {
                $query->where('tanggal_mulai', '<=', $request->tanggal_berakhir)
                    ->where('tanggal_berakhir', '>=', $request->tanggal_mulai);
            })
            ->first();

        if ($izinSebelumnya) {
            return redirect()->back()->with('error', 'Tanggal yang Anda pilih telah digunakan untuk izin sebelumnya.');
        }


        $cutiData = [
            'user_id' => Auth()->user()->id,
            'jenis_izin' => $request->jenis_izin,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'alasan' => $request->alasan,
            'status' => 'pengajuan', 
        ];

        cuti::create($cutiData);
        // return $cutiData;
        return redirect()->back()->with('success', 'Berhasil di ajukan.');
    }

    public function VerifikasiCuti($id)
    {
        // $status = cuti::find($id);

        // if ($status) {
        //     $status->update(['status' => 'approve']);
        //     $mulai = $status->tanggal_mulai;
        //     $akhir = $status->tanggal_berakhir;
        //     $jenisIzin = $status->jenis_izin;

        //     $keterangan = ($jenisIzin == 'cuti') ? 'Cuti' : (($jenisIzin == 'sakit') ? 'Sakit' : null);

        //     if ($keterangan) {
        //         Presensi::where('user_id', $status->user_id)
        //             ->whereBetween('tanggal', [$mulai, $akhir])
        //             ->update(['keterangan' => $keterangan]);
        //     }

        //     return redirect()->back()->with('success', 'Data Berhasil Di Konfirmasi.');
        // } else {
        //     return ('error');
        // }
        $status = Cuti::find($id);

        if ($status) {
            $user = User::find($status->user_id);
            $jenisIzin = $status->jenis_izin;
        
            if ($jenisIzin == 'cuti_tahunan') {
                $mulai = Carbon::parse($status->tanggal_mulai);
                $akhir = Carbon::parse($status->tanggal_berakhir);
        
                // Hitung jumlah hari dalam rentang tanggal
                $jumlahHari = $mulai->diffInDays($akhir) + 1; 
        
                if ($user->saldo_cuti >= $jumlahHari) {
                    $user->saldo_cuti -= $jumlahHari;
                    $user->save();
                } else {
                    return redirect()->back()->with('error', 'Saldo cuti tahunan tidak mencukupi.');
                }
            }
        
            $status->update(['status' => 'approve']);
            $keterangan = ($jenisIzin == 'cuti') ? 'Cuti' : (($jenisIzin == 'sakit') ? 'Sakit' : null);
        
            if ($keterangan) {
                // Gunakan Eloquent untuk memperbarui catatan presensi
                Presensi::where('user_id', $status->user_id)
                    ->whereBetween('tanggal', [$mulai->toDateString(), $akhir->toDateString()])
                    ->update(['keterangan' => $keterangan]);
            }
        
            return redirect()->back()->with('success', 'Data Berhasil Dikonfirmasi.');
        } else {
            return redirect()->back()->with('error', 'Data Tidak Ditemukan.');
        }
        

    }

    public function RejectCuti($id)
    {
        $status = cuti::find($id);
        $status ->delete();
        return $status;
    }

    public function indexCutiUser()
    {
        $title = 'Pengajuan Cuti';
        $cuti = cuti::whereIn('status', ['pengajuan','approve'])
                    ->where('user_id', Auth::id())
                    ->get();
        
        return view('frontend.users.izin.index', compact('title', 'cuti'));
    
    }

}
