<?php

namespace App\Http\Controllers;

use App\Models\presensi;
use App\Models\User;
use App\Exports\PresentExport;
use App\Exports\UsersPresentExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use PDF;
use Auth;
use App\Models\jadwal;
use App\Models\jadwalterbaru;
use App\Models\rubahjadwal;
use App\Models\cuti;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $presents = presensi::whereTanggal(date('Y-m-d'))->orderBy('jam_masuk','desc')->paginate(6);
        $presents = presensi::whereTanggal(date('Y-m-d'))->orderBy('jam_masuk','desc')->get();
        $masuk = presensi::whereTanggal(date('Y-m-d'))->whereKeterangan('masuk')->count();
        $telat = presensi::whereTanggal(date('Y-m-d'))->whereKeterangan('telat')->count();
        $cuti = presensi::whereTanggal(date('Y-m-d'))->whereKeterangan('cuti')->count();
        $alpha = presensi::whereTanggal(date('Y-m-d'))->whereKeterangan('alpha')->count();
        $gantijaga = rubahjadwal::where('tanggal', date('Y-m-d'))
            ->where('permohonan', 'ganti_jaga')
            ->where('status', 'approve')
            ->count();
        $tukarjaga = rubahjadwal::where('tanggal', date('Y-m-d'))
            ->where('permohonan', 'tukar_jaga')
            ->where('status', 'approve')
            ->count();
        $permohonan = rubahjadwal::whereDate('tanggal', now()->format('Y-m-d'))->count();
        // $rank = $presents->firstItem();
        return view('backend.admin.index', compact('presents','masuk','telat','cuti','alpha','gantijaga','tukarjaga','permohonan'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'tanggal' => ['required']
        ]);
        $presents = presensi::whereTanggal($request->tanggal)->orderBy('jam_masuk','desc')->get();
        $masuk = presensi::whereTanggal($request->tanggal)->whereKeterangan('masuk')->count();
        $telat = presensi::whereTanggal($request->tanggal)->whereKeterangan('telat')->count();
        $cuti = presensi::whereTanggal($request->tanggal)->whereKeterangan('cuti')->count();
        $alpha = presensi::whereTanggal($request->tanggal)->whereKeterangan('alpha')->count();
        $gantijaga = rubahjadwal::whereTanggal($request->tanggal)
                                ->where('status','approve')
                                ->where('permohonan','ganti_jaga')
                                ->count();
        $tukarjaga = rubahjadwal::whereTanggal($request->tanggal)
                                ->where('status','approve')
                                ->where('permohonan','tukar_jaga')
                                ->count();
        $permohonan = rubahjadwal::whereTanggal($request->tanggal)
                                // ->where('status','approve')
                                // ->where('permohonan','tukar_jaga')
                                ->count();

        // $rank = $presents->firstItem();
        return view('backend.admin.index', compact('presents','masuk','telat','cuti','alpha','gantijaga','tukarjaga','permohonan'));
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
        $gantijaga = rubahjadwal::whereUserId($user->id)
                                ->whereMonth('tanggal', $data[1])
                                ->whereYear('tanggal', $data[0])
                                ->where('status', 'approve')
                                ->where('permohonan', 'ganti_jaga')
                                ->count();
        $tukarjaga = rubahjadwal::whereUserId($user->id)
                                ->whereMonth('tanggal', $data[1])
                                ->whereYear('tanggal', $data[0])
                                ->where('status', 'approve')
                                ->where('permohonan', 'tukar_jaga')
                                ->count();
                            
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
        return view('frontend.users.show', compact('presents','user','masuk','telat','cuti','alpha','libur','totalJamTelat','gantijaga','tukarjaga'));
        // return redirect()->back();
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

    // public function checkIn(Request $request)
    // {
    //     $user = Auth::user();
    //     // Cek jadwal pengguna
    //     $tanggalSekarang = date('j'); // Tanggal hari ini (1-31)
    //     $bulanSekarang = date('F'); // Nama bulan saat ini (e.g., "September")

    //     $jadwal = jadwalterbaru::where('user_id', $user->id)
    //         ->where('masa_aktif', '<=', date('Y-m-d'))
    //         ->where('masa_akhir', '>=', date('Y-m-d'))
    //         ->first();

    //     if ($jadwal) {
    //         $namaKolom = 'j' . $tanggalSekarang;
    //         $statusHariIni = $jadwal->$namaKolom;

    //         if (in_array($statusHariIni, ['SM' ,'PS' ,'PM'])) {
    //             $currentDate = date('Y-m-d');
    //             $currentTime = date('H:i:s');
    //             $user_id = $user->id;
    //             $attendanceStatus = 'Alpha';
    //             $jam_masuk = strtotime($currentTime);
    //             $jam_masuk_config = strtotime(config('absensi.jam_masuk'));
    //             $jam_keluar_config = strtotime(config('absensi.jam_keluar'));
    //             if ($jam_masuk >= ($jam_masuk_config - 3600) && $jam_masuk <= $jam_masuk_config) {
    //                 $attendanceStatus = 'Masuk';
    //             } else if ($jam_masuk > $jam_masuk_config && $jam_masuk <= $jam_keluar_config) {
    //                 $attendanceStatus = 'Telat';
    //             }

    //             $existingAttendance = presensi::where('user_id', $user_id)
    //                 ->where('tanggal', $currentDate)
    //                 ->first();

    //             if ($existingAttendance) {
    //                 if ($existingAttendance->keterangan == 'Alpha') {
    //                     $existingAttendance->update(['keterangan' => $attendanceStatus]);
    //                     return back()->with('success', 'Absen berhasil');
    //                 } else {
    //                     return back()->with('error', 'Absen gagal');
    //                 }
    //             }

    //             $attendanceData = [
    //                 'user_id' => $user_id,
    //                 'keterangan' => $attendanceStatus,
    //                 'tanggal' => $currentDate,
    //                 'jam_masuk' => $currentTime,
    //                 'jam_keluar' => null,
    //             ];

    //             Presensi::create($attendanceData);
    //             return back()->with('success', 'Absen berhasil.');
    //         } else if ($statusHariIni === 'L1') {
    //             //tukar jaga
    //             $user_id = $user->id;
    //             $approvedRequest = rubahjadwal::where('user_id', $user_id)
    //                 ->where('status', 'approve')
    //                 ->where('permohonan', 'tukar_jaga')
    //                 ->first();

    //             $userExists = User::where('id', $user_id)->exists();

    //             if (!$approvedRequest || !$userExists) {
    //                 return redirect()->back()->with('error', 'Jadwal Anda Hari Ini Tukar Jaga !! Anda perlu meminta persetujuan admin untuk check-in.');
    //             }
    //             $currentTime = date('H:i:s');
    //             $attendanceStatus = 'Alpha';
    //             $jam_masuk = strtotime($currentTime);
    //             $jam_masuk_config = strtotime(config('absensi.jam_masuk'));
    //             $jam_keluar_config = strtotime(config('absensi.jam_keluar'));

    //             if ($jam_masuk >= ($jam_masuk_config - 3600) && $jam_masuk <= $jam_masuk_config) {
    //                 $attendanceStatus = 'Masuk';
    //             } else if ($jam_masuk > $jam_masuk_config && $jam_masuk <= $jam_keluar_config) {
    //                 $attendanceStatus = 'Telat';
    //             }

    //             $currentDate = date('Y-m-d');
    //             $existingAttendance = Presensi::where('user_id', $user_id)
    //                 ->where('tanggal', $currentDate)
    //                 ->first();

    //             if ($existingAttendance) {
    //                 if ($existingAttendance->keterangan == 'Alpha') {
    //                     $existingAttendance->update(['keterangan' => $attendanceStatus]);
    //                     return back()->with('success', 'Absen berhasil');
    //                 } else {
    //                     return back()->with('error', 'Absen gagal');
    //                 }
    //             }

    //             $attendanceData = [
    //                 'user_id' => $user_id,
    //                 'keterangan' => $attendanceStatus,
    //                 'tanggal' => $currentDate,
    //                 'jam_masuk' => $currentTime,
    //                 'jam_keluar' => null,
    //             ];

    //             Presensi::create($attendanceData);
    //             return back()->with('success', 'Absen berhasil.');
    //         }else if($statusHariIni === 'L2'){
    //             //ganti jaga
    //             $user_id = $user->id;
    //             $approvedRequest = rubahjadwal::where('user_id', $user_id)
    //                 ->where('status', 'approve')
    //                 ->where('permohonan', 'ganti_jaga')
    //                 ->first();
    //             $userExists = User::where('id', $user_id)->exists();

    //             if (!$approvedRequest || !$userExists) {
    //                 return redirect()->back()->with('error', 'Jadwal Anda Hari Ini Ganti Jaga !!Anda perlu meminta persetujuan admin untuk check-in.');
    //             }
    //             $currentTime = date('H:i:s');
    //             $attendanceStatus = 'Alpha';
    //             $jam_masuk = strtotime($currentTime);
    //             $jam_masuk_config = strtotime(config('absensi.jam_masuk'));
    //             $jam_keluar_config = strtotime(config('absensi.jam_keluar'));

    //             if ($jam_masuk >= ($jam_masuk_config - 3600) && $jam_masuk <= $jam_masuk_config) {
    //                 $attendanceStatus = 'Masuk';
    //             } else if ($jam_masuk > $jam_masuk_config && $jam_masuk <= $jam_keluar_config) {
    //                 $attendanceStatus = 'Telat';
    //             }

    //             $currentDate = date('Y-m-d');
    //             $existingAttendance = Presensi::where('user_id', $user_id)
    //                 ->where('tanggal', $currentDate)
    //                 ->first();

    //             if ($existingAttendance) {
    //                 if ($existingAttendance->keterangan == 'Alpha') {
    //                     $existingAttendance->update(['keterangan' => $attendanceStatus]);
    //                     return back()->with('success', 'Absen berhasil');
    //                 } else {
    //                     return back()->with('error', 'Absen gagal');
    //                 }
    //             }

    //             $attendanceData = [
    //                 'user_id' => $user_id,
    //                 'keterangan' => $attendanceStatus,
    //                 'tanggal' => $currentDate,
    //                 'jam_masuk' => $currentTime,
    //                 'jam_keluar' => null,
    //             ];

    //             Presensi::create($attendanceData);
    //             return back()->with('success', 'Absen berhasil.');
    //         }else if(in_array($statusHariIni, ['C', 'IJ'])){
    //             $user_id = $user->id;

    //             // Check status izin cuti pengguna
    //             $cuti = cuti::where('user_id', $user_id)
    //                         ->where('tanggal_mulai', '<=', $currentDate)
    //                         ->where('tanggal_berakhir', '>=', $currentDate)
    //                         ->where('status', 'approve')
    //                         ->first();
    //                 if (!$cuti) {
    //                     $attendanceStatus = 'Alpha';
    //                     $jam_masuk = strtotime($currentTime);
    //                     $jam_masuk_config = strtotime(config('absensi.jam_masuk'));
    //                     $jam_keluar_config = strtotime(config('absensi.jam_keluar'));
                
    //                     if ($jam_masuk >= ($jam_masuk_config - 3600) && $jam_masuk <= $jam_masuk_config) {
    //                         $attendanceStatus = 'Masuk';
    //                     } else if ($jam_masuk > $jam_masuk_config && $jam_masuk <= $jam_keluar_config) {
    //                         $attendanceStatus = 'Telat';
    //                     }
                
    //                     $existingAttendance = Presensi::where('user_id', $user_id)
    //                         ->where('tanggal', $currentDate)
    //                         ->first();
                
    //                     if ($existingAttendance) {
    //                         if ($existingAttendance->keterangan == 'Alpha') {
    //                             $existingAttendance->update(['keterangan' => $attendanceStatus]);
    //                             return back()->with('success', 'Absen berhasil');
    //                         } else {
    //                             return back()->with('error', 'Absen gagal');
    //                         }
    //                     }
                
    //                     $attendanceData = [
    //                         'user_id' => $user_id,
    //                         'keterangan' => $attendanceStatus,
    //                         'tanggal' => $currentDate,
    //                         'jam_masuk' => $currentTime,
    //                         'jam_keluar' => null,
    //                     ];
                
    //                     Presensi::create($attendanceData);
    //                     return back()->with('success', 'Absen berhasil.');
    //                 } else {
    //                     return back()->with('error', 'Anda memiliki izin cuti untuk hari ini.');
    //                 }                            
    //         } else {
    //             return redirect()->back()->with('error', 'Check-in tidak diizinkan untuk hari ini.');
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
    //     }
    // }

    public function checkIn(Request $request)
    {
        $user = Auth::user();
        // Cek jadwal pengguna
        $tanggalSekarang = date('j'); // Tanggal hari ini (1-31)
        $bulanSekarang = date('F'); // Nama bulan saat ini (e.g., "September")

        $jadwal = jadwalterbaru::where('user_id', $user->id)
            ->where('masa_aktif', '<=', date('Y-m-d'))
            ->where('masa_akhir', '>=', date('Y-m-d'))
            ->first();

        if ($jadwal) {
            $namaKolom = 'j' . $tanggalSekarang;
            $statusHariIni = $jadwal->$namaKolom;
            //absen SM
            if (in_array($statusHariIni, ['SM'])) {
                $currentDate = date('Y-m-d');
                $currentTime = date('H:i');
                $user_id = $user->id;
                $attendanceStatus = 'Alpha';
                $jam_masuk = strtotime($currentTime);
                $jam_masuk_config = strtotime(config('absensi.jam_masuk_SM'));
                $jam_keluar_config = strtotime(config('absensi.jam_keluar_SM'));
                if ($jam_masuk >= ($jam_masuk_config - 7200) && $jam_masuk <= $jam_masuk_config) {
                    $attendanceStatus = 'Masuk';
                } else if ($jam_masuk > $jam_masuk_config && $jam_masuk <= $jam_keluar_config) {
                    $attendanceStatus = 'Telat';
                }

                $existingAttendance = presensi::where('user_id', $user_id)
                    ->where('tanggal', $currentDate)
                    ->first();

                if ($existingAttendance) {
                    if ($existingAttendance->keterangan == 'Alpha') {
                        $existingAttendance->update(['keterangan' => $attendanceStatus]);
                        return back()->with('success', 'Absen berhasil');
                    } else {
                        return back()->with('error', 'Absen gagal');
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
                return back()->with('success', 'Absen berhasil.');
            //absen PS
            }else if ($statusHariIni === 'PS') {
                $currentDate = date('Y-m-d');
                $currentTime = date('H:i');
                $user_id = $user->id;
                $attendanceStatus = 'Alpha';
                $jam_masuk = strtotime($currentTime);
                $jam_masuk_config = strtotime(config('absensi.jam_masuk_PS'));
                $jam_keluar_config = strtotime(config('absensi.jam_keluar_PS'));
                if ($jam_masuk >= ($jam_masuk_config - 7200) && $jam_masuk <= $jam_masuk_config) {
                    $attendanceStatus = 'Masuk';
                } else if ($jam_masuk > $jam_masuk_config && $jam_masuk <= $jam_keluar_config) {
                    $attendanceStatus = 'Telat';
                }

                $existingAttendance = presensi::where('user_id', $user_id)
                    ->where('tanggal', $currentDate)
                    ->first();

                if ($existingAttendance) {
                    if ($existingAttendance->keterangan == 'Alpha') {
                        $existingAttendance->update(['keterangan' => $attendanceStatus]);
                        return back()->with('success', 'Absen berhasil');
                    } else {
                        return back()->with('error', 'Absen gagal');
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
                return back()->with('success', 'Absen berhasil.');
            //absen PM
            }else if ($statusHariIni === 'PM') {
                $currentDate = date('Y-m-d');
                $currentTime = date('H:i');
                $user_id = $user->id;
                $attendanceStatus = 'Alpha';
                $jam_masuk = strtotime($currentTime);
                $jam_masuk_config = strtotime(config('absensi.jam_masuk_PM'));
                $jam_keluar_config = strtotime(config('absensi.jam_keluar_PM'));
                if ($jam_masuk >= ($jam_masuk_config - 7200) && $jam_masuk <= $jam_masuk_config) {
                    $attendanceStatus = 'Masuk';
                } else if ($jam_masuk > $jam_masuk_config && $jam_masuk <= $jam_keluar_config) {
                    $attendanceStatus = 'Telat';
                }

                $existingAttendance = presensi::where('user_id', $user_id)
                    ->where('tanggal', $currentDate)
                    ->first();

                if ($existingAttendance) {
                    if ($existingAttendance->keterangan == 'Alpha') {
                        $existingAttendance->update(['keterangan' => $attendanceStatus]);
                        return back()->with('success', 'Absen berhasil');
                    } else {
                        return back()->with('error', 'Absen gagal');
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
                return back()->with('success', 'Absen berhasil.');
            }else if ($statusHariIni === 'L1') {
                //tukar jaga
                $user_id = $user->id;
                $approvedRequest = rubahjadwal::where('user_id', $user_id)
                    ->where('status', 'approve')
                    ->where('permohonan', 'tukar_jaga')
                    ->first();

                $userExists = User::where('id', $user_id)->exists();

                if (!$approvedRequest || !$userExists) {
                    return redirect()->back()->with('error', 'Jadwal Anda Hari Ini Tukar Jaga !! Anda perlu meminta persetujuan admin untuk check-in.');
                }
                $currentTime = date('H:i');
                $attendanceStatus = 'Alpha';
                $jam_masuk = strtotime($currentTime);
                $jam_masuk_config = strtotime(config('absensi.jam_masuk'));
                $jam_keluar_config = strtotime(config('absensi.jam_keluar'));

                if ($jam_masuk >= ($jam_masuk_config - 7200) && $jam_masuk <= $jam_masuk_config) {
                    $attendanceStatus = 'Masuk';
                } else if ($jam_masuk > $jam_masuk_config && $jam_masuk <= $jam_keluar_config) {
                    $attendanceStatus = 'Masuk';
                }

                $currentDate = date('Y-m-d');
                $existingAttendance = Presensi::where('user_id', $user_id)
                    ->where('tanggal', $currentDate)
                    ->first();

                if ($existingAttendance) {
                    if ($existingAttendance->keterangan == 'Alpha') {
                        $existingAttendance->update(['keterangan' => $attendanceStatus]);
                        return back()->with('success', 'Absen berhasil');
                    } else {
                        return back()->with('error', 'Absen gagal');
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
                return back()->with('success', 'Absen berhasil.');
            }else if($statusHariIni === 'L2'){
                //ganti jaga
                $user_id = $user->id;
                $approvedRequest = rubahjadwal::where('user_id', $user_id)
                    ->where('status', 'approve')
                    ->where('permohonan', 'ganti_jaga')
                    ->first();
                $userExists = User::where('id', $user_id)->exists();

                if (!$approvedRequest || !$userExists) {
                    return redirect()->back()->with('error', 'Jadwal Anda Hari Ini Ganti Jaga !!Anda perlu meminta persetujuan admin untuk check-in.');
                }
                $currentTime = date('H:i');
                $attendanceStatus = 'Masuk';
                $jam_masuk = strtotime($currentTime);
                $jam_masuk_config = strtotime(config('absensi.jam_masuk'));
                $jam_keluar_config = strtotime(config('absensi.jam_keluar'));

                if ($jam_masuk >= ($jam_masuk_config - 7200) && $jam_masuk <= $jam_masuk_config) {
                    $attendanceStatus = 'Masuk';
                } else if ($jam_masuk > $jam_masuk_config && $jam_masuk <= $jam_keluar_config) {
                    $attendanceStatus = 'Masuk';
                }

                $currentDate = date('Y-m-d');
                $existingAttendance = Presensi::where('user_id', $user_id)
                    ->where('tanggal', $currentDate)
                    ->first();

                if ($existingAttendance) {
                    if ($existingAttendance->keterangan == 'Alpha') {
                        $existingAttendance->update(['keterangan' => $attendanceStatus]);
                        return back()->with('success', 'Absen berhasil');
                    } else {
                        return back()->with('error', 'Absen gagal');
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
                return back()->with('success', 'Absen berhasil.');
            }else if(in_array($statusHariIni, ['C', 'IJ'])){
                $user_id = $user->id;

                // Check status izin cuti pengguna
                $cuti = cuti::where('user_id', $user_id)
                            ->where('tanggal_mulai', '<=', $currentDate)
                            ->where('tanggal_berakhir', '>=', $currentDate)
                            ->where('status', 'approve')
                            ->first();
                    if (!$cuti) {
                        $attendanceStatus = 'Alpha';
                        $jam_masuk = strtotime($currentTime);
                        $jam_masuk_config = strtotime(config('absensi.jam_masuk'));
                        $jam_keluar_config = strtotime(config('absensi.jam_keluar'));
                
                        if ($jam_masuk >= ($jam_masuk_config - 7200) && $jam_masuk <= $jam_masuk_config) {
                            $attendanceStatus = 'Masuk';
                        } else if ($jam_masuk > $jam_masuk_config && $jam_masuk <= $jam_keluar_config) {
                            $attendanceStatus = 'Masuk';
                        }
                
                        $existingAttendance = Presensi::where('user_id', $user_id)
                            ->where('tanggal', $currentDate)
                            ->first();
                
                        if ($existingAttendance) {
                            if ($existingAttendance->keterangan == 'Alpha') {
                                $existingAttendance->update(['keterangan' => $attendanceStatus]);
                                return back()->with('success', 'Absen berhasil');
                            } else {
                                return back()->with('error', 'Absen gagal');
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
                        return back()->with('success', 'Absen berhasil.');
                    } else {
                        return back()->with('error', 'Anda memiliki izin cuti untuk hari ini.');
                    }                            
            }else {
                return redirect()->back()->with('error', 'Check-in tidak diizinkan untuk hari ini.');
            }
        } else {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan.');
        }
    }


    

    public function checkOut(Request $request, presensi $kehadiran)
    {
        $data['jam_keluar'] = date('H:i:s');
        $kehadiran->update($data);
        return redirect()->back()->with('success', 'Absen keluar berhasil');
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
        $gantijaga = rubahjadwal::whereUserId(auth()->user()->id)
                            ->whereMonth('tanggal', date('m'))
                            ->whereYear('tanggal', date('Y'))
                            ->where('permohonan', 'ganti_jaga')
                            ->count();
        $tukarjaga = rubahjadwal::whereUserId(auth()->user()->id)
                            ->whereMonth('tanggal', date('m'))
                            ->whereYear('tanggal', date('Y'))
                            ->where('permohonan', 'tukar_jaga')
                            ->count();
                        
        return view('backend.admin.show', compact('presents','masuk','telat','cuti','alpha','gantijaga','tukarjaga'));
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

    public function DownloadPreDay()
    {
        $presents = presensi::whereTanggal(date('Y-m-d'))->orderBy('jam_masuk','desc')->get();
        $pdf = PDF::loadview('frontend.users.daypresensi',['presents'=>$presents]);
        return $pdf->download('Presensi-per-day');            
    }

    public function DownloadPerUser($user_id)
    {
        $presents = presensi::find($user_id);
        $pdf = PDF::loadview('frontend.users.userpresensi',['presents'=>$presents]);
        return $pdf->download('Presensi-per-user');            
        // return $presents;
    
    }
}