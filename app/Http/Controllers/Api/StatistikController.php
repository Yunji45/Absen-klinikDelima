<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DetailPegawai;
use App\Models\JumlahAnak;

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
            // 'ADMINISTRASI' => $admin,
            // 'UMUM' => $umum,
            // 'RUMAH TANGGA' => $IRT,
        ];
        // return $dokter;
        return response()->json($nakes);
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
        return response()->json($NonNakes);

    }

    public function StatistikGender()
    {
        $perempuan = DetailPegawai::where('gender','Perempuan')->count();
        $laki_laki = DetailPegawai::where('gender','Laki-Laki')->count();
        $gender = [
            'Perempuan' => $perempuan,
            'Laki-Laki' => $laki_laki,
        ];
        return response()->json($gender);
    }

    public function StatistikStatusPekerjaan()
    {

    }
//ramah,cekatan,solutif
//disiplin, tanggung jawab,jujur
//kompeten = terampil, mau belajar , tugas baik
//harmonis = suka menolong, menghargai,Jaga kondusif
//Loyal = setia, jaga nama baik, jaga rahasia
//Adaptif = kreatif, inovatif/proaktif, antusias
//kolaboratif = kerjasama tim, kompak , motivator
    public function StatistikEducation()
    {

    }
}
