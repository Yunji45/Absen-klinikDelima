<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class testCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cutis')->insert([
            'user_id' => 1,
            'tanggal_mulai' => '2023-09-15', 
            'tanggal_berakhir' => '2023-09-20', 
            'alasan' => 'Liburan',
            'status' => 'pengajuan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
    }
}
