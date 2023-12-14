<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailPegawai;
use App\Models\JumlahAnak;
use Illuminate\Support\Facades\DB;


class StatistikController extends Controller
{
    public function StatistikNakes()
    {
        $dokter = DetailPegawai::where('position','DOKTER')->count();
        $perawat = DetailPegawai::where('position','PERAWAT')->count();
        $bidan = DetailPegawai::where('position','BIDAN')->count();
        $apoteker = DetailPegawai::where('position','APOTEKER')->count();
        $ast_apoteker = DetailPegawai::where('position','Ast.APOTEKER')->count();
        $analys = DetailPegawai::where('position','ANALYS LAB')->count();
        $nutrisi = DetailPegawai::where('position','NUTRISIONIS')->count();

        $nakes = [
            'DOKTER' => $dokter,
            'PERAWAT' => $perawat,
            'BIDAN' => $bidan,
            'APOTEKER' => $apoteker,
            'Ast.APOTEKER' => $ast_apoteker,
            'ANALYS LAB' => $analys,
            'NUTRISIONIS' => $nutrisi,
        ];
        if ($nakes) {
            return response()->json([
                'data' => $nakes,
                'status' => 'success',
                'message' => 'Operasi berhasil dilakukan',
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam melakukan operasi',
            ],401);
        }    
    }

    public function StatistikNonNakes()
    {
        $admin = DetailPegawai::where('position','ADMINISTRASI')->count();
        $umum = DetailPegawai::where('position','UMUM')->count();
        $IRT = DetailPegawai::where('position','RUMAH TANGGA')->count();
        $NonNakes = [
            'ADMINISTRASI' => $admin,
            'UMUM' => $umum,
            'RUMAH TANGGA' => $IRT,
        ];
        if ($NonNakes) {
            return response()->json([
                'data' => $NonNakes,
                'status' => 'success',
                'message' => 'Operasi berhasil dilakukan',
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam melakukan operasi',
            ],401);
        }    
    }

    public function StatistikGender()
    {
        // $perempuan = DetailPegawai::where('gender','Perempuan')->count();
        // $laki_laki = DetailPegawai::where('gender','Laki-Laki')->count();
        // $gender = [
        //     'Perempuan' => $perempuan,
        //     'Laki-Laki' => $laki_laki,
        // ];
        // if ($gender) {
        //     return response()->json([
        //         'data' => $gender,
        //         'status' => 'success',
        //         'message' => 'Operasi berhasil dilakukan',
        //     ],200);
        // } else {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Terjadi kesalahan dalam melakukan operasi',
        //     ],401);
        // }    
        $genderByYear = DB::table('detail_pegawais')
        ->selectRaw('date_format(created_at, "%Y") as year, gender, count(*) as count')
        ->groupBy('year', 'gender')
        ->get();

        // Mengelompokkan data berdasarkan tahun dan jenis kelamin
        $genderData = [];
        foreach ($genderByYear as $data) {
            $year = $data->year;
            $gender = $data->gender;
            $count = $data->count;

            if (!isset($genderData[$year])) {
                $genderData[$year] = ['Laki-Laki' => 0, 'Perempuan' => 0];
            }

            $genderData[$year][$gender] += $count;
        }
        if ($genderData) {
            return response()->json([
                'data' => $genderData,
                'status' => 'success',
                'message' => 'Operasi berhasil dilakukan',
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam melakukan operasi',
            ],401);
        }    
    }

    public function StatistikStatusPekerjaan()
    {
        $tetap = DetailPegawai::where('status_pekerjaan','TETAP')->count();
        $kontrak = DetailPegawai::where('status_pekerjaan','KONTRAK')->count();
        $status = [
            'KONTRAK' => $kontrak,
            'TETAP' => $tetap,
        ];
        if ($status) {
            return response()->json([
                'data' => $status,
                'status' => 'success',
                'message' => 'Operasi berhasil dilakukan',
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam melakukan operasi',
            ],401);
        }
    }

    public function StatistikEducation()
    {
        $S2 = DetailPegawai::where('education','S2')->count();
        $S1_Nakes = DetailPegawai::where('education','S1 Kesehatan')->count();
        $S1_NonNakes = DetailPegawai::where('education','S1 Non Kesehatan')->count();
        $D3_Nakes = DetailPegawai::where('education','D3 Kesehatan')->count();
        $D3_NonNakes = DetailPegawai::where('education','D3 Non Kesehatan')->count();
        $SLTA_Nakes = DetailPegawai::where('education','SLTA Kesehatan')->count();
        $SLTA_NonNakes = DetailPegawai::where('education','SLTA Non Kesehatan')->count();
        $Dibawah_SLTA = DetailPegawai::where('education','Dibawah SLTA')->count();
        $education = [
            'S2' => $S2,
            'S1 Kesehatan' => $S1_Nakes,
            'S1 Non Kesehatan' => $S1_NonNakes,
            'D3 Kesehatan' => $D3_Nakes,
            'D3 Non Kesehatan' => $D3_NonNakes,
            'SLTA Kesehatan' => $SLTA_Nakes,
            'SLTA Non Kesehatan' => $SLTA_NonNakes,
            'Dibawah SLTA' => $Dibawah_SLTA,
        ];

        if ($education) {
            return response()->json([
                'data' => $education,
                'status' => 'success',
                'message' => 'Operasi berhasil dilakukan',
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam melakukan operasi',
            ],401);
        }
    }
}
