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
        $usersWithSchedule = jadwalterbaru::where(function ($query) {
            $query->where('j' . date('j'), 'PM')
                  ->orWhere('j' . date('j'), 'SM')
                  ->orWhere('j' . date('j'), 'PS');
        })->get();

        foreach ($usersWithSchedule as $userWithSchedule) {
            $currentDate = date('Y-m-d');
            $currentTime = date('H:i');
            $user_id = $userWithSchedule->user_id;

            // Cek apakah pengguna sudah melakukan absen antara tanggal 1 Oktober dan 2 Oktober
                $startDate = '2023-10-01'; // Tanggal 1 Oktober
                $endDate = '2023-10-02';   // Tanggal 2 Oktober
                
                // Cek apakah pengguna sudah melakukan absen pada tanggal 1 Oktober
                $attendance1st = presensi::where('user_id', $user_id)
                    ->where('tanggal', '=', $startDate)
                    ->first();
                
                // Cek apakah pengguna sudah melakukan absen pada tanggal 2 Oktober
                $attendance2nd = presensi::where('user_id', $user_id)
                    ->where('tanggal', '=', $endDate)
                    ->first();
                
                if (!$attendance1st) {
                    // Pengguna belum melakukan absen pada tanggal 1 Oktober
                    // Lakukan absen otomatis dengan keterangan "Alpha" pada tanggal 1 Oktober
                    $attendanceData1st = [
                        'user_id' => $user_id,
                        'keterangan' => 'Alpha',
                        'tanggal' => $startDate,
                        'jam_masuk' => null,
                        'jam_keluar' => null,
                    ];
                
                    presensi::create($attendanceData1st);
                
                    // Tambahkan pesan sukses atau log jika diperlukan
                    $this->info('Absen otomatis Alpha berhasil untuk pengguna dengan ID ' . $user_id . ' pada tanggal 1 Oktober.');
                }
                
                if (!$attendance2nd) {
                    // Pengguna belum melakukan absen pada tanggal 2 Oktober
                    // Lakukan absen otomatis dengan keterangan "Alpha" pada tanggal 2 Oktober
                    $attendanceData2nd = [
                        'user_id' => $user_id,
                        'keterangan' => 'Alpha',
                        'tanggal' => $endDate,
                        'jam_masuk' => null,
                        'jam_keluar' => null,
                    ];
                
                    presensi::create($attendanceData2nd);
                
                    // Tambahkan pesan sukses atau log jika diperlukan
                    $this->info('Absen otomatis Alpha berhasil untuk pengguna dengan ID ' . $user_id . ' pada tanggal 2 Oktober.');
                

            // Periksa apakah pengguna sudah absen hari ini
            // $existingAttendance = presensi::where('user_id', $user_id)
            //     ->where('tanggal', $currentDate)
            //     ->first();

            // if (!$existingAttendance) {
            //     // Lakukan absen otomatis jika belum absen
            //     $attendanceData = [
            //         'user_id' => $user_id,
            //         'keterangan' => 'Alpha',
            //         'tanggal' => $currentDate,
            //         'jam_masuk' => null,
            //         'jam_keluar' => null,
            //     ];

            //     presensi::create($attendanceData);
            //     $this->info('Absen otomatis berhasil untuk pengguna dengan ID ' . $user_id);
            }
        }

        $this->info('Proses absen otomatis selesai.');
    }
}
