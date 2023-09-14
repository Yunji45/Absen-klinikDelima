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
            'name'=> 'Administrator',
            'no_hp'=> '0877873827832',
            'nik' => '12345678',
            'email'=> 'admin@gmail.com',
            'password'=> Hash::make('admin'),
            'remember_token'=> Str::random(10),
            'role'=> 'admin',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'dr. IQBAL HILMI FAUZAN',
            'no_hp'=> '08777892398',
            'nik' => 'K001',
            'email'=> 'iqbalhilmifauzan@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'dr. MAHARANI EKA SAPUTRI',
            'no_hp'=> '08777892398',
            'nik' => 'K002',
            'email'=> 'Maharanirempong05@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

         DB::table('users')->insert([
            'name'=> 'IIS SURYAMAH, SST ,Bd',
            'no_hp'=> '08777892398',
            'nik' => 'K003',
            'email'=> 'suryamah65@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'RAJI RAHMATILLAH, SKep Ners',
            'no_hp'=> '08777892398',
            'nik' => 'K004',
            'email'=> 'rajirahmatillah04@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'NURAZIZAH, AMKeb',
            'no_hp'=> '08777892398',
            'nik' => 'K005',
            'email'=> 'nurazizahaza50@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'DESI HERLIANI, AMKeb',
            'no_hp'=> '08777892398',
            'nik' => 'K006',
            'email'=> 'desiherli34@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'EKASARI, AMKeb, AMKeb',
            'no_hp'=> '08777892398',
            'nik' => 'K007',
            'email'=> 'ekasari6000@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'WINDA NUR`AENI, AMKeb',
            'no_hp'=> '08777892398',
            'nik' => 'K008',
            'email'=> 'windanurarni@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'EUIS SRI RAHAYU, AMKeb',
            'no_hp'=> '08777892398',
            'nik' => 'K009',
            'email'=> 'euisoppo9@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'RINI AYU RISMAWATI, AMKeb',
            'no_hp'=> '08777892398',
            'nik' => 'K010',
            'email'=> 'rismawatiriniayu94@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'AAT FARIDAH, AM.Kep',
            'no_hp'=> '08777892398',
            'nik' => 'K011',
            'email'=> 'aatfaridah@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'LINDA NURJAMILAH, S.Farm, Apt',
            'no_hp'=> '08777892398',
            'nik' => 'K012',
            'email'=> 'lindanurjamilah198@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'DIANI ZAFIRA, S.GZ',
            'no_hp'=> '08777892398',
            'nik' => 'K013',
            'email'=> 'zafira.diani@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'TENI GUSTIANI',
            'no_hp'=> '08777892398',
            'nik' => 'NK014',
            'email'=> 'tenigustiani50@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'DEDE GINA',
            'no_hp'=> '08777892398',
            'nik' => 'NK015',
            'email'=> 'dedegina97@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'HILDA MELIYANA',
            'no_hp'=> '08777892398',
            'nik' => 'NK016',
            'email'=> 'hildameliana01@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);
        DB::table('users')->insert([
            'name'=> 'SELLY EKA DARSINI',
            'no_hp'=> '08777892398',
            'nik' => 'NK017',
            'email'=> 'ekasellyyy@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'IHSAN FADHILAH INSANI',
            'no_hp'=> '08777892398',
            'nik' => 'NK018',
            'email'=> 'ihsanfadhilah001@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);
        DB::table('users')->insert([
            'name'=> 'ADINDA RESTU WIDIANTI',
            'no_hp'=> '08777892398',
            'nik' => 'NK019',
            'email'=> 'restuadinda17@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

        DB::table('users')->insert([
            'name'=> 'ASTI PRATIWI',
            'no_hp'=> '08777892398',
            'nik' => 'NK020',
            'email'=> 'astipratiwi1404@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);
        DB::table('users')->insert([
            'name'=> 'RIA YULISTIA',
            'no_hp'=> '08777892398',
            'nik' => 'NK021',
            'email'=> 'riayulistia9@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);
        DB::table('users')->insert([
            'name'=> 'NATIQ HAMIDAH ZAHROH',
            'no_hp'=> '08777892398',
            'nik' => 'NK022',
            'email'=> 'naaathhhhh12@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);
        DB::table('users')->insert([
            'name'=> 'ROSIHAN HALIM',
            'no_hp'=> '08777892398',
            'nik' => 'NK023',
            'email'=> 'haifaassyabiya097@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);
        DB::table('users')->insert([
            'name'=> 'HUSNUL HULUK',
            'no_hp'=> '08777892398',
            'nik' => 'NK024',
            'email'=> 'husnuldella28@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);
        DB::table('users')->insert([
            'name'=> 'DEDAH NURHAIDAH',
            'no_hp'=> '08777892398',
            'nik' => 'NK025',
            'email'=> 'contoh1@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);
        DB::table('users')->insert([
            'name'=> 'SUPARTI ',
            'no_hp'=> '08777892398',
            'nik' => 'NK026',
            'email'=> 'contoh2@gmail.com',
            'password'=> Hash::make('mitradelima'),
            'remember_token'=> Str::random(10),
            'role'=> 'pegawai',
            'foto' => 'default.jpeg',
            'saldo_cuti' => 12,
        ]);

    }
}
