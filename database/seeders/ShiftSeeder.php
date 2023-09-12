<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shifts')->insert([
            'nama_shift'=> 'PS',
        ]);
        DB::table('shifts')->insert([
            'nama_shift'=> 'SM',
        ]);
        DB::table('shifts')->insert([
            'nama_shift'=> 'L1',
        ]);
        DB::table('shifts')->insert([
            'nama_shift'=> 'L2',
        ]);
        DB::table('shifts')->insert([
            'nama_shift'=> 'C',
        ]);
        DB::table('shifts')->insert([
            'nama_shift'=> 'IJ',
        ]);
    }
}
