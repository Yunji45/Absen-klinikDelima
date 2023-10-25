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
        $user = User::all();
        $cuti = cuti::whereIn('status', ['pengajuan', 'approve'])
        ->orderBy('created_at', 'desc') 
        ->get();
        return view('backend.admin.izin.index',compact('title','cuti','user'));
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

    public function storeAdm(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'jenis_izin' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);
        $user_id = $request->input('user_id');

        $existingCuti = cuti::where('user_id', $user_id)
            ->where('status', 'pengajuan')
           ->first();

        if ($existingCuti) {
            return redirect()->back()->with('error', 'User tersebut tidak dapat mengajukan izin baru selama pengajuan izin sebelumnya masih berlangsung atau belum disetujui.');
        }

        $izinSebelumnya = cuti::where('user_id', $user_id)
            ->where(function ($query) use ($request) {
                $query->where('tanggal_mulai', '<=', $request->tanggal_berakhir)
                    ->where('tanggal_berakhir', '>=', $request->tanggal_mulai);
            })
            ->first();

        if ($izinSebelumnya) {
            return redirect()->back()->with('error', 'Tanggal yang Anda pilih telah digunakan User untuk izin sebelumnya.');
        }


        $cutiData = [
            'user_id' => $request->user_id,
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
        $status = Cuti::find($id);

        if ($status) {
            $user = User::find($status->user_id);
            $jenisIzin = $status->jenis_izin;

            $mulai = Carbon::parse($status->tanggal_mulai);
            $akhir = Carbon::parse($status->tanggal_berakhir);

            if ($jenisIzin == 'cuti_tahunan') {
                $mulai = Carbon::parse($status->tanggal_mulai);
                $akhir = Carbon::parse($status->tanggal_berakhir);
        
                $jumlahHari = $mulai->diffInDays($akhir) + 1; 
        
                if ($user->saldo_cuti >= $jumlahHari) {
                    $user->saldo_cuti -= $jumlahHari;
                    $user->save();
                } else {
                    return redirect()->back()->with('error', 'Saldo cuti tahunan tidak mencukupi.');
                }
            }
        
            $status->update(['status' => 'approve']);
            $keterangan = null;
            switch ($jenisIzin) {
                case 'cuti_tahunan':
                case 'cuti_bersama':
                case 'cuti_melahirkan':
                case 'cuti_besar':
                    $keterangan = 'Cuti';
                    break;
                case 'sakit':
                    $keterangan = 'Sakit';
                    break;
                case 'izin':
                    $keterangan = 'Izin';
                    break;
            }                    
            if ($keterangan) {
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
        // return $status;
        return redirect()->back()->with('success','Data Izin Berhasil Di Hapus');
    }

    public function indexCutiUser()
    {
        $title = 'Pengajuan Cuti';
        $cuti = cuti::whereIn('status', ['pengajuan','approve'])
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('frontend.users.izin.index', compact('title', 'cuti'));
    }

}
