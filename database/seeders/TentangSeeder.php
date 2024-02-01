<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TentangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tentangs')->insert([
            'sub_judul_1' => 'test',
            'sub_judul_2' => 'test',
            'content_1' => 'test',
            'content_2' => 'test',
            'foto_1' => 'foto.jpeg',
        ]);
    }
}
