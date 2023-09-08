<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'Caca',
            'no_hp'=> '0877873827832',
            'nik' => '12345678',
            'email'=> 'caca@gmail.com',
            'password'=> Hash::make('admin'),
            'remember_token'=> Str::random(10),
            'role'=> 'admin',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'ihya',
            'no_hp'=> '08777892398',
            'nik' => '123459320',
            'email'=> 'ihya@gmail.com',
            'password'=> Hash::make('pegawai'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'pegawi',
            'no_hp'=> '08777892394',
            'nik' => '123459334',
            'email'=> 'ihyaadmin@gmail.com',
            'password'=> Hash::make('pegawai'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

    }
}
