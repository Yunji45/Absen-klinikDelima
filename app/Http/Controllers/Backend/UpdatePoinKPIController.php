<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kpi;
use App\Models\User;
use App\Models\jadwalterbaru;
use App\Models\presensi;
use App\Models\targetkpi;
use App\Models\AchKpi;
use App\Models\InsentifKpi;
use App\Models\OmsetKlinik;
use App\Models\rubahjadwal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use PDF;


class UpdatePoinKPIController extends Controller
{
    public function updateRealisasi(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bulan' => 'required',
        ],[
            'bulan.required' => 'Bulan tidak boleh kosong',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
        //hanya berlaku untuk Ach
        $month = date('m');
        $tahun = date('Y');
        $tanggalawal = $tahun . '-' . $month . '-01';
        $tanggalakhir = $tahun . '-' . $month . '-31';
        //hanya berlaku untuk realisasi
        $bulan = $request->bulan;
        $bulanawal = $tahun . '-' . $bulan . '-01';
        $bulanakhir = $tahun . '-' . $bulan . '-31';

        $userIds = targetkpi::where('bulan', '>=', $bulanawal)
                            ->where('bulan', '<=', $bulanakhir)
                            ->pluck('user_id');

        if ($userIds->isEmpty()) {
            return redirect()->back()->with('error', 'Data KPI Tidak Ditemukan.');
        }
        $targetData = AchKpi::where(function ($query) use ($tanggalawal, $tanggalakhir) {
                                $query->where('start_date', '<=', $tanggalakhir)
                                    ->where('end_date', '>=', $tanggalawal);
                            })
                                ->select('daftar', 'poli', 'farmasi', 'bpjs', 'kasir', 'care', 'khitan', 'rawat', 'salin', 'lab', 'umum', 'visit')
                                ->first();

        $data = [];
        if ($targetData) {
            foreach ($userIds as $user) {
                $realisasi = targetkpi::where('user_id', $user)
                ->where('bulan', '>=', $bulanawal)
                ->where('bulan', '<=', $bulanakhir)
                ->select('target_id','bulan',
                    'r_daftar', 'r_poli', 'r_farmasi', 'r_kasir', 'r_care', 'r_bpjs',
                    'r_khitan', 'r_rawat', 'r_salin', 'r_lab', 'r_umum', 'r_visit'
                )
                ->first();

                if ($realisasi) {
                    $rowData = [
                        'user_id' => $user,
                        'target_id' => $realisasi->target_id,
                        'bulan' => $realisasi->bulan,
                        'r_daftar' => $realisasi->r_daftar,
                        'r_poli' => $realisasi->r_poli,
                        'r_farmasi' => $realisasi->r_farmasi,
                        'r_kasir' => $realisasi->r_kasir,
                        'r_care' => $realisasi->r_care,
                        'r_bpjs' => $realisasi->r_bpjs,
                        'r_khitan' => $realisasi->r_khitan,
                        'r_rawat' => $realisasi->r_rawat,
                        'r_salin' => $realisasi->r_salin,
                        'r_lab' => $realisasi->r_lab,
                        'r_umum' => $realisasi->r_umum,
                        'r_visit' => $realisasi->r_visit,
                        // 'created_at' => now(),
                        // 'update_at' => now(),
                    ];
                    $columns = ['daftar', 'poli', 'farmasi', 'bpjs', 'kasir', 'care', 'khitan', 'rawat', 'salin', 'lab', 'umum', 'visit'];

                    foreach ($columns as $column) {
                        $r_column = 'r_' . $column;
                        $c_column = 'c_' . $column;
                    
                        if ($realisasi->$r_column === null || $realisasi->$r_column === 0) {
                            $rowData[$r_column] = 0;
                            $rowData[$c_column] = 0;
                        } elseif ($targetData->$column != 0) {
                            $total = $realisasi->$r_column / $targetData->$column;
                    
                            if ($total > 1) {
                                $rowData[$c_column] = 3;
                            } elseif ($total == 1) {
                                $rowData[$c_column] = 2;
                            } elseif ($total < 1) {
                                $rowData[$c_column] = 1;
                            }elseif ($total === 0) { 
                                $rowData[$c_column] = 0;
                            } elseif ($total >= 0 || $total === null) {
                                $rowData[$c_column] = 0;
                            } else {
                                // Handling untuk kasus lain (opsional)
                            }
                        } else {
                            $rowData[$c_column] = 0;
                        }
                    }
                    
                    $data[] = $rowData;    
                }
            }
            if (!empty($data)) {
                // return $data;
                foreach ($data as $rowData) {
                    $userId = $rowData['user_id'];

                    targetkpi::where('user_id', $userId)
                        ->where('bulan', '>=', $bulanawal)
                        ->where('bulan', '<=', $bulanakhir)
                        ->update($rowData);
                }

                return redirect()->back()->with('success', 'Terimakasih, Data Realisasi Berhasil Diupdate.');
            }
        } else {
            // Handle request jika $targetData tidak ditemukan
            return redirect()->back()->with('error', 'Data Target Pada Periode Tersebut Tidak Ditemukan.');
        }
    }

