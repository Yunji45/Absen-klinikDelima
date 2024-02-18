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
        $title = 'Absensi';
        $type = 'presensi';
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
        $lembur = rubahjadwal::where('tanggal', date('Y-m-d'))
            ->where('permohonan', 'lembur')
            ->where('status', 'approve')
            ->count();
        // $permohonan = rubahjadwal::whereDate('tanggal', now()->format('Y-m-d'))->count();
        $permohonan = presensi::whereTanggal(date('Y-m-d'))->where(function ($query) {
            $query->where('keterangan', 'masuk')
                  ->orWhere('keterangan', 'telat');
        })->count();       
        // $rank = $presents->firstItem();
        return view('template.backend.admin.absen.index', compact('presents','masuk','telat','cuti','alpha','gantijaga','tukarjaga','permohonan','lembur','title','type'));
        // return view('backend.admin.index', compact('presents','masuk','telat','cuti','alpha','gantijaga','tukarjaga','permohonan','lembur','title','type'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'tanggal' => ['nullable', 'date'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable','date']
        ]);
        $title = 'Absensi';
        $type = 'presensi';

        $presents = Presensi::query();

        if ($request->filled('tanggal')) {
            $presents->where('tanggal', $request->tanggal);
        } elseif ($request->filled('start_date') && $request->filled('end_date')) {
            $presents->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $presents = $presents->orderBy('tanggal', 'asc')->orderBy('jam_masuk', 'asc')->get();

        $masuk = presensi::query()
                        ->where('keterangan', 'Masuk')
                        ->when($request->filled('tanggal'), function ($query) use ($request) {
                            return $query->where('tanggal', $request->tanggal)->where('keterangan', 'Masuk');
                        })
                        ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                            return $query->whereBetween('tanggal', [$request->start_date, $request->end_date])->where('keterangan', 'Masuk');
                        })->count();
        $telat = presensi::query()
                        ->where('keterangan', 'Telat')
                        ->when($request->filled('tanggal'), function ($query) use ($request) {
                            return $query->where('tanggal', $request->tanggal)->where('keterangan', 'Telat');
                        })
                        ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                            return $query->whereBetween('tanggal', [$request->start_date, $request->end_date])->where('keterangan', 'Telat');
                        })->count();
        $cuti = presensi::query()
                        ->where('keterangan', 'Cuti')
                        ->when($request->filled('tanggal'), function ($query) use ($request) {
                            return $query->where('tanggal', $request->tanggal)->where('keterangan', 'Cuti');
                        })
                        ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                            return $query->whereBetween('tanggal', [$request->start_date, $request->end_date])->where('keterangan', 'Cuti');
                        })->count();
        $alpha = presensi::query()
                        ->where('keterangan', 'Alpha')
                        ->when($request->filled('tanggal'), function ($query) use ($request) {
                            return $query->where('tanggal', $request->tanggal)->where('keterangan', 'Alpha');
                        })
                        ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                            return $query->whereBetween('tanggal', [$request->start_date, $request->end_date])->where('keterangan', 'Alpha');
                        })->count();
        $izin = presensi::query()
                        ->where('keterangan', 'Izin')
                        ->when($request->filled('tanggal'), function ($query) use ($request) {
                            return $query->where('tanggal', $request->tanggal)->where('keterangan', 'Izin');
                        })
                        ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                            return $query->whereBetween('tanggal', [$request->start_date, $request->end_date])->where('keterangan', 'Izin');
                        })->count();

        $gantijaga = RubahJadwal::query()
            ->where('status', 'approve')
            ->when($request->filled('tanggal'), function ($query) use ($request) {
                return $query->where('tanggal', $request->tanggal)->where('permohonan', 'ganti_jaga');
            })
            ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                return $query->whereBetween('tanggal', [$request->start_date, $request->end_date])->where('permohonan', 'ganti_jaga');
            })
            ->count();

        $tukarjaga = RubahJadwal::query()
            ->where('status', 'approve')
            ->when($request->filled('tanggal'), function ($query) use ($request) {
                return $query->where('tanggal', $request->tanggal)->where('permohonan', 'tukar_jaga');
            })
            ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                return $query->whereBetween('tanggal', [$request->start_date, $request->end_date])->where('permohonan', 'tukar_jaga');
            })
            ->count();
        $lembur = RubahJadwal::query()
            ->where('status', 'approve')
            ->when($request->filled('tanggal'), function ($query) use ($request) {
                return $query->where('tanggal', $request->tanggal)->where('permohonan', 'lembur');
            })
            ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                return $query->whereBetween('tanggal', [$request->start_date, $request->end_date])->where('permohonan', 'lembur');
            })
            ->count();

        $permohonan = presensi::query()
                ->when($request->filled('tanggal'), function ($query) use ($request) {
                    return $query->where(function ($query) use ($request) {
                        $query->where('keterangan', 'masuk')->orWhere('keterangan', 'telat');
                    })->where('tanggal', $request->tanggal);
                })
                ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                    return $query->where(function ($query) use ($request) {
                        $query->where('keterangan', 'masuk')->orWhere('keterangan', 'telat');
                    })->whereBetween('tanggal', [$request->start_date, $request->end_date]);
                })->count();
        // return view('backend.admin.index', compact('presents', 'masuk', 'telat', 'cuti', 'alpha', 'gantijaga', 'tukarjaga', 'permohonan','lembur'));
        return view('template.backend.admin.absen.index', compact('presents','masuk','telat','cuti','alpha','gantijaga','tukarjaga','permohonan','lembur','title','type','izin'));
 
    }

    public function cari(Request $request, User $user)
    {
        $request->validate([
            'bulan' => ['required']
        ]);
        $data = explode('-',$request->bulan);
        $presents = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->orderBy('tanggal','desc')->get();
        $masuk = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('masuk')->count();
        $telat = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('telat')->count();
        $cuti = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('cuti')->count();
        $alpha = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('alpha')->count();
        $izin = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->whereKeterangan('izin')->count();
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
        $lembur = rubahjadwal::whereUserId($user->id)
                                ->whereMonth('tanggal', $data[1])
                                ->whereYear('tanggal', $data[0])
                                ->where('status', 'approve')
                                ->where('permohonan', 'lembur')
                                ->count();

        $permohonan = presensi::whereUserId($user->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->where(function ($query) {
                                    $query->where('keterangan', 'masuk')
                                            ->orWhere('keterangan', 'telat');
                                            })->count();       
                    
        $totalJamTelat = 0;
        foreach ($kehadiran as $present) {
            $totalJamTelat = $totalJamTelat + (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse(config('absensi.jam_masuk') .' -1 hours')));
        }
        // $url = 'https://kalenderindonesia.com/api/YZ35u6a7sFWN/libur/masehi/'.date('Y/m');
        // $kalender = file_get_contents($url);
        // $kalender = json_decode($kalender, true);
        // $libur = false;
        // $holiday = null;
        // if ($kalender['data'] != false) {
        //     if ($kalender['data']['holiday']['data']) {
        //         foreach ($kalender['data']['holiday']['data'] as $key => $value) {
        //             if ($value['date'] == date('Y-m-d')) {
        //                 $holiday = $value['name'];
        //                 $libur = true;
        //                 break;
        //             }
        //         }
        //     }
        // }
        return view('template.backend.admin.profil-user.index', compact('presents', 'user', 'masuk', 'telat', 'cuti', 'alpha', 'totalJamTelat', 'gantijaga', 'tukarjaga', 'permohonan','lembur','izin'));
        // return view('frontend.users.show', compact('presents', 'user', 'masuk', 'telat', 'cuti', 'alpha', 'totalJamTelat', 'gantijaga', 'tukarjaga', 'permohonan','lembur','izin'));
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
        $gantijaga = rubahjadwal::whereUserId(auth()->user()->id)
                                ->whereMonth('tanggal', $data[1])
                                ->whereYear('tanggal', $data[0])
                                ->where('status', 'approve')
                                ->where('permohonan', 'ganti_jaga')
                                ->count();
        $tukarjaga = rubahjadwal::whereUserId(auth()->user()->id)
                                ->whereMonth('tanggal', $data[1])
                                ->whereYear('tanggal', $data[0])
                                ->where('status', 'approve')
                                ->where('permohonan', 'tukar_jaga')
                                ->count();
        $lembur = rubahjadwal::whereUserId(auth()->user()->id)
                                ->whereMonth('tanggal', $data[1])
                                ->whereYear('tanggal', $data[0])
                                ->where('status', 'approve')
                                ->where('permohonan', 'lembur')
                                ->count();
        $permohonan = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',$data[1])->whereYear('tanggal',$data[0])->where(function ($query) {
                    $query->where('keterangan', 'masuk')
                            ->orWhere('keterangan', 'telat');
                            })->count();
        return view('backend.admin.show', compact('presents','masuk','telat','cuti','alpha','gantijaga','tukarjaga','permohonan','lembur'));
    }

    public function checkIn(Request $request)
    {
        $user = Auth::user();
        // Cek jadwal pengguna
        $tanggalSekarang = date('j'); // Tanggal hari ini (1-31)
        $bulanSekarang = date('F'); // Nama bulan saat ini (e.g., "September")
        // Cek alamat IP pengguna
        // $userIpAddress = request()->ip(); // Dapatkan alamat IP pengguna saat ini
        // $allowedIpAddress = config('absensi.ip_internet'); // Gantilah dengan alamat IP yang sesuai

        // if ($userIpAddress !== $allowedIpAddress) {
        //     return back()->with('error', 'OOpppss !! Alamat IP Anda tidak' .$userIpAddress. 'valid untuk melakukan absen.');
        // }
        $jadwal = jadwalterbaru::where('user_id', $user->id)
            ->where('masa_aktif', '<=', date('Y-m-d'))
            ->where('masa_akhir', '>=', date('Y-m-d'))
            ->first();

        if ($jadwal) {
            $namaKolom = 'j' . $tanggalSekarang;
            $statusHariIni = $jadwal->$namaKolom;
            //absen SM
            if (in_array($statusHariIni, ['SM'])) {
                $userIpAddress = request()->ip();
                $allowedIpAddress = config('absensi.ip_internet');

                if ($userIpAddress !== $allowedIpAddress) {
                    return back()->with('error', 'OOpppss !! Alamat IP Anda ' . $userIpAddress . ' tidak valid untuk melakukan absen. Silahkan hubungkan internet anda ke wifi TP-LINK_BB3588');
                }
                $currentDate = date('Y-m-d');
                $currentTime = date('H:i');
                $user_id = $user->id;
                $attendanceStatus = 'Telat';
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
                $userIpAddress = request()->ip();
                $allowedIpAddress = config('absensi.ip_internet');

                if ($userIpAddress !== $allowedIpAddress) {
                    return back()->with('error', 'OOpppss !! Alamat IP Anda ' . $userIpAddress . ' tidak valid untuk melakukan absen. Silahkan hubungkan internet anda ke wifi TP-LINK_BB3588');
                }
                $currentDate = date('Y-m-d');
                $currentTime = date('H:i');
                $user_id = $user->id;
                $attendanceStatus = 'Telat';
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
                $userIpAddress = request()->ip();
                $allowedIpAddress = config('absensi.ip_internet');

                if ($userIpAddress !== $allowedIpAddress) {
                    return back()->with('error', 'OOpppss !! Alamat IP Anda ' . $userIpAddress . ' tidak valid untuk melakukan absen. Silahkan hubungkan internet anda ke wifi TP-LINK_BB3588');
                }
                $currentDate = date('Y-m-d');
                $currentTime = date('H:i');
                $user_id = $user->id;
                $attendanceStatus = 'Telat';
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
            }else if ($statusHariIni === 'LL') {
                $userIpAddress = request()->ip();
                $allowedIpAddress = config('absensi.ip_internet');

                if ($userIpAddress !== $allowedIpAddress) {
                    return back()->with('error', 'OOpppss !! Alamat IP Anda ' . $userIpAddress . ' tidak valid untuk melakukan absen. Silahkan hubungkan internet anda ke wifi TP-LINK_BB3588');
                }
                $currentDate = date('Y-m-d');
                $currentTime = date('H:i');
                $user_id = $user->id;
                $attendanceStatus = 'Telat';
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
                $userIpAddress = request()->ip();
                $allowedIpAddress = config('absensi.ip_internet');

                if ($userIpAddress !== $allowedIpAddress) {
                    return back()->with('error', 'OOpppss !! Alamat IP Anda ' . $userIpAddress . ' tidak valid untuk melakukan absen. Silahkan hubungkan internet anda ke wifi TP-LINK_BB3588');
                }

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
                $userIpAddress = request()->ip();
                $allowedIpAddress = config('absensi.ip_internet');

                if ($userIpAddress !== $allowedIpAddress) {
                    return back()->with('error', 'OOpppss !! Alamat IP Anda ' . $userIpAddress . ' tidak valid untuk melakukan absen. Silahkan hubungkan internet anda ke wifi TP-LINK_BB3588');
                }

                // $ipke2 = request()->ip();
                // $accIpke2 = config('absensi.ip_internet_ke2');
                // if($ipke2 !== $accIpke2){
                //     return redirect()->back()->with('error','OOppss !! Alamat Ip Anda '. $ipke2 . ' tidak valid untuk melakukan absen. Silahkan hubungkan internet anda ke wifi Klinik Mitra Delima');
                // }
                // $ipke3 = request()->ip();
                // $accIpke3 = config('absensi.ip_internet_ke3');
                // if($ipke3 !== $accIpke3){
                //     return redirect()->back()->with('error','OOppss !! Alamat Ip Anda '. $ipke3 . ' tidak valid untuk melakukan absen. Silahkan hubungkan internet anda ke wifi Klinik Mitra Delima');
                // }

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
                $userIpAddress = request()->ip();
                $allowedIpAddress = config('absensi.ip_internet');

                if ($userIpAddress !== $allowedIpAddress) {
                    return back()->with('error', 'OOpppss !! Alamat IP Anda ' . $userIpAddress . ' tidak valid untuk melakukan absen. Silahkan hubungkan internet anda ke wifi TP-LINK_BB3588');
                }

                // $ipke2 = request()->ip();
                // $accIpke2 = config('absensi.ip_internet_ke2');
                // if($ipke2 !== $accIpke2){
                //     return redirect()->back()->with('error','OOppss !! Alamat Ip Anda '. $ipke2 . ' tidak valid untuk melakukan absen. Silahkan hubungkan internet anda ke wifi Klinik Mitra Delima');
                // }
                // $ipke3 = request()->ip();
                // $accIpke3 = config('absensi.ip_internet_ke3');
                // if($ipke3 !== $accIpke3){
                //     return redirect()->back()->with('error','OOppss !! Alamat Ip Anda '. $ipke3 . ' tidak valid untuk melakukan absen. Silahkan hubungkan internet anda ke wifi Klinik Mitra Delima');
                // }

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
                return redirect()->back()->with('error', 'Absen tidak diizinkan untuk hari ini.');
            }
        } else {
            return redirect()->back()->with('error', 'Jadwal anda dihari ini tidak ditemukan.');
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
        // $present = presensi::whereUserId($request->user_id)->whereTanggal(date('Y-m-d'))->first();
        $present = presensi::where('user_id', $request->user_id)
                   ->where('tanggal', $request->tanggal)
                   ->first();
        if ($present) {
            return redirect()->back()->with('error','Absensi di tanggal tersebut telah terisi');
        }
        $data = $request->validate([
            'tanggal' => 'required',
            'keterangan'    => ['required'],
            'user_id'    => ['required'],
            'jam_masuk' => ['nullable', 'date_format:H:i'],
            'jam_keluar' => ['nullable', 'date_format:H:i'],

        ]);
        // $data['tanggal'] = date('Y-m-d');
        $data['tanggal'] = $request->tanggal;
        // if ($request->keterangan == 'Masuk' || $request->keterangan == 'Telat') {
        //     $data['jam_masuk'] = $request->jam_masuk;
        //     if (strtotime($data['jam_masuk']) >= strtotime(config('absensi.jam_masuk') .' -1 hours') && strtotime($data['jam_masuk']) <= strtotime(config('absensi.jam_masuk'))) {
        //         $data['keterangan'] = 'Masuk';
        //     } else if (strtotime($data['jam_masuk']) > strtotime(config('absensi.jam_masuk')) && strtotime($data['jam_masuk']) <= strtotime(config('absensi.jam_keluar'))) {
        //         $data['keterangan'] = 'Telat';
        //     } else {
        //         $data['keterangan'] = 'Alpha';
        //     }
        // }elseif($request->keterangan == 'Izin'){
        //     $data['keterangan'] = 'Izin';
        // }
        if ($request->keterangan == 'Masuk' || $request->keterangan == 'Telat') {
            $data['keterangan'] = $request->keterangan;
            $data['jam_masuk'] = $request->jam_masuk; // Memasukkan jam masuk ke dalam data
        } elseif ($request->keterangan == 'Izin' || $request->keterangan == 'Cuti') {
            $data['keterangan'] = $request->keterangan;
        } else {
            $data['keterangan'] = 'Alpha'; // Ketika tidak ada keterangan yang cocok
        }
        
        presensi::create($data);
        return redirect()->back()->with('success','Kehadiran berhasil ditambahkan');
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
        $lembur = rubahjadwal::whereUserId(auth()->user()->id)
                            ->whereMonth('tanggal', date('m'))
                            ->whereYear('tanggal', date('Y'))
                            ->where('permohonan', 'lembur')
                            ->count();
        $permohonan = presensi::whereUserId(auth()->user()->id)->whereMonth('tanggal',date('m'))->whereYear('tanggal',date('Y'))->where(function ($query) {
            $query->where('keterangan', 'masuk')
                    ->orWhere('keterangan', 'telat');
                    })->count();       
                    
        // return $permohonan;
        return view('backend.admin.show', compact('presents','masuk','telat','cuti','alpha','gantijaga','tukarjaga','permohonan','lembur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Present  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function ubah(Request $request)
    {
        $present = presensi::find($request->id);
        echo json_encode($present);
    }

    public function update(Request $request, presensi $kehadiran)
    {
        $data = $request->validate([
            'tanggal' => 'required',
            'keterangan' => ['required'],
            'jam_masuk' => ['nullable', 'date_format:H:i'],
            'jam_keluar' => ['nullable', 'date_format:H:i'],
        ]);
        if ($data['keterangan'] === 'Masuk' || $data['keterangan'] === 'Telat') {
            $data['tanggal'] = $request->tanggal;
            if ($request->jam_masuk) {
                $data['jam_masuk'] = $request->jam_masuk;
            } else {
                $data['keterangan'] = 'Alpha';
            }
        }elseif($data['keterangan']=== 'Izin'){
            $data['keterangan'] = 'Izin';
        } else {
            $data['jam_masuk'] = null;
            $data['jam_keluar'] = null;
        }
    
        $kehadiran->update($data);
    
        return redirect()->back()->with('success', 'Kehadiran tanggal "' . date('l, d F Y', strtotime($kehadiran->tanggal)) . '" berhasil diubah');
    
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

    public function DownloadPerUser(Request $request, User $user)
    {
        $request->validate([
            'bulan' => ['required']
        ]);
        $data = explode('-', $request->bulan);

        $presents = presensi::whereUserId($user->id)
            ->whereMonth('tanggal', $data[1])
            ->whereYear('tanggal', $data[0])
            ->orderBy('tanggal', 'asc')
            ->get();

        $pdf = PDF::loadView('frontend.users.userpresensi', compact('presents', 'user'));
        return $pdf->download('Presensi-per-user.pdf');
    }
    public function delete($id)
    {
        // Cari presensi berdasarkan $id
        $present = presensi::find($id);
        // Periksa apakah presensi ditemukan
        if (!$present) {
            return redirect()->back()->with('error', 'Data presensi tidak ditemukan');
        }
        // Hapus presensi jika ditemukan
        $present->delete();
        return redirect()->back()->with('success', 'Data presensi berhasil dihapus.');
    }        
}