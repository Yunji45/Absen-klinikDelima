<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('docs_apis')->insert([
            'api_name' => 'Get User',
            'function' => 'Mendapatkan Data User',
            'method' => 'GET',
            'url' => '/api-user',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Absensi',
            'function' => 'Mendapatkan Data Absensi User',
            'method' => 'GET',
            'url' => '/absensi',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Nakes',
            'function' => 'Mendapatkan Data Tenaga Kesehatan',
            'method' => 'GET',
            'url' => '/api-nakes',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Non Nakes',
            'function' => 'Mendapatkan Data Tenaga Non Kesehatan',
            'method' => 'GET',
            'url' => '/api-non-nakes',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Gender',
            'function' => 'Mendapatkan Data Jenis Gender User',
            'method' => 'GET',
            'url' => '/api-gender',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Status Work',
            'function' => 'Mendapatkan Status Kerja User',
            'method' => 'GET',
            'url' => '/api-pekerjaan',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Education',
            'function' => 'Mendapatkan Data Pendidikan User',
            'method' => 'GET',
            'url' => '/api-education',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Map Coverage',
            'function' => 'Mendapatkan Data Persebaran Kunjungan',
            'method' => 'GET',
            'url' => '/api-map',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Layanan',
            'function' => 'Mendapatkan Data Seluruh Layanan',
            'method' => 'GET',
            'url' => '/api-layanan',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Rajal',
            'function' => 'Mendapatkan Seluruh Data Rawat Jalan',
            'method' => 'GET',
            'url' => '/api-layanan-rajal',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Ranap',
            'function' => 'Mendapatkan Seluruh Data Rawat Inap',
            'method' => 'GET',
            'url' => '/api-layanan-ranap-line',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Khitan',
            'function' => 'Mendapatkan Seluruh Data Khitan',
            'method' => 'GET',
            'url' => '/api-layanan-khitan-line',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Lab',
            'function' => 'Mendapatkan Seluruh Data Laboratorium',
            'method' => 'GET',
            'url' => '/api-layanan-lab-line',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get USG',
            'function' => 'Mendapatkan Seluruh Data USG',
            'method' => 'GET',
            'url' => '/api-layanan-usg-bar',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);
        DB::table('docs_apis')->insert([
            'api_name' => 'Get Estetika',
            'function' => 'Mendapatkan Seluruh Data Estetika',
            'method' => 'GET',
            'url' => '/api-layanan-estetika-bar',
            'content_type' => 'application/json',
            'time_out' => '8 Second',
        ]);





    }
}
