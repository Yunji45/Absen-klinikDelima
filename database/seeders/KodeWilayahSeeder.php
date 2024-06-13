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
            'longitude' =>'107.517155331259',
            'latitude' =>'-7.024827110631676'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '02',
            'wilayah'=> 'Kab.Bandung Barat',
            'longitude' =>'107.51728506531941',
            'latitude' =>'-6.838105634266569'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '03',
            'wilayah'=> 'Kab.Bekasi',
            'longitude' =>'107.15963127433463',
            'latitude' =>'-6.311956714428291'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '04',
            'wilayah'=> 'Kab.Bogor',
            'longitude' =>'106.84752682519485',
            'latitude' =>'-6.478762977759217'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '05',
            'wilayah'=> 'Kab.Ciamis',
            'longitude' =>'108.35059587220877',
            'latitude' =>'-7.3224231370126205'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '06',
            'wilayah'=> 'Kab.Cianjur',
            'longitude' =>'107.14461084095444',
            'latitude' =>'-6.8101680432524745'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '07',
            'wilayah'=> 'Kab.Cirebon',
            'longitude' =>'108.48177685508222',
            'latitude' =>'-6.75789284348771'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '08',
            'wilayah'=> 'Kab.Garut',
            'longitude' =>'107.89582147466808',
            'latitude' =>'-7.20691206664803'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '09',
            'wilayah'=> 'Kab.Indramayu',
            'longitude' =>'108.32465514049773',
            'latitude' =>'-6.323465631759092'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '10',
            'wilayah'=> 'Kab.Karawang',
            'longitude' =>'107.30732619090094',
            'latitude' =>'-6.304372704635185'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '11',
            'wilayah'=> 'Kab.Kuningan',
            'longitude' =>'108.48292791527012',
            'latitude' =>'-6.9745807882884066'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '12',
            'wilayah'=> 'Kab.Majalengka',
            'longitude' =>'108.22340475314621',
            'latitude' =>'-6.830628428300017'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '13',
            'wilayah'=> 'Kab.Pangandaran',
            'longitude' =>'108.6491777443353',
            'latitude' =>'-7.679536213418928'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '14',
            'wilayah'=> 'Kab.Purwakarta',
            'longitude' =>'107.4434812364434',
            'latitude' =>'-6.55004446741026'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '15',
            'wilayah'=> 'Kab.Subang',
            'longitude' =>'107.7590027106653',
            'latitude' =>'-6.563905884250829'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '16',
            'wilayah'=> 'Kab.Sukabumi',
            'longitude' =>'106.521503364419',
            'latitude' =>'-6.970197752286907'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '17',
            'wilayah'=> 'Kab.Sumedang',
            'longitude' =>'107.92482390351495',
            'latitude' =>'-6.842805171857918'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '18',
            'wilayah'=> 'Kab.Tasikmalaya',
            'longitude' =>'108.11027572495988',
            'latitude' =>'-7.349905462018427'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '19',
            'wilayah'=> 'Kota Bandung',
            'longitude' =>'107.61251076914903',
            'latitude' =>'-6.914801616473682'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '20',
            'wilayah'=> 'Kota Banjar',
            'longitude' =>'108.54082578118948',
            'latitude' =>'-7.3739364868403925'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '21',
            'wilayah'=> 'Kota Bekasi',
            'longitude' =>'106.99076148511642',
            'latitude' =>'-6.245193240862605'

        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '22',
            'wilayah'=> 'Kota Bogor',
            'longitude' =>'106.8105833006532',
            'latitude' =>'-6.606274388704861'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '23',
            'wilayah'=> 'Kota Cimahi',
            'longitude' =>'107.54389787491084',
            'latitude' =>'-6.8738182334588345'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '24',
            'wilayah'=> 'Kota Cirebon',
            'longitude' =>'108.55969232396421',
            'latitude' =>'-6.710640306588189'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '25',
            'wilayah'=> 'Kota Depok',
            'longitude' =>'106.81556288793149',
            'latitude' =>'-6.40666438417351'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '26',
            'wilayah'=> 'Kota Sukabumi',
            'longitude' =>'106.9257630531983',
            'latitude' =>'-6.91055698020017'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '27',
            'wilayah'=> 'Kota Tasikmalaya',
            'longitude' =>'108.22039015567833',
            'latitude' =>'-7.3219025115428025'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '28',
            'wilayah'=> 'Kab.Banjarnegara',
            'longitude' =>'109.6947869656887',
            'latitude' =>'-7.394491264523737'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '29',
            'wilayah'=> 'Kab.Purwokerto',
            'longitude' =>'109.24385004727094',
            'latitude' =>'-7.423089762344276'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '30',
            'wilayah'=> 'Kab.Batang',
            'longitude' =>'109.73064324885297',
            'latitude' =>'-6.9041653912403405'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '31',
            'wilayah'=> 'Kab.Blora',
            'longitude' =>'111.4130945303487',
            'latitude' =>'-6.967090589616362'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '32',
            'wilayah'=> 'Kab.Boyolali',
            'longitude' =>'110.59934539934858',
            'latitude' =>'-7.530475136468397'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '33',
            'wilayah'=> 'Kab.Brebes',
            'longitude' =>'109.0357827264533',
            'latitude' =>'-6.867148945293735'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '34',
            'wilayah'=> 'Kab.Cilacap',
            'longitude' =>'109.01304427923861',
            'latitude' =>'-7.713279802113917'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '35',
            'wilayah'=> 'Kab.Demak',
            'longitude' =>'110.63583725655155',
            'latitude' =>'-6.8899939062878985'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '36',
            'wilayah'=> 'Kab.Grobogan',
            'longitude' =>'110.91619133201579',
            'latitude' =>'-7.080849967780793'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '37',
            'wilayah'=> 'Kab.Jepara',
            'longitude' =>'110.66550219818964',
            'latitude' =>'-6.59073447692343'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '38',
            'wilayah'=> 'Kab.Karanganyar',
            'longitude' =>'110.93711905085502',
            'latitude' =>'-7.586189645620806'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '39',
            'wilayah'=> 'Kab.Kebumen',
            'longitude' =>'109.65583624030063',
            'latitude' =>'-7.671243849357708'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '40',
            'wilayah'=> 'Kab.Kendal',
            'longitude' =>'110.20169007664992',
            'latitude' =>'-6.919692499256854'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '41',
            'wilayah'=> 'Kab.Klaten',
            'longitude' =>'110.60222710797427',
            'latitude' =>'-7.701411610587627'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '42',
            'wilayah'=> 'Kab.Kudus',
            'longitude' =>'110.84022904850212',
            'latitude' =>'-6.805029007637728'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '43',
            'wilayah'=> 'Kab.Magelang',
            'longitude' =>'110.22012892064913',
            'latitude' =>'-7.592696673102097'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '44',
            'wilayah'=> 'Kab.Pati',
            'longitude' =>'111.0286597548644',
            'latitude' =>'-6.750821120330031'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '45',
            'wilayah'=> 'Kab.Pekalongan',
            'longitude' =>'109.5781032109224',
            'latitude' =>'-7.031784433197615'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '46',
            'wilayah'=> 'Kab.Pemalang',
            'longitude' =>'109.38398331171959',
            'latitude' =>'-6.885708485749774'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '47',
            'wilayah'=> 'Kab.Purbalingga',
            'longitude' =>'109.36129933741972',
            'latitude' =>'-7.383089795111488'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '48',
            'wilayah'=> 'Kab.Purworejo',
            'longitude' =>'110.00472132520304',
            'latitude' =>'-7.713439631702386'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '49',
            'wilayah'=> 'Kab.Rembang',
            'longitude' =>'111.33940558478224',
            'latitude' =>'-6.7067667843707'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '50',
            'wilayah'=> 'Kab.Semarang',
            'longitude' =>'110.40907511140489',
            'latitude' =>'-7.133067479354892'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '51',
            'wilayah'=> 'Kab.Sragen',
            'longitude' =>'111.02168903469618',
            'latitude' =>'-7.4223697157326'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '52',
            'wilayah'=> 'Kab.Sukoharjo',
            'longitude' =>'110.84054963609606',
            'latitude' =>'-7.6792559775820735'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '53',
            'wilayah'=> 'Kab.Tegal',
            'longitude' =>'109.13626280766704',
            'latitude' =>'-6.982344837493798'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '54',
            'wilayah'=> 'Kab.Temanggung',
            'longitude' =>'110.17655558718411',
            'latitude' =>'-7.312748964621505'
        ]);
        DB::table('kode_wilayahs')->insert([
            'kode'=> '55',
            'wilayah'=> 'Kab.Wonogiri',
            'longitude' =>'110.92034561338954',
            'latitude' =>'-7.804537707899698'
        ]);        
        DB::table('kode_wilayahs')->insert([
            'kode'=> '56',
            'wilayah'=> 'Kab.Wonosobo',
            'longitude' =>'109.90374203455013',
            'latitude' =>'-7.358575975761525'
        ]);        
        DB::table('kode_wilayahs')->insert([
            'kode'=> '57',
            'wilayah'=> 'Kota Magelang',
            'longitude' =>'110.21599965188642',
            'latitude' =>'-7.473787517854859'
        ]);        
        DB::table('kode_wilayahs')->insert([
            'kode'=> '58',
            'wilayah'=> 'Kota Pekalongan',
            'longitude' =>'109.66425548902441',
            'latitude' =>'-6.880195706516375'
        ]);        
        DB::table('kode_wilayahs')->insert([
            'kode'=> '59',
            'wilayah'=> 'Kota Salatiga',
            'longitude' => '110.50084949880176',
            'latitude' => '-7.321836419509324'
        ]);
        
        DB::table('kode_wilayahs')->insert([
            'kode'=> '60',
            'wilayah'=> 'Kota Semarang',
            'longitude' => '110.41924704949332',
            'latitude' => '-6.970914920675057'
        ]);
        
        DB::table('kode_wilayahs')->insert([
            'kode'=> '61',
            'wilayah'=> 'Kota Surakarta',
            'longitude' => '110.81891675856923',
            'latitude' => '-7.568604772280054'
        ]);
        
        DB::table('kode_wilayahs')->insert([
            'kode'=> '62',
            'wilayah'=> 'Kota Tegal',
            'longitude' => '109.13913152721034',
            'latitude' => '-6.857902234359486'
        ]);
        
    }
}
