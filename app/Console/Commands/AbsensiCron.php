<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\jadwalterbaru;
use App\Models\presensi;

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
        // return Command::SUCCESS;
        // Ambil semua pengguna yang memiliki jadwal PM, SM, atau PS di jadwalterbaru
        // $usersWithSchedule = jadwalterbaru::where(function ($query) {
        //     $currentDay = date('j');
        //     $currentDaySchedule = ['PM', 'SM', 'PS'];
        //     $query->where('j' . $currentDay, $currentDaySchedule[0])
        //         ->orWhere('j' . $currentDay, $currentDaySchedule[1])
        //         ->orWhere('j' . $currentDay, $currentDaySchedule[2]);
        // })->get();

        // foreach ($usersWithSchedule as $userWithSchedule) {
        //     $currentDate = date('Y-m-d');
        //     $currentTime = date('H:i');
        //     $user_id = $userWithSchedule->user_id;
        //     // Periksa apakah pengguna sudah absen hari ini
        //     $existingAttendance = presensi::where('user_id', $user_id)
        //         ->where('tanggal', $currentDate)
        //         ->first();

        //     if (!$existingAttendance) {
        //         // Lakukan absen otomatis jika belum absen
        //         $attendanceData = [
        //             'user_id' => $user_id,
        //             'keterangan' => 'Alpha',
        //             'tanggal' => $currentDate,
        //             'jam_masuk' => null,
        //             'jam_keluar' => null,
        //         ];

        //         presensi::create($attendanceData);
        //         $this->info('Absen otomatis berhasil untuk pengguna dengan ID ' . $user_id);
        //     }
        // }

        // $this->info('Proses absen otomatis selesai.');
        $currentDay = date('j');
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i');
        $currentDaySchedule = ['PM', 'SM', 'PS', 'L1', 'L2'];
        
        // Ambil pengguna dengan jadwal sesuai pada tanggal saat ini
        $usersWithSchedule = jadwalterbaru::where('j' . $currentDay, $currentDaySchedule[0])
            ->orWhere('j' . $currentDay, $currentDaySchedule[1])
            ->orWhere('j' . $currentDay, $currentDaySchedule[2])
            ->orWhere('j' . $currentDay, $currentDaySchedule[3])
            ->orWhere('j' . $currentDay, $currentDaySchedule[4])
            ->get();
        
        foreach ($usersWithSchedule as $userWithSchedule) {
            $user_id = $userWithSchedule->user_id;
        
            // Periksa apakah pengguna sudah absen hari ini
            $existingAttendance = presensi::where('user_id', $user_id)
                ->where('tanggal', $currentDate)
                ->first();
        
            if (!$existingAttendance) {
                // Periksa apakah jadwal pengguna adalah 'L1' atau 'L2'
                $schedule = 'j' . $currentDay;
                $userSchedule = $userWithSchedule->$schedule;
        
                if ($userSchedule !== 'L1' && $userSchedule !== 'L2') {
                    // Lakukan absen otomatis jika belum absen
                    $attendanceData = [
                        'user_id' => $user_id,
                        'keterangan' => 'Alpha',
                        'tanggal' => $currentDate,
                        'jam_masuk' => null,
                        'jam_keluar' => null,
                    ];
        
                    presensi::create($attendanceData);
                    $this->info('Absen otomatis berhasil untuk pengguna dengan ID ' . $user_id);
                }
            }
        }
        
        $this->info('Proses absen otomatis selesai.');
    }
}
