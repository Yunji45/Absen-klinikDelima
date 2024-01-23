<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class JobAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_applications')->insert([
            'vacancy_id' => 1,
            'nama_lengkap' => 'Ihya Natik Wibowo',
            'email' => 'ihyanatikwibowo@gmail.com',
            'foto' => 'ini file foto',
            'cover_letter' => 'Disini Saya Ingin Melamar Pekerjaan',
            'file_cv' => 'ini file cv',
            'file_pendukung' => 'ini file pendukung',
        ]);
    }
}
