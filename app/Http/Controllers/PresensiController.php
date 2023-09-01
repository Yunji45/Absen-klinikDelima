<?php

namespace App\Http\Controllers;

use App\Models\presensi;
use App\Models\User;
use App\Exports\PresentExport;
use App\Exports\UsersPresentExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presents = presensi::whereTanggal(date('Y-m-d'))->orderBy('jam_masuk','desc')->paginate(6);
        $masuk = presensi::whereTanggal(date('Y-m-d'))->whereKeterangan('masuk')->count();
        $telat = presensi::whereTanggal(date('Y-m-d'))->whereKeterangan('telat')->count();
        $cuti = presensi::whereTanggal(date('Y-m-d'))->whereKeterangan('cuti')->count();
        $alpha = presensi::whereTanggal(date('Y-m-d'))->whereKeterangan('alpha')->count();
        $rank = $presents->firstItem();
        return view('backend.admin.index', compact('presents','rank','masuk','telat','cuti','alpha'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'tanggal' => ['required']
        ]);
        $presents = presensi::whereTanggal($request->tanggal)->orderBy('jam_masuk','desc')->paginate(6);
        $masuk = presensi::whereTanggal($request->tanggal)->whereKeterangan('masuk')->count();
        $telat = presensi::whereTanggal($request->tanggal)->whereKeterangan('telat')->count();
        $cuti = presensi::whereTanggal($request->tanggal)->whereKeterangan('cuti')->count();
        $alpha = presensi::whereTanggal($request->tanggal)->whereKeterangan('alpha')->count();
        $rank = $presents->firstItem();
        return view('backend.admin.index', compact('presents','rank','masuk','telat','cuti','alpha'));
    }

    public function cari(Request $request, User $user)
    {
        $request->validate([
            'bulan' => ['required']
        ]);
        $data = explode('-',$request->bulan);
        $presents = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->orderBy('tanggal','desc')->paginate(5);
        $masuk = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('masuk')->count();
        $telat = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('telat')->count();
        $cuti = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('cuti')->count();
        $alpha = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('alpha')->count();
        $kehadiran = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('telat')->get();
        $totalJamTelat = 0;
        foreach ($kehadiran as $present) {
            $totalJamTelat = $totalJamTelat + (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse(config('absensi.jam_masuk') .' -1 hours')));
        }
        $url = 'https://kalenderindonesia.com/api/YZ35u6a7sFWN/libur/masehi/'.date('Y/m');
        $kalender = file_get_contents($url);
        $kalender = json_decode($kalender, true);
        $libur = false;
        $holiday = null;
        if ($kalender['data'] != false) {
            if ($kalender['data']['holiday']['data']) {
                foreach ($kalender['data']['holiday']['data'] as $key => $value) {
                    if ($value['date'] == date('Y-m-d')) {
                        $holiday = $value['name'];
                        $libur = true;
                        break;
                    }
                }
            }
        }
        return view('frontend.users.show', compact('presents','user','masuk','telat','cuti','alpha','libur','totalJamTelat'));
    }

    public function cariDaftarHadir(Request $request)
    {
        $request->validate([
            'bulan' => ['required']
        ]);
        $data = explode('-',$request->bulan);
        $presents = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->orderBy('tanggal','desc')->paginate(5);
        $masuk = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('masuk')->count();
        $telat = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('telat')->count();
        $cuti = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('cuti')->count();
        $alpha = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('alpha')->count();
        return view('backend.admin.show', compact('presents','masuk','telat','cuti','alpha'));
    }

    public function checkIn(Request $request)
    {
        // $users = User::all();
        // $data['jam_masuk']  = date('H:i:s');
        // $data['tanggal']    = date('Y-m-d');
        // $data['user_id']    = $request->user_id;

        // if (date('l') == 'Saturday' || date('l') == 'Sunday') {
        //     return redirect()->back()->with('error','Hari Libur Tidak bisa Absen');
        // }

        // foreach ($users as $user) {
        //     $absen = presensi::whereUserId($user->id)->whereTanggal($data['tanggal'])->first();
        //     if (!$absen) {
        //         if ($user->id != $data['user_id']) {
        //             presensi::create([
        //                 'keterangan'    => 'Alpha',
        //                 'tanggal'       => date('Y-m-d'),
        //                 'user_id'       => $user->id
        //             ]);
        //         }
        //     }
        // }

        // if (strtotime($data['jam_masuk']) >= strtotime(config('absensi.jam_masuk') .' -1 hours') && strtotime($data['jam_masuk']) <= strtotime(config('absensi.jam_masuk'))) {
        //     $data['keterangan'] = 'Masuk';
        // } else if (strtotime($data['jam_masuk']) > strtotime(config('absensi.jam_masuk')) && strtotime($data['jam_masuk']) <= strtotime(config('absensi.jam_keluar'))) {
        //     $data['keterangan'] = 'Telat';
        // } else {
        //     $data['keterangan'] = 'Alpha';
        // }

        // $present = presensi::whereUserId($data['user_id'])->whereTanggal($data['tanggal'])->first();
        // if ($present) {
        //     if ($present->keterangan == 'Alpha') {
        //         $present->update($data);
        //         return redirect()->back()->with('success','Check-in berhasil');
        //     } else {
        //         return redirect()->back()->with('error','Check-in gagal');
        //     }
        // }

        // presensi::create($data);
        // return redirect()->back()->with('success','Check-in berhasil');
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $user_id = $request->user_id;

        $weekendDays = ['Saturday', 'Sunday'];
        if (in_array(date('l'), $weekendDays)) {
            return back()->with('error', 'Hari Libur, Tidak bisa Absen');
        }

        $attendanceStatus = 'Alpha';
        $jam_masuk = strtotime($currentTime);
        $jam_masuk_config = strtotime(config('absensi.jam_masuk'));
        $jam_keluar_config = strtotime(config('absensi.jam_keluar'));

        if ($jam_masuk >= ($jam_masuk_config - 3600) && $jam_masuk <= $jam_masuk_config) {
            $attendanceStatus = 'Masuk';
        } else if ($jam_masuk > $jam_masuk_config && $jam_masuk <= $jam_keluar_config) {
            $attendanceStatus = 'Telat';
        }

        $existingAttendance = Presensi::where('user_id', $user_id)
            ->where('tanggal', $currentDate)
            ->first();

        if ($existingAttendance) {
            if ($existingAttendance->keterangan == 'Alpha') {
                $existingAttendance->update(['keterangan' => $attendanceStatus]);
                return Redirect::back()->with('success', 'Check-in berhasil');
            } else {
                return back()->with('error', 'Check-in gagal');
            }
        }

        $attendanceData = [
            'user_id' => $user_id,
            'keterangan' => $attendanceStatus,
            'tanggal' => $currentDate,
            'jam_masuk' => $currentTime,
            'jam_keluar' => null,
        ];

        Presensi::create($attendanceData);
        return Redirect::back()->with('success', 'Check-in berhasil');

    }

    public function checkOut(Request $request, presensi $kehadiran)
    {
        $data['jam_keluar'] = date('H:i:s');
        $kehadiran->update($data);
        return redirect()->back()->with('success', 'Check-out berhasil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $present = presensi::whereUserId($request->user_id)->whereTanggal(date('Y-m-d'))->first();
        if ($present) {
            return redirect()->back()->with('error','Absensi hari ini telah terisi');
        }
        $data = $request->validate([
            'keterangan'    => ['required'],
            'user_id'    => ['required']
        ]);
        $data['tanggal'] = date('Y-m-d');
        if ($request->keterangan == 'Masuk' || $request->keterangan == 'Telat') {
            $data['jam_masuk'] = $request->jam_masuk;
            if (strtotime($data['jam_masuk']) >= strtotime(config('absensi.jam_masuk') .' -1 hours') && strtotime($data['jam_masuk']) <= strtotime(config('absensi.jam_masuk'))) {
                $data['keterangan'] = 'Masuk';
            } else if (strtotime($data['jam_masuk']) > strtotime(config('absensi.jam_masuk')) && strtotime($data['jam_masuk']) <= strtotime(config('absensi.jam_keluar'))) {
                $data['keterangan'] = 'Telat';
            } else {
                $data['keterangan'] = 'Alpha';
            }
        }
        presensi::create($data);
        return redirect()->back()->with('success','Kehadiran berhasil ditambahkan');
    }

    public function ubah(Request $request)
    {
        $present = presensi::findOrFail($request->id);
        echo json_encode($present);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $presents = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->orderBy('tanggal','desc')->paginate(6);
        $masuk = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('masuk')->count();
        $telat = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('telat')->count();
        $cuti = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('cuti')->count();
        $alpha = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->whereKeterangan('alpha')->count();
        return view('backend.admin.show', compact('presents','masuk','telat','cuti','alpha'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Present  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Present $kehadiran)
    {
        $data = $request->validate([
            'keterangan'    => ['required']
        ]);

        if ($request->jam_keluar) {
            $data['jam_keluar'] = $request->jam_keluar;
        }

        if ($request->keterangan == 'Masuk' || $request->keterangan == 'Telat') {
            $data['jam_masuk'] = $request->jam_masuk;
            if (strtotime($data['jam_masuk']) >= strtotime(config('absensi.jam_masuk') .' -1 hours') && strtotime($data['jam_masuk']) <= strtotime(config('absensi.jam_masuk'))) {
                $data['keterangan'] = 'Masuk';
            } else if (strtotime($data['jam_masuk']) > strtotime(config('absensi.jam_masuk')) && strtotime($data['jam_masuk']) <= strtotime(config('absensi.jam_pulang'))) {
                $data['keterangan'] = 'Telat';
            } else {
                $data['keterangan'] = 'Alpha';
            }
        } else {
            $data['jam_masuk'] = null;
            $data['jam_keluar'] = null;
        }
        $kehadiran->update($data);
        return redirect()->back()->with('success', 'Kehadiran tanggal "'.date('l, d F Y',strtotime($kehadiran->tanggal)).'" berhasil diubah');
    }

    public function excelUser(Request $request, User $user)
    {
        return Excel::download(new PresentExport($user->id, $request->bulan), 'kehadiran-'.$user->nrp.'-'.$request->bulan.'.xlsx');
    }

    public function excelUsers(Request $request)
    {
        return Excel::download(new UsersPresentExport($request->tanggal), 'kehadiran-'.$request->tanggal.'.xlsx');
    }
}
