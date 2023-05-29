<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('presensis')->insert([
            'user_id' => 1,
            'keterangan' => 'Masuk',
            'tanggal' => now(),
            'jam_masuk' => '08:00',
            'jam_keluar' => '16:00',
        ]);

        DB::table('presensis')->insert([
            'user_id' => 2,
            'keterangan' => 'Telat',
            'tanggal' => now(),
            'jam_masuk' => '09:00',
            'jam_keluar' => '16:00',
        ]);

        DB::table('presensis')->insert([
            'user_id' => 2,
            'keterangan' => 'Masuk',
            'tanggal' => now(),
            'jam_masuk' => '08:00',
            'jam_keluar' => '16:00',
        ]);

    }
}
