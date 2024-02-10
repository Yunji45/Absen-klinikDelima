<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\jadwalterbaru;
use App\Models\presensi;
use App\Models\cuti;

class AbsensiCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absen:otomatis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'melakukan absen otomatis';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $currentDay = date('j');
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i');
        $currentDaySchedule = ['PM', 'SM', 'PS', 'L1', 'L2'];

        $usersWithSchedule = jadwalterbaru::whereIn('j' . $currentDay, $currentDaySchedule)->get();

        foreach ($usersWithSchedule as $userWithSchedule) {
            $user_id = $userWithSchedule->user_id;

            $existingAttendance = presensi::where('user_id', $user_id)
                ->where('tanggal', $currentDate)
                ->exists();

            $izin = cuti::where('user_id', $user_id)
                ->where('tanggal_mulai', '<=', $currentDate)
                ->where('tanggal_berakhir', '>=', $currentDate)
                ->where('status', 'approve')
                ->first();

            if ($izin) {
                switch ($izin->jenis_izin) {
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
                    default:
                        $keterangan = 'Alpha';
                        break;
                }

                $dataAbsensi = [
                    'user_id' => $user_id,
                    'keterangan' => $keterangan,
                    'tanggal' => $currentDate,
                    'jam_masuk' => null,
                    'jam_keluar' => null,
                ];

                presensi::create($dataAbsensi);
                $this->info('Absen otomatis berhasil untuk pengguna dengan ID ' . $user_id);
            }

            // Logika tambahan dapat ditambahkan untuk penanganan kehadiran yang sudah ada jika diperlukan.
        }

        $this->info('Proses absen otomatis selesai.');

    }
}
