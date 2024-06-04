<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KodeWilayah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KodeWilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kode_wilayahs')->insert([
            'kode'=> '01',
            'wilayah'=> 'Kab.Bandung',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '02',
            'wilayah'=> 'Kab.Bandung Barat',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '03',
            'wilayah'=> 'Kab.Bekasi',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '04',
            'wilayah'=> 'Kab.Bogor',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '05',
            'wilayah'=> 'Kab.Ciamis',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '06',
            'wilayah'=> 'Kab.Cianjur',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '07',
            'wilayah'=> 'Kab.Cirebon',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '08',
            'wilayah'=> 'Kab.Garut',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '09',
            'wilayah'=> 'Kab.Indramayu',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '10',
            'wilayah'=> 'Kab.Karawang',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '11',
            'wilayah'=> 'Kab.Kuningan',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '12',
            'wilayah'=> 'Kab.Majalengka',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '13',
            'wilayah'=> 'Kab.Pangandaran',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '14',
            'wilayah'=> 'Kab.Purwakarta',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '15',
            'wilayah'=> 'Kab.Subang',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '16',
            'wilayah'=> 'Kab.Sukabumi',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '17',
            'wilayah'=> 'Kab.Sumedang',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '18',
            'wilayah'=> 'Kab.Tasikmalaya',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '19',
            'wilayah'=> 'Kota Bandung',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '20',
            'wilayah'=> 'Kota Banjar',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '21',
            'wilayah'=> 'Kota Bekasi',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '22',
            'wilayah'=> 'Kota Bogor',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '23',
            'wilayah'=> 'Kota Cimahi',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '24',
            'wilayah'=> 'Kota Cirebon',
        ]);

        DB::table('kode_wilayahs')->insert([
            'kode'=> '25',
            'wilayah'=> 'Kota Depok',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '26',
            'wilayah'=> 'Kota Sukabumi',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '27',
            'wilayah'=> 'Kota Tasikmalaya',
        ]);

        DB::table('kode_wilayahs')->insert([
            'kode'=> '28',
            'wilayah'=> 'Kab.Banjarnegara ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '29',
            'wilayah'=> 'Kab.Banyumas',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '30',
            'wilayah'=> 'Kab.Batang ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '31',
            'wilayah'=> 'Kab.Blora ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '32',
            'wilayah'=> 'Kab.Boyolali ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '33',
            'wilayah'=> 'Kab.Brebes ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '34',
            'wilayah'=> 'Kab.Cilacap ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '35',
            'wilayah'=> 'Kab.Demak ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '36',
            'wilayah'=> 'Kab.Grobogan ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '37',
            'wilayah'=> 'Kab.Jepara ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '38',
            'wilayah'=> 'Kab.Karanganyar ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '39',
            'wilayah'=> 'Kab.Kebumen ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '40',
            'wilayah'=> 'Kab.Kendal ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '41',
            'wilayah'=> 'Kab.Klaten ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '42',
            'wilayah'=> 'Kab.Kudus ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '43',
            'wilayah'=> 'Kab.Magelang ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '44',
            'wilayah'=> 'Kab.Pati ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '45',
            'wilayah'=> 'Kab.Pekalongan ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '46',
            'wilayah'=> 'Kab.Pemalang ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '47',
            'wilayah'=> 'Kab.Purbalingga ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '48',
            'wilayah'=> 'Kab.Purworejo ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '49',
            'wilayah'=> 'Kab.Rembang ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '50',
            'wilayah'=> 'Kab.Semarang',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '51',
            'wilayah'=> 'Kab.Sragen ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '52',
            'wilayah'=> 'Kab.Sukoharjo ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '53',
            'wilayah'=> 'Kab.Tegal ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '54',
            'wilayah'=> 'Kab.Temanggung ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '55',
            'wilayah'=> 'Kab.Wonogiri ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '56',
            'wilayah'=> 'Kab.Wonosobo ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '57',
            'wilayah'=> 'Kota Magelang ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '58',
            'wilayah'=> 'Kota Pekalongan ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '59',
            'wilayah'=> 'Kota Salatiga ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '60',
            'wilayah'=> 'Kota Semarang ',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '61',
            'wilayah'=> 'Kota Surakarta',
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '62',
            'wilayah'=> 'Kota Tegal',
        ]);

    }
}
