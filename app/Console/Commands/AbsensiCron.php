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
        // $currentDay = date('j');
        // $currentDate = date('Y-m-d');
        // $currentTime = date('H:i');
        // $currentDaySchedule = ['PM', 'SM', 'PS', 'L1', 'L2'];
        
        // // Ambil pengguna dengan jadwal sesuai pada tanggal saat ini
        // $usersWithSchedule = jadwalterbaru::where('j' . $currentDay, $currentDaySchedule[0])
        //     ->orWhere('j' . $currentDay, $currentDaySchedule[1])
        //     ->orWhere('j' . $currentDay, $currentDaySchedule[2])
        //     ->orWhere('j' . $currentDay, $currentDaySchedule[3])
        //     ->orWhere('j' . $currentDay, $currentDaySchedule[4])
        //     ->get();
        
        // foreach ($usersWithSchedule as $userWithSchedule) {
        //     $user_id = $userWithSchedule->user_id;
        
        //     // Periksa apakah pengguna sudah absen hari ini
        //     $existingAttendance = presensi::where('user_id', $user_id)
        //         ->where('tanggal', $currentDate)
        //         ->first();
        //     $cuti = cuti::where('user_id', $user_id)
        //         ->where('tanggal_mulai', '<=', $currentDate)
        //         ->where('tanggal_berakhir', '>=', $currentDate)
        //         ->where('status', 'approve')
        //         ->first();    
        
        //     if (!$existingAttendance) {
        //         // Periksa apakah jadwal pengguna adalah 'L1' atau 'L2'
        //         $schedule = 'j' . $currentDay;
        //         $userSchedule = $userWithSchedule->$schedule;
        
        //         if ($userSchedule !== 'L1' && $userSchedule !== 'L2') {
        //             //periksa cuti 
        //             if($cuti){
        //                 $jenisIzin = $cuti->jenis_izin;
        //                 if ($jenisIzin=='cuti_tahunan'||$jenisIzin=='cuti_bersama'||$jenisIzin=='cuti_melahirkan'||$jenisIzin=='cuti_besar') {
        //                     $keterangan = 'Cuti';
        //                 }elseif($jenisIzin=='sakit'){
        //                     $keterangan = 'Sakit';
        //                 }elseif($jenisIzin=='izin'){
        //                     $keterangan= 'Izin';
        //                 } else {
        //                     $keterangan = 'Alpha';
        //                 } 
        //             }else{
        //                 $keterangan= 'Alpha';
        //             }
        //             // Lakukan absen otomatis jika belum absen
        //             $attendanceData = [
        //                 'user_id' => $user_id,
        //                 'keterangan' => $keterangan,
        //                 'tanggal' => $currentDate,
        //                 'jam_masuk' => null,
        //                 'jam_keluar' => null,
        //             ];
        
        //             presensi::create($attendanceData);
        //             $this->info('Absen otomatis berhasil untuk pengguna dengan ID ' . $user_id);
        //         }
        //     }
        // }
        
        // $this->info('Proses absen otomatis selesai.');

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