    public function updateEvaluasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => 'required',
        ], [
            'bulan.required' => 'kolom bulan wajib di isi',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }
    
        //hanya berlaku untuk target realisasi
        $month = date('m');
        $tahun = date('Y');
        $tanggalawal = $tahun . '-' . $month . '-01';
        $tanggalakhir = $tahun . '-' . $month . '-31';
        //hanya berlaku untuk evaluasi
        $bulan = $request->bulan;
        $bulanawal = $tahun . '-' . $bulan . '-01';
        $bulanakhir = $tahun . '-' . $bulan . '-31';

        $userIds = kpi::where('bulan', '>=', $bulanawal)
            ->where('bulan', '<=', $bulanakhir)
            ->pluck('user_id');
    
        if ($userIds->isEmpty()) {
            return redirect()->back()->with('error', 'Data KPI Tidak Ditemukan.');
        }
    
        $data = [];
        $usersWithoutRealization = [];
        foreach ($userIds as $user) {
            $targetData = targetkpi::where('user_id', $user)
                ->where('bulan', '>=', $tanggalawal)
                ->where('bulan', '<=', $tanggalakhir)
                ->select('user_id', 'c_daftar', 'c_poli', 'c_farmasi', 'c_bpjs', 'c_kasir', 'c_care', 'c_khitan', 'c_rawat', 'c_salin', 'c_lab', 'c_umum', 'c_visit')
                ->first();
    
            $kpi = kpi::where('user_id', $user)
                ->where('bulan', '>=', $bulanawal)
                ->where('bulan', '<=', $bulanakhir)
                ->select('bulan','div', 'jabatan', 'nama_atasan', 'div_atasan', 'jabatan_atasan', 'daftar', 'poli', 'farmasi', 'kasir', 'care', 'bpjs', 'khitan', 'rawat', 'persalinan', 'lab', 'umum', 'visit', 'layanan', 'akuntan', 'kompeten', 'harmonis', 'loyal', 'adaptif', 'kolaboratif', 'absen')
                ->first();
    
            if ($kpi && $targetData) {
                $jumlahNonZero = count(array_filter([
                    $kpi->daftar,
                    $kpi->poli,
                    $kpi->farmasi,
                    $kpi->kasir,
                    $kpi->bpjs,
                    $kpi->care,
                    $kpi->khitan,
                    $kpi->rawat,
                    $kpi->persalinan,
                    $kpi->lab,
                    $kpi->umum,
                    $kpi->visit,
                    $kpi->layanan,
                    $kpi->akuntan,
                    $kpi->kompeten,
                    $kpi->harmonis,
                    $kpi->loyal,
                    $kpi->adaptif,
                    $kpi->kolaboratif,
                    $kpi->absen,
                ], function ($value) {
                    return $value != 0;
                }));
                $total =$kpi->daftar+$kpi->kompeten;

                    // ($kpi->daftar ?? 0) + ($kpi->poli ?? 0) + ($kpi->farmasi ?? 0) +
                    // ($kpi->kasir ?? 0) + ($kpi->care ?? 0) + ($kpi->bpjs ?? 0) +
                    // ($kpi->khitan ?? 0) + ($kpi->rawat ?? 0) + ($kpi->persalinan ?? 0) +
                    // ($kpi->lab ?? 0) + ($kpi->umum ?? 0) + ($kpi->visit ?? 0) +
                    // ($kpi->layanan ?? 0) + ($kpi->akuntan ?? 0) + ($kpi->kompeten ?? 0) +
                    // ($kpi->harmonis ?? 0) + ($kpi->loyal ?? 0) + ($kpi->adaptif ?? 0) +
                    // ($kpi->kolaboratif ?? 0) + ($kpi->absen ?? 0);

                $total_kinerja = 0; // Default value jika $kpi->target adalah 0
                $total_kinerja = $total / $jumlahNonZero;
                    if ($total_kinerja == 1) {
                        $ket = 'Sesuai';
                    } elseif ($total_kinerja >= 1) {
                        $ket = 'Melampaui';
                    } else {
                        $ket = 'Dibawah';
                    }
                
                $rowData= [
                    'user_id' => $user,
                    'bulan' => $kpi->bulan,
                    'target' => $jumlahNonZero,
                    'div' => $kpi->div,
                    'jabatan' => $kpi->jabatan,
                    'nama_atasan' => $kpi->nama_atasan,
                    'div_atasan' => $kpi->div_atasan,
                    'jabatan_atasan' => $kpi->jabatan_atasan,
                    'daftar' => $targetData->c_daftar,
                    'poli' => $targetData->c_poli,
                    'farmasi' => $targetData->c_farmasi,
                    'kasir' => $targetData->c_kasir,
                    'care' => $targetData->c_care,
                    'bpjs' => $targetData->c_bpjs,
                    'khitan' => $targetData->c_khitan,
                    'rawat' => $targetData->c_rawat,
                    'persalinan' => $targetData->c_salin,
                    'lab' => $targetData->c_lab,
                    'umum' => $targetData->c_umum,
                    'visit' => $targetData->c_visit,
                    'layanan' => $kpi->layanan,
                    'akuntan' => $kpi->akuntan,
                    'kompeten' => $kpi->kompeten,
                    'harmonis' => $kpi->harmonis,
                    'loyal' => $kpi->loyal,
                    'adaptif' => $kpi->adaptif,
                    'kolaboratif' => $kpi->kolaboratif,
                    'absen' => $kpi->absen,
                    'total' => $total,
                    'total_kinerja' => $total_kinerja,
                    'ket' => $ket,
                ];
                $data[] = $rowData;
            }else{
                // return redirect()->back()->with('error','Data Realisasi Tidak Ada Pada Bulan Ini.');
                $userData = User::find($user);
                if ($userData) {
                    $usersWithoutRealization[] = $userData->name;
                }
            }
        }
        if (!empty($usersWithoutRealization)) {
            $error_message = 'Data Realisasi Tidak Ada Pada Bulan Terpilih untuk pengguna: ' . implode(', ', $usersWithoutRealization);
            return redirect()->back()->with('error', $error_message);
        }
        // return $data;    
        if (!empty($data)) {
            return $data;
            // return redirect()->back()->with('success', 'Terimakasih, Data Realisasi Berhasil Disimpan.');
        }
    }
}
