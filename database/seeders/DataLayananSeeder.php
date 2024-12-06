<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DatasetRajal;
use App\Models\DatasetRanap;
use App\Models\DatasetKhitan;
use App\Models\DatasetPersalinan;
use App\Models\DatasetLab;
use App\Models\DatasetEstetika;
use App\Models\DatasetUsg;
use App\Models\KodeWilayah;
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
        $kodeWilayahs = KodeWilayah::pluck('id')->toArray();

        for ($month = 1; $month <= 12; $month++) {
            $rajalCount = $faker->numberBetween(5, 400); // Jumlah kunjungan per bulan

            for ($i = 0; $i < $rajalCount; $i++) {
                DatasetRajal::create([
                    'tgl_kunjungan' => $faker->dateTimeBetween('2021-01-01', '2021-12-31')->format('Y-m-d'),
                    'no_rm' => $faker->unique()->randomNumber(6),
                    'name' => $faker->name,
                    'poli' => $faker->randomElement(['Poli Umum', 'KB', 'Imunisasi', 'Ibu Hamil', 'Keterangan Sehat']),
                    'jenis_kelamin' => $faker->randomElement(['Perempuan', 'Laki-Laki']),
                    'kode_wilayah' => $faker->randomElement($kodeWilayahs) // Memilih kode wilayah secara acak
                ]);
                DatasetRanap::create([
                    'tgl_kunjungan' => $faker->dateTimeBetween('2021-01-01', '2021-12-31')->format('Y-m-d'),
                    'no_rm' => $faker->unique()->randomNumber(6),
                    'name' => $faker->name,
                    'poli' => $faker->randomElement(['Poli Umum','Persalinan']),
                    'jenis_kelamin' => $faker->randomElement(['Perempuan', 'Laki-Laki']),
                    'kode_wilayah' => $faker->randomElement($kodeWilayahs) // Memilih kode wilayah secara acak
                ]);
                DatasetUsg::create([
                    'tgl_kunjungan' => $faker->dateTimeBetween('2021-01-01', '2021-12-31')->format('Y-m-d'),
                    'no_rm' => $faker->unique()->randomNumber(6),
                    'name' => $faker->name,
                    'poli' => $faker->randomElement(['USG']),
                    'jenis_kelamin' => $faker->randomElement(['Perempuan']),
                    'kode_wilayah' => $faker->randomElement($kodeWilayahs) // Memilih kode wilayah secara acak
                ]);
                DatasetKhitan::create([
                    'tgl_kunjungan' => $faker->dateTimeBetween('2021-01-01', '2021-12-31')->format('Y-m-d'),
                    'no_rm' => $faker->unique()->randomNumber(6),
                    'name' => $faker->name,
                    'poli' => $faker->randomElement(['Khitan']),
                    'jenis_kelamin' => $faker->randomElement(['Laki-Laki']),
                    'kode_wilayah' => $faker->randomElement($kodeWilayahs) // Memilih kode wilayah secara acak
                ]);
                DatasetEstetika::create([
                    'tgl_kunjungan' => $faker->dateTimeBetween('2021-01-01', '2021-12-31')->format('Y-m-d'),
                    'no_rm' => $faker->unique()->randomNumber(6),
                    'name' => $faker->name,
                    'poli' => $faker->randomElement(['Estetika']),
                    'jenis_kelamin' => $faker->randomElement(['Perempuan', 'Laki-Laki']),
                    'kode_wilayah' => $faker->randomElement($kodeWilayahs) // Memilih kode wilayah secara acak
                ]);
                DatasetLab::create([
                    'tgl_kunjungan' => $faker->dateTimeBetween('2021-01-01', '2021-12-31')->format('Y-m-d'),
                    'no_rm' => $faker->unique()->randomNumber(6),
                    'name' => $faker->name,
                    'poli' => $faker->randomElement(['LABORATORIUM']),
                    'jenis_kelamin' => $faker->randomElement(['Perempuan', 'Laki-Laki']),
                    'kode_wilayah' => $faker->randomElement($kodeWilayahs) // Memilih kode wilayah secara acak
                ]);

            }
        }
        // Membuat data dummy per bulan untuk DatasetRajal
        // for ($month = 1; $month <= 12; $month++) {
        //     $rajalCount = $faker->numberBetween(5, 400); // Jumlah kunjungan per bulan
        //     for ($i = 0; $i < $rajalCount; $i++) {
        //         DatasetRajal::create([
        //             'tgl_kunjungan' => $faker->dateTimeThisMonth()->format('Y-m-d'),
        //             'no_rm' => $faker->unique()->randomNumber(6),
        //             'name' => $faker->name,
        //             'poli' => $faker->randomElement(['Poli Umum', 'KB', 'Imunisasi','Ibu Hamil','Keterangan Sehat']),
        //             'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan'])
        //         ]);
        //     }
        // }
        // Tambahkan data kunjungan untuk tahun 2025
        // for ($month = 1; $month <= 12; $month++) {
        //     $rajalCount = $faker->numberBetween(5, 400); // Jumlah kunjungan per bulan
        //     for ($i = 0; $i < $rajalCount; $i++) {
        //         DatasetRajal::create([
        //             'tgl_kunjungan' => $faker->dateTimeBetween('2021-01-01', '2021-12-31')->format('Y-m-d'),
        //             'no_rm' => $faker->unique()->randomNumber(6),
        //             'name' => $faker->name,
        //             'poli' => $faker->randomElement(['Poli Umum', 'KB', 'Imunisasi','Ibu Hamil','Keterangan Sehat']),
        //             'jenis_kelamin' => $faker->randomElement(['Perempuan','Laki-Laki']),
        //             'kode_wilayah' => $faker->randomElement(['01'])
        //         ]);
        //     }
        // }

        // Tambahkan data kunjungan untuk tahun 2026
        // for ($month = 1; $month <= 12; $month++) {
        //     $rajalCount = $faker->numberBetween(5, 400); // Jumlah kunjungan per bulan
        //     for ($i = 0; $i < $rajalCount; $i++) {
        //         DatasetEstetika::create([
        //             'tgl_kunjungan' => $faker->dateTimeBetween('2022-01-01', '2022-12-31')->format('Y-m-d'),
        //             'no_rm' => $faker->unique()->randomNumber(6),
        //             'name' => $faker->name,
        //             'poli' => $faker->randomElement(['Estetika']),
        //             'jenis_kelamin' => $faker->randomElement(['Perempuan'])
        //         ]);
        //     }
        // }

        // for ($month = 1; $month <= 12; $month++) {
        //     $rajalCount = $faker->numberBetween(5, 400); // Jumlah kunjungan per bulan
        //     for ($i = 0; $i < $rajalCount; $i++) {
        //         DatasetEstetika::create([
        //             'tgl_kunjungan' => $faker->dateTimeBetween('2023-01-01', '2023-12-31')->format('Y-m-d'),
        //             'no_rm' => $faker->unique()->randomNumber(6),
        //             'name' => $faker->name,
        //             'poli' => $faker->randomElement(['Estetika']),
        //             'jenis_kelamin' => $faker->randomElement(['Perempuan'])
        //         ]);
        //     }
        // }
        // for ($month = 1; $month <= 12; $month++) {
        //     $rajalCount = $faker->numberBetween(5, 400); // Jumlah kunjungan per bulan
        //     for ($i = 0; $i < $rajalCount; $i++) {
        //         DatasetEstetika::create([
        //             'tgl_kunjungan' => $faker->dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-d'),
        //             'no_rm' => $faker->unique()->randomNumber(6),
        //             'name' => $faker->name,
        //             'poli' => $faker->randomElement(['Estetika']),
        //             'jenis_kelamin' => $faker->randomElement(['Perempuan'])
        //         ]);
        //     }
        // }
        // for ($month = 1; $month <= 12; $month++) {
        //     $rajalCount = $faker->numberBetween(5, 400); // Jumlah kunjungan per bulan
        //     for ($i = 0; $i < $rajalCount; $i++) {
        //         DatasetEstetika::create([
        //             'tgl_kunjungan' => $faker->dateTimeBetween('2025-01-01', '2025-12-31')->format('Y-m-d'),
        //             'no_rm' => $faker->unique()->randomNumber(6),
        //             'name' => $faker->name,
        //             'poli' => $faker->randomElement(['Estetika']),
        //             'jenis_kelamin' => $faker->randomElement(['Perempuan'])
        //         ]);
        //     }
        // }

        // Membuat data dummy per bulan untuk DatasetRanap
        // for ($month = 1; $month <= 12; $month++) {
        //     $ranapCount = $faker->numberBetween(5, 1000); // Jumlah kunjungan per bulan
        //     for ($i = 0; $i < $ranapCount; $i++) {
        //         DatasetEstetika::create([
        //             'tgl_kunjungan' => $faker->dateTimeBetween('2020-01-01', '2020-12-31')->format('Y-m-d'),
        //             'no_rm' => $faker->unique()->randomNumber(6),
        //             'name' => $faker->name,
        //             'poli' => $faker->randomElement(['Estetika']),
        //             'jenis_kelamin' => $faker->randomElement(['Laki-laki'])
        //         ]);
        //     }
        // }

        // Membuat data dummy per bulan untuk DatasetEstetika
        // for ($month = 1; $month <= 12; $month++) {
        //     $EstetikaCount = $faker->numberBetween(5, 200); // Jumlah kunjungan per bulan
        //     for ($i = 0; $i < $EstetikaCount; $i++) {
        //         DatasetEstetika::create([
        //             'tgl_kunjungan' => $faker->dateTimeThisMonth()->format('Y-m-d'),
        //             'no_rm' => $faker->unique()->randomNumber(6),
        //             'name' => $faker->name,
        //             'poli' => $faker->randomElement(['Poli Umum', 'Poli Gigi', 'Poli KIA']),
        //             'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan'])
        //         ]);
        //     }
        // }

        // for ($month = 1; $month <= 12; $month++) {
        //     $EstetikaCount = $faker->numberBetween(5, 300); // Jumlah kunjungan per bulan
        //     for ($i = 0; $i < $EstetikaCount; $i++) {
        //         DatasetPersalinan::create([
        //             'tgl_kunjungan' => $faker->dateTimeThisMonth()->format('Y-m-d'),
        //             'no_rm' => $faker->unique()->randomNumber(6),
        //             'name' => $faker->name,
        //             'poli' => $faker->randomElement(['Poli Umum', 'Poli Gigi', 'Poli KIA']),
        //             'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan'])
        //         ]);
        //     }
        // }
    }
}
