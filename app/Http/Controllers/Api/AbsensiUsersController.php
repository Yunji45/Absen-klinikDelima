<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\presensi;
use Carbon\Carbon;
use Auth;

class AbsensiUsersController extends Controller
{
    public function get_absensi_users(Request $request)
    {
        $users = $request->input('user_id');
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->endOfMonth()->toDateString();

        $presensis = Presensi::with('user')
                            ->where('user_id', $users)
                            ->whereBetween('tanggal', [$startDate, $endDate])
                            ->select('keterangan', 'tanggal')
                            ->get();
        $formattedData = [
            'Masuk' => [],
            'Alpha' => [],
            'Telat' => [],
            'Sakit' => [],
            'Cuti' => [],
            'Izin' => []
        ];

        foreach ($presensis as $presensi) {
            $value = 0;
            switch ($presensi->keterangan) {
                case 'Masuk':
                    $value = 100;
                    break;
                case 'Alpha':
                    $value = 90;
                    break;
                case 'Telat':
                    $value = 80;
                    break;
                case 'Sakit':
                    $value = 70;
                    break;
                case 'Cuti':
                    $value = 60;
                    break;
                case 'Izin':
                    $value = 50;
                    break;
            }

            $formattedData[$presensi->keterangan][] = [
                'date' => (new \DateTime($presensi->tanggal))->format('Y-m-d'),
                'value' => $value
            ];
        }

        return response()->json($formattedData);


    }
    
}
