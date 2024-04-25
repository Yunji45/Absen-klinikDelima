<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DatasetRajal;
use App\Models\DatasetRanap;
use App\Models\DatasetKhitan;
use App\Models\DatasetPersalinan;
use Faker\Factory as Faker;

class DataLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Membuat data dummy per bulan untuk DatasetRajal
        for ($month = 1; $month <= 12; $month++) {
            $rajalCount = $faker->numberBetween(5, 400); // Jumlah kunjungan per bulan
            for ($i = 0; $i < $rajalCount; $i++) {
                DatasetRajal::create([
                    'tgl_kunjungan' => $faker->dateTimeThisMonth()->format('Y-m-d'),
                    'no_rm' => $faker->unique()->randomNumber(6),
                    'name' => $faker->name,
                    'poli' => $faker->randomElement(['Poli Umum', 'Poli Gigi', 'Poli KIA']),
                    'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan'])
                ]);
            }
        }

        // Membuat data dummy per bulan untuk DatasetRanap
        for ($month = 1; $month <= 12; $month++) {
            $ranapCount = $faker->numberBetween(5, 1000); // Jumlah kunjungan per bulan
            for ($i = 0; $i < $ranapCount; $i++) {
                DatasetRanap::create([
                    'tgl_kunjungan' => $faker->dateTimeThisMonth()->format('Y-m-d'),
                    'no_rm' => $faker->unique()->randomNumber(6),
                    'name' => $faker->name,
                    'poli' => $faker->randomElement(['Poli Umum', 'Poli Gigi', 'Poli KIA']),
                    'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan'])
                ]);
            }
        }

        // Membuat data dummy per bulan untuk DatasetKhitan
        for ($month = 1; $month <= 12; $month++) {
            $khitanCount = $faker->numberBetween(5, 200); // Jumlah kunjungan per bulan
            for ($i = 0; $i < $khitanCount; $i++) {
                DatasetKhitan::create([
                    'tgl_kunjungan' => $faker->dateTimeThisMonth()->format('Y-m-d'),
                    'no_rm' => $faker->unique()->randomNumber(6),
                    'name' => $faker->name,
                    'poli' => $faker->randomElement(['Poli Umum', 'Poli Gigi', 'Poli KIA']),
                    'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan'])
                ]);
            }
        }

        for ($month = 1; $month <= 12; $month++) {
            $khitanCount = $faker->numberBetween(5, 300); // Jumlah kunjungan per bulan
            for ($i = 0; $i < $khitanCount; $i++) {
                DatasetPersalinan::create([
                    'tgl_kunjungan' => $faker->dateTimeThisMonth()->format('Y-m-d'),
                    'no_rm' => $faker->unique()->randomNumber(6),
                    'name' => $faker->name,
                    'poli' => $faker->randomElement(['Poli Umum', 'Poli Gigi', 'Poli KIA']),
                    'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan'])
                ]);
            }
        }
    }
}
