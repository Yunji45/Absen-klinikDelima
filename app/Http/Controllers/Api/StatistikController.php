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
        $nakes = DetailPegawai::where('position','DOKTER')->count();
        return $nakes;
    }

    public function StatistikNonNakes()
    {

    }

    public function StatistikGender()
    {

    }

    public function StatistikStatusPekerjaan()
    {

    }

    public function StatistikEducation()
    {

    }
}
