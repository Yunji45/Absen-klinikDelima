<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BerandaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('berandas')->insert([
            'sub_judul_1' => 'test',
            'sub_judul_2' => 'test',
            'sub_judul_3' => 'test',
            'content_1' => 'test',
            'content_2' => 'test',
            'content_3' => 'test',
            'foto_1' => 'foto.jpeg',
            'foto_2' => 'foto.jpeg',
            'foto_3' => 'foto.jpeg',
        ]);
    }
}
